<?php

namespace Database\Seeders;

use App\Models\Crm\Customer;
use Illuminate\Database\Seeder;
use App\Models\Crm\CustomerType;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record=new Customer;
        $record->code='CONTADO';
        $record->customer="CONTADO";
        $record->country_id=61;
        $record->customer_type_id=CustomerType::where('type','GENERAL')->first()->id;
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);

       }
}
