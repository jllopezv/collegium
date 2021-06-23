<?php

namespace App\Http\Livewire\Controls;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Aux\Currency;

class InvoiceLinesComponent extends Component
{
    public $lines=[];
    public $mode;
    public $uid;
    public $model;
    public $lines_subtotal=0.0;
    public $lines_taxes=0.0;
    public $currency_id;

    protected $listeners=[
        'setlines'                  => 'setLines',
        'currencyinputformupdated'  =>  'currencyInputFormSync',
        'dropdownupdated'           =>  'dropdownSync',
        'eventsetinvoicecurrency'   =>  'setInvoiceCurrency',
    ];

    public function mount()
    {
        $this->currency_id=Currency::getCurrent()->id;

        if ($this->mode=='create') $this->LineAdd();
        if ($this->mode=='edit' && count($this->lines)==0) $this->LineAdd();


    }

    public function setLines($uid, $lines)
    {
        if ($this->uid==$uid)
        {
            $this->lines=$lines;
        }

    }

    public function LineAdd()
    {
        $newline=[
            'id'            =>  0,
            'code'          =>  '',
            'item'          =>  '',
            'quantity'      =>  1,
            'price'         =>  0.0,
            'discount'      =>  0,
            'discount_percent'  => true,
            'tax'           =>  0,
            'amount'        =>  0,
            'amount_currency_default'   =>  0,
            'currency_id'   =>  $this->currency_id,
        ];
        $this->lines[]=$newline;
        $this->dispatchBrowserEvent('appSetFocus',['element_id' => 'invoiceline_code_'.(count($this->lines)-1)]);
        $this->setLineCurrency(count($this->lines)-1, $this->currency_id);
    }

    public function LineDelete($index)
    {
        if ($index==0 && count($this->lines)==1) return; // No delete on first line
        array_splice($this->lines,$index,1);
        $this->calculateLines(true);    // Force update currency and values
        $this->syncValues();
    }

    public function customValidation()
    {
        $this->resetErrorBag();
        foreach($this->lines as $key=>$line)
        {
            if (trim($line['quantity'])=='')
            {
                $this->lines[$key]['quantity']=0;
                $line['quantity']=0;
            }
            // Quantity
            if (!is_numeric($line['quantity']))
            {
                $this->addError('invoiceline_quantity_'.$key, "DEBE SER UN NÚMERO. USE SOLO `.` PARA SEPARADOR DECIMAL O `-` PARA NEGATIVOS");
                return false;
            }

            if (trim($line['price'])=='')
            {
                $this->lines[$key]['price']=0;
                $line['price']=0;
            }
            // Price
            if (!is_numeric($line['price']))
            {
                $this->addError('invoiceline_price_'.$key, "DEBE SER UN NÚMERO. USE SOLO `.` PARA SEPARADOR DECIMAL O `-` PARA NEGATIVOS");
                return false;
            }

            if (trim($line['discount'])=='')
            {
                $this->lines[$key]['discount']=0;
                $line['discount']=0;
            }
            // Dto
            if (!is_numeric($line['discount']))
            {
                $this->addError('invoiceline_discount_'.$key, "DEBE SER UN NÚMERO. USE SOLO `.` PARA SEPARADOR DECIMAL O `-` PARA NEGATIVOS");
                return false;
            }

            if (trim($line['tax'])=='')
            {
                $this->lines[$key]['tax']=0;
                $line['tax']=0;
            }
            // Tax
            if (!is_numeric($line['tax']))
            {
                $this->addError('invoiceline_tax_'.$key, "DEBE SER UN NÚMERO. USE SOLO `.` PARA SEPARADOR DECIMAL O `-` PARA NEGATIVOS");
                return false;
            }

        }
        return true;
    }

    public function calculateLines($forceupdatecurrency=false)
    {
        $this->lines_subtotal=0;
        $this->lines_taxes=0;
        foreach($this->lines as $key=>$line)
        {
            $currency=Currency::find($line['currency_id']);
            if ($currency!=null)
            {
                $taxline=0;
                $this->lines[$key]['amount']=$line['quantity']*$line['price'];
                if ($line['discount']!=0)
                {
                    if ($line['discount_percent']) $this->lines[$key]['amount']=$this->lines[$key]['amount']-($this->lines[$key]['amount']*($line['discount']/100));
                    if (!$line['discount_percent']) $this->lines[$key]['amount']=$this->lines[$key]['amount']-$line['discount'];
                }
                if ($line['tax']!=0)
                {
                    $taxline=$this->lines[$key]['amount']*($line['tax']/100);
                }

                // In default currency
                $this->lines[$key]['amount_currency_default']=$currency->convert(Currency::find($this->currency_id)->id,$this->lines[$key]['amount']);

                $this->lines_subtotal+=$this->lines[$key]['amount_currency_default'];
                $this->lines_taxes+=$taxline;


                // Update currency values
                $this->emit('invoiceline_amount_'.$key.'_setvalue', $this->lines[$key]['amount'], false);

                // update currencies
                if ($forceupdatecurrency) $this->emit('setvalue','currencycomponent_'.$key, $this->lines[$key]['currency_id']);
            }


        }
        $this->emit('invoicelinesupdated', $this->lines, $this->lines_subtotal, $this->lines_taxes );

    }

    public function updatedLines()
    {

        if ($this->customValidation())
        {
            $this->calculateLines();
        }
    }

    public function discountPercent($index, $value)
    {
        $this->lines[$index]['discount_percent']=$value;
        $this->calculateLines();
    }

    public function currencyInputFormSync($uid, $value, $currency_id, $isPercent)
    {
        $calculate=false;
        if (Str::startsWith($uid, 'invoiceline_price_'))
        {
            $linenumber=Str::after($uid,'invoiceline_price_');
            $this->lines[$linenumber]['price']=doubleval($value);
            $calculate=true;
        }
        if (Str::startsWith($uid, 'invoiceline_discount_'))
        {
            $linenumber=Str::after($uid,'invoiceline_discount_');
            $this->lines[$linenumber]['discount']=doubleval($value);
            $this->lines[$linenumber]['discount_percent']=$isPercent;
            $calculate=true;
        }

        if ($calculate) $this->calculateLines();
    }

    public function dropdownSync($uid, $currency_id, $change)
    {
        if (Str::startsWith($uid, 'currencycomponent_'))
        {
            $linenumber=Str::after($uid,'currencycomponent_');
            $this->setLineCurrency($linenumber, $currency_id);
        }
    }

    public function setLineCurrency($linenumber, $currency_id)
    {
        $this->lines[$linenumber]['currency_id']=$currency_id;
        $this->emit('setvalue', 'invoiceline_price_'.$linenumber.'_currency', $currency_id);
        $this->emit('setvalue', 'invoiceline_discount_'.$linenumber.'_currency', $currency_id);
        $this->emit('setvalue', 'invoiceline_amount_'.$linenumber.'_currency', $currency_id);
    }

    public function syncValues()
    {
        // Put values in array into currency inputform
        foreach($this->lines as $key=>$line)
        {
            $this->emit('invoiceline_price_'.$key.'_setvalue', $this->lines[$key]['price'], false);
            $this->emit('invoiceline_discount_'.$key.'_setvalue', $this->lines[$key]['discount'], false);
        }

    }

    public function setInvoiceCurrency($currency_id)
    {
        $this->currency_id=$currency_id;
        $this->calculateLines();
    }

    public function render()
    {
        return view('livewire.controls.invoice-lines-component');
    }
}
