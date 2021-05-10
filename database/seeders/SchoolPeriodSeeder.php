<?php

namespace Database\Seeders;

use App\Models\School\Anno;
use Illuminate\Database\Seeder;
use App\Models\School\SchoolPeriod;
use App\Models\School\SchoolModality;

class SchoolPeriodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $anno=Anno::find(3); // 2021

        $record=new SchoolPeriod;
        $record->period='ANUAL';
        $record->save();
        $anno->schoolPeriods()->attach($record);

        $record=new SchoolPeriod;
        $record->period='BIMESTRAL';
        $record->save();
        $anno->schoolPeriods()->attach($record);

        $record=new SchoolPeriod;
        $record->period='TRIMESTRAL';
        $record->save();
        $anno->schoolPeriods()->attach($record);

        $record=new SchoolPeriod;
        $record->period='CUATRIMESTRAL';
        $record->save();
        $anno->schoolPeriods()->attach($record);

        $record=new SchoolPeriod;
        $record->period='SEMESTRAL';
        $record->save();
        $anno->schoolPeriods()->attach($record);


    }
}
