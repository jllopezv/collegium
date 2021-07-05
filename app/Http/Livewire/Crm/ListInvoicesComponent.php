<?php

namespace App\Http\Livewire\Crm;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Aux\Currency;

class ListInvoicesComponent extends Component
{
    public $invoices=null;
    public $sortorder='id';
    public $uid;

    public $invoices_sum_total_string='';
    public $invoices_sum_paid_string='';
    public $invoices_sum_pending_string='';

    protected $listeners=[
        'listinvoicessetorder'      =>      'setOrder'
    ];

    public function mount()
    {
        //$this->invoices=collect([]);
    }

    public function orderInvoices()
    {

        if ($this->sortorder=='') return;
        if (count($this->invoices)==0) return;
        if (Str::startsWith($this->sortorder,"-"))
        {
            $columname=Str::after($this->sortorder, '-');
            //$this->sortorder=$columname;
            $data=$this->invoices->sortByDesc(function ($item, $key) use ($columname) {
                $itemarray=$item->toArray();
                return $itemarray[$columname];
            });
        }
        else
        {
            $columname=$this->sortorder;
            //$this->sortorder='-'.$this->sortorder;
            $data=$this->invoices->sortBy(function ($item, $key) use ($columname) {
                $itemarray=$item->toArray();
                return $itemarray[$columname];
            });
        }
        $this->invoices=$data;
    }

    /* Events */

    public function setOrder($uid, $order)
    {
        if ($uid==$this->uid || $uid=='*')
        {
            $this->sortorder=$order;
        }
    }

    public function calculateTotals()
    {
        $currency=Currency::getCurrent();
        $this->invoices_sum_total_string=$currency->getString($this->invoices->sum('total'));
        $this->invoices_sum_paid_string=$currency->getString($this->invoices->sum('paid'));
        $this->invoices_sum_pending_string=$currency->getString($this->invoices->sum('pending'));
    }

    public function render()
    {
        $this->orderInvoices();
        $this->calculateTotals();
        return view('livewire.crm.list-invoices-component');
    }
}
