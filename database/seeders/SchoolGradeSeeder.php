<?php

namespace Database\Seeders;

use App\Models\School\Anno;
use Illuminate\Database\Seeder;
use App\Models\School\SchoolGrade;

class SchoolGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $anno=Anno::find(3); // 2021


        $record=new SchoolGrade;
        $record->grade='PRIMERO';
        $record->level_id=2;
        $record->save();
        $anno->schoolGrades()->attach($record);

        $record=new SchoolGrade;
        $record->grade='SEGUNDO';
        $record->level_id=2;
        $record->save();
        $anno->schoolGrades()->attach($record);

        $record=new SchoolGrade;
        $record->grade='TERCERO';
        $record->level_id=2;
        $record->save();
        $anno->schoolGrades()->attach($record);

        $record=new SchoolGrade;
        $record->grade='CUARTO';
        $record->level_id=2;
        $record->save();
        $anno->schoolGrades()->attach($record);

        $record=new SchoolGrade;
        $record->grade='QUINTO';
        $record->level_id=2;
        $record->save();
        $anno->schoolGrades()->attach($record);

        $record=new SchoolGrade;
        $record->grade='SEXTO';
        $record->level_id=2;
        $record->save();
        $anno->schoolGrades()->attach($record);
    }
}
