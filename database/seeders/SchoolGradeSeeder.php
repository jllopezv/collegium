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
        $record->grade='PÁRVULOS';
        $record->level_id=1;
        $record->save();
        $anno->schoolGrades()->attach([$record->id => ['priority' => 1] ]);

        $record=new SchoolGrade;
        $record->grade='PREKINDER';
        $record->level_id=1;
        $record->save();
        $anno->schoolGrades()->attach([$record->id => ['priority' => 2] ]);

        $record=new SchoolGrade;
        $record->grade='KINDER';
        $record->level_id=1;
        $record->save();
        $anno->schoolGrades()->attach([$record->id => ['priority' => 3] ]);

        $record=new SchoolGrade;
        $record->grade='PREPRIMARIO';
        $record->level_id=1;
        $record->save();
        $anno->schoolGrades()->attach([$record->id => ['priority' => 4] ]);

        $record=new SchoolGrade;
        $record->grade='PRIMERO';
        $record->level_id=2;
        $record->save();
        $anno->schoolGrades()->attach([$record->id => ['priority' => 5] ]);

        $record=new SchoolGrade;
        $record->grade='SEGUNDO';
        $record->level_id=2;
        $record->save();
        $anno->schoolGrades()->attach([$record->id => ['priority' => 6] ]);

        $record=new SchoolGrade;
        $record->grade='TERCERO';
        $record->level_id=2;
        $record->save();
        $anno->schoolGrades()->attach([$record->id => ['priority' => 7] ]);

        $record=new SchoolGrade;
        $record->grade='CUARTO';
        $record->level_id=2;
        $record->save();
        $anno->schoolGrades()->attach([$record->id => ['priority' => 8] ]);

        $record=new SchoolGrade;
        $record->grade='QUINTO';
        $record->level_id=2;
        $record->save();
        $anno->schoolGrades()->attach([$record->id => ['priority' => 9] ]);

        $record=new SchoolGrade;
        $record->grade='SEXTO';
        $record->level_id=2;
        $record->save();
        $anno->schoolGrades()->attach([$record->id => ['priority' => 10] ]);

        $record=new SchoolGrade;
        $record->grade='PRIMERO SECUNDARIA';
        $record->level_id=3;
        $record->save();
        $anno->schoolGrades()->attach([$record->id => ['priority' => 11] ]);

        $record=new SchoolGrade;
        $record->grade='SEGUNDO SECUNDARIA';
        $record->level_id=3;
        $record->save();
        $anno->schoolGrades()->attach([$record->id => ['priority' => 12] ]);

        $record=new SchoolGrade;
        $record->grade='TERCERO SECUNDARIA';
        $record->level_id=3;
        $record->save();
        $anno->schoolGrades()->attach([$record->id => ['priority' => 13] ]);

        $record=new SchoolGrade;
        $record->grade='CUARTO SECUNDARIA';
        $record->level_id=3;
        $record->save();
        $anno->schoolGrades()->attach([$record->id => ['priority' => 14] ]);

        $record=new SchoolGrade;
        $record->grade='QUINTO SECUNDARIA';
        $record->level_id=3;
        $record->save();
        $anno->schoolGrades()->attach([$record->id => ['priority' => 15] ]);

        $record=new SchoolGrade;
        $record->grade='SEXTO SECUNDARIA';
        $record->level_id=3;
        $record->save();
        $anno->schoolGrades()->attach([$record->id => ['priority' => 16] ]);
    }
}
