<?php

namespace Database\Seeders;

use App\Models\School\Anno;
use Illuminate\Database\Seeder;
use App\Models\School\SchoolBatch;

class SchoolBatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $anno=Anno::find(3); // 2021

        $record=new SchoolBatch;
        $record->batch='MATUTINA';
        $record->save();
        $anno->schoolBatches()->attach($record);

        $record=new SchoolBatch;
        $record->batch='VESPERTINA';
        $record->save();
        $anno->schoolBatches()->attach($record);

        $record=new SchoolBatch;
        $record->batch='NOCTURNA';
        $record->save();
        $anno->schoolBatches()->attach($record);

        $record=new SchoolBatch;
        $record->batch='SABATINA';
        $record->save();
        $anno->schoolBatches()->attach($record);

        $record=new SchoolBatch;
        $record->batch='DOMINICAL';
        $record->save();
        $anno->schoolBatches()->attach($record);
    }
}
