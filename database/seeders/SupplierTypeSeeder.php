<?php

namespace Database\Seeders;

use App\Models\School\Anno;
use Illuminate\Database\Seeder;
use App\Models\Crm\SupplierType;

class SupplierTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $anno=Anno::find(3); // 2021

        $record=new SupplierType();
        $record->type='GENERAL';
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

    }
}
