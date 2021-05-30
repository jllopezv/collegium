<?php

namespace Database\Seeders;

use App\Models\School\Anno;
use Illuminate\Database\Seeder;
use App\Models\Crm\EmployeeType;

class EmployeeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $anno=Anno::find(3); // 2021

        $record=new EmployeeType();
        $record->type='EMPLEADO';
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

    }
}
