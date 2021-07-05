<?php

namespace App\Http\Livewire\Controls;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Aux\Currency;

class InvoiceLinesComponent extends Component
{
    public $lines=[];
    public $defaultlines;
    public $mode;
    public $uid;
    public $model;
    public $lines_subtotal=0.0;
    public $lines_taxes=0.0;
    public $currency_id;

    protected $listeners=[
        /*
        'currencyinputformupdated'  =>  'currencyInputFormSync',

        */
        'calculateinvoiceline'     =>  'calculateLines',
        'dropdownupdated'           =>  'dropdownSync',
        'eventsetinvoicecurrency'   =>  'setInvoiceCurrency',
        'setvaluelines'             =>  'setLines',
    ];

    public function mount()
    {
        $this->currency_id=Currency::getCurrent()->id;

        if ($this->mode=='create') $this->LineAdd();
        if ($this->mode=='edit' && count($this->lines)==0) $this->LineAdd();

        if ($this->defaultlines!=null)
        {
            $this->lines=$this->defaultlines;
            $this->calculateLines(); // First time in edit
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
            'tax_amount'    =>  0,
            'amount'        =>  0,
            'amount_string' =>  '0',
            'amount_currency_default'   =>  0,
            'currency_id'   =>  $this->currency_id,
        ];
        $this->lines[]=$newline;
        $this->dispatchBrowserEvent('appSetFocus',['element_id' => 'invoiceline_code_'.(count($this->lines)-1)]);
        //$this->setLineCurrency(count($this->lines)-1, $this->currency_id);
    }

    public function LineDelete($index)
    {
        if ($index==0 && count($this->lines)==1) return; // No delete on first line
        array_splice($this->lines,$index,1);
        $this->calculateLines();
    }



    public function calculateLines()
    {
        $this->lines_subtotal=0;
        $this->lines_taxes=0;
        foreach($this->lines as $key=>$line)
        {
            $this->calculateLine($key);
            $this->lines_subtotal+=$this->lines[$key]['amount_currency_default'];
            $this->lines_taxes+=$this->lines[$key]['tax_amount'];
        }
        $this->emit('invoicelinesupdated', $this->lines, $this->lines_subtotal, $this->lines_taxes );

    }



    public function setLineCurrency($linenumber, $currency_id)
    {
        $this->lines[$linenumber]['currency_id']=$currency_id;
        $this->calculateLines();
    }

    public function setLines($uid, $lines)
    {
        if ($this->uid==$uid)
        {
            $this->lines=$lines;
            if (count($this->lines)==0)
            {
                $this->LineAdd();
            }
        }

        $this->calculateLines();

    }

    public function setPercent($key, $percent)
    {
        $this->lines[$key]['discount_percent']=$percent;
        $this->calculateLines();
    }

    /* Events */

    public function calculateLine($key)
    {
        $currency=Currency::find($this->lines[$key]['currency_id']);

        if ($currency!=null)
        {

            //Normalize

            //Trim
            $this->lines[$key]['quantity']=trim($this->lines[$key]['quantity']);
            $this->lines[$key]['price']=trim($this->lines[$key]['price']);
            $this->lines[$key]['discount']=trim($this->lines[$key]['discount']);
            $this->lines[$key]['tax']=trim($this->lines[$key]['tax']);

            //Only numbers
            $this->lines[$key]['quantity']=preg_replace("/[a-zA-Z,]/","",$this->lines[$key]['quantity']);
            $this->lines[$key]['price']=preg_replace("/[a-zA-Z,]/","",$this->lines[$key]['price']);
            $this->lines[$key]['discount']=preg_replace("/[a-zA-Z,]/","",$this->lines[$key]['discount']);
            $this->lines[$key]['tax']=preg_replace("/[a-zA-Z,]/","",$this->lines[$key]['tax']);

            $this->lines[$key]['quantity']=doubleval($this->lines[$key]['quantity']);
            $this->lines[$key]['price']=doubleval($this->lines[$key]['price']);
            $this->lines[$key]['discount']=doubleval($this->lines[$key]['discount']);
            $this->lines[$key]['tax']=doubleval($this->lines[$key]['tax']);

            $taxline=0;

            $this->lines[$key]['amount']=$this->lines[$key]['quantity']*$this->lines[$key]['price'];
            if ($this->lines[$key]['discount']!=0)
            {
                if ($this->lines[$key]['discount_percent']) $this->lines[$key]['amount']=$this->lines[$key]['amount']-($this->lines[$key]['amount']*($this->lines[$key]['discount']/100));
                if (!$this->lines[$key]['discount_percent']) $this->lines[$key]['amount']=$this->lines[$key]['amount']-$this->lines[$key]['discount'];
            }
            if ($this->lines[$key]['tax']!=0)
            {
                $taxline=$this->lines[$key]['amount']*($this->lines[$key]['tax']/100);
            }
            $this->lines[$key]['tax_amount']=$taxline;
            $this->lines[$key]['amount']+=$taxline;

            // In default currency
            $this->lines[$key]['amount_currency_default']=$currency->convert(Currency::find($this->currency_id)->id,$this->lines[$key]['amount']);


            // Normalize
            $this->lines[$key]['amount_string']=$currency->getString($this->lines[$key]['amount']);
            // Update currency values
            //$this->emit('invoiceline_amount_'.$key.'_setvalue', $this->lines[$key]['amount'], false);

            // update currencies
            //if ($forceupdatecurrency) $this->emit('setvalue','currencycomponent_'.$key, $this->lines[$key]['currency_id']);

            $this->lines[$key]['quantity']=number_format($this->lines[$key]['quantity'], appsetting('invoices_quantity_decimals'), '.', ',');
            $this->lines[$key]['price']=number_format($this->lines[$key]['price'], $currency->decimals, '.', ',');
            $this->lines[$key]['discount']=number_format($this->lines[$key]['discount'], $currency->decimals, '.', ',');
            $this->lines[$key]['tax']=number_format($this->lines[$key]['tax'], $currency->decimals, '.', ',');

        }

        //if ($sendevent) $this->emit('invoicelinesupdated', $this->lines, $this->lines_subtotal, $this->lines_taxes );

    }

    public function dropdownSync($uid, $currency_id, $change)
    {
        if (Str::startsWith($uid, 'currencycomponent_'))
        {
            $linenumber=Str::after($uid,'currencycomponent_');
            $this->setLineCurrency($linenumber, $currency_id);
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
