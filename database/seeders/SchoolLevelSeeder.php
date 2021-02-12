<?php

namespace Database\Seeders;

use App\Models\School\Anno;
use Illuminate\Database\Seeder;
use App\Models\School\SchoolLevel;

class SchoolLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $anno=Anno::find(3); // 2021

        $record=new SchoolLevel;
        $record->level='INICIAL';
        $record->save();
        $anno->schoolLevels()->attach($record);

        $record=new SchoolLevel;
        $record->level='PRIMARIA';
        $record->save();
        $anno->schoolLevels()->attach($record);

        $record=new SchoolLevel;
        $record->level='SECUNDARIA';
        $record->save();
        $anno->schoolLevels()->attach($record);
    }
}
