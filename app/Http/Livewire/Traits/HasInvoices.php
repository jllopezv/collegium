<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Support\Str;
use App\Models\Aux\Currency;

Trait HasInvoices
{
    /* Invoices */
    public $invoices=[];
    public $invoiceorder='invoice_date';
    public $invoices_sum_total_string='';
    public $invoices_sum_pending_string='';
    public $invoices_sum_paid_string='';

    public function initInvoices()
    {
        // Invoices
        if ($this->mode=='edit' || $this->mode=='show')
        {
            $this->invoices=$this->record->invoices;
        }
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $currency=Currency::getCurrent();

        $this->invoices_sum_total_string=0;
        $this->invoices_sum_paid_string=0;
        $this->invoices_sum_pending_string=0;

        if (count($this->invoices)>0)
        {
            $this->invoices_sum_total_string+=$this->invoices->sum('total');
            $this->invoices_sum_paid_string+=$this->invoices->sum('paid');
            $this->invoices_sum_pending_string+=$this->invoices->sum('pending');
        }
        foreach($this->students as $student)
        {
            if (count($student->invoices)>0)
            {
                $this->invoices_sum_total_string+=$student->invoices->sum('total');
                $this->invoices_sum_paid_string+=$student->invoices->sum('paid');
                $this->invoices_sum_pending_string+=$student->invoices->sum('pending');
            }
        }

        $this->invoices_sum_total_string=$currency->getString($this->invoices_sum_total_string);
        $this->invoices_sum_paid_string=$currency->getString($this->invoices_sum_paid_string);
        $this->invoices_sum_pending_string=$currency->getString($this->invoices_sum_pending_string);
    }

    public function syncInvoices()
    {
        $this->changeInvoiceOrder();
        $this->calculateTotals();
    }

    public function changeInvoiceSortDirection()
    {
        if (Str::startsWith($this->invoiceorder,"-"))
        {
            $columname=Str::after($this->invoiceorder, '-');
            $this->invoiceorder=$columname;
        }
        else
        {
            $columname=$this->invoiceorder;
            $this->invoiceorder='-'.$columname;
        }
        $this->changeInvoiceOrder($this->invoiceorder);
    }

    /* Events */

    public function changeInvoiceOrder($order='')
    {
        if ($order!='')
        {
            $this->invoiceorder=$order;
            $this->emit('listinvoicessetorder','*', $order);
        }
        else
        {
            $this->emit('listinvoicessetorder','*', $this->invoiceorder);
        }

    }

}
