<?php

namespace App\Http\Livewire\Controls;

use App\Http\Livewire\Traits\WithModalAlert;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Aux\Currency;

class InvoiceInlineComponent extends Component
{

    use WithModalAlert;

    public $mode;
    public $uid;
    public $lines=[];

    // Inovices fields
    public $ref;
    public $description;
    public $subtotal=0;
    public $discount=0;
    public $discount_percent=false;
    public $taxes=0;
    public $total=0;

    public $currency_id;

    public $subtotal_string;
    public $taxes_string;
    public $total_string;

    protected $listeners=[
        'invoicelinesupdated'  =>  'invoiceLinesSync',
        'currencyinputformupdated'  =>  'currencyInputFormSync',
        'eventsetinvoicecurrency'   =>  'setInvoiceCurrency',

    ];

    public function mount()
    {
        $this->currency_id=Currency::getCurrent()->id;
    }

    public function invoiceLinesSync($lines, $subtotal, $taxes)
    {
        $this->lines=$lines;
        $this->subtotal=$subtotal;
        $this->taxes=$taxes;
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $currency=Currency::find($this->currency_id);
        if ($currency==null)
        {
            $this->showAlertError("NO HAY DEFINIDA UNA DIVISA PARA EL DOCUMENTO. SE SELECCIONA LA DIVISA POR DEFECTO.");
            $currency=Currency::getCurrent();
        }
        $this->total=$this->subtotal;
        if ($this->discount!=0)
        {
            if (!$this->discount_percent)
            {
                $this->total-=$this->discount;
            }
            else
            {
                $this->total-=$this->total*($this->discount/100);
            }
        }
        $this->total+=$this->taxes;

        // Convert
        $this->subtotal_string=$currency->getString($this->subtotal);
        $this->taxes_string=$currency->getString($this->taxes);
        $this->total_string=$currency->getString($this->total);
    }

    public function discountPercent($value)
    {
        $this->discount_percent=$value;
    }

    public function currencyInputFormSync($uid, $value, $currency_id, $isPercent)
    {
        if ($uid=='invoice_discount')
        {
            $this->discount=doubleval($value);
            $this->discount_percent=$isPercent;
            $this->calculateTotal();
        }
    }

    public function setInvoiceCurrency($currency_id)
    {
        $this->currency_id=$currency_id;
        $this->emit('invoice_discount_setcurrency', $currency_id);
    }

    public function render()
    {
        return view('livewire.controls.invoice-inline-component');
    }
}
