<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Website\WebsiteSectionCat;

class WebsiteSectionCatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record=new WebsiteSectionCat;
        $record->category='GENERAL';
        $record->priority=1;
        $record->color_id=1;        // El primer color disponible
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);
    }
}
