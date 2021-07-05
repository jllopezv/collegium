<?php

namespace App\Models\Traits;

use App\Models\User;
use App\Models\Crm\Invoice;
use Illuminate\Database\Eloquent\Builder;

/**
 *   Models with user_id references to users
 */
trait HasInvoices
{

    /**
     * Get all of the models's invoices.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function invoices()
    {
        return $this->morphMany(Invoice::class, 'invoiceable');
    }


}
