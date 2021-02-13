<?php

namespace Database\Seeders;

use App\Models\School\Anno;
use Illuminate\Database\Seeder;
use App\Models\School\SchoolModality;

class SchoolModalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $anno=Anno::find(3); // 2021

        $record=new SchoolModality;
        $record->modality='PRESENCIAL';
        $record->save();
        $anno->schoolModalities()->attach($record);

        $record=new SchoolModality;
        $record->modality='SEMIPRESENCIAL';
        $record->save();
        $anno->schoolModalities()->attach($record);

        $record=new SchoolModality;
        $record->modality='VIRTUAL';
        $record->save();
        $anno->schoolModalities()->attach($record);

    }
}
