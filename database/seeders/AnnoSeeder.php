<?php

namespace Database\Seeders;

use App\Models\School\Anno;
use Illuminate\Database\Seeder;

class AnnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record=new Anno;
        $record->anno='2019-2020';
        $record->anno_start='2019/07/15';
        $record->anno_end='2020/06/15';
        $record->current=true;
        $record->save();
    }
}
