<?php

namespace Database\Seeders;

use App\Models\Crm\Supplier;
use Illuminate\Database\Seeder;
use App\Models\Crm\SupplierType;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record=new Supplier;
        $record->supplier="CONTADO";
        $record->supplier_type_id=SupplierType::where('type','GENERAL')->first()->id;
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);

       }
}
