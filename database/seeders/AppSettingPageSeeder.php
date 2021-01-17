<?php

namespace Database\Seeders;

use App\Models\Setting\AppSettingPage;
use Illuminate\Database\Seeder;

class AppSettingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record=new AppSettingPage();
        $record->settingpage='SISTEMA';
        $record->onlysuperadmin=true;
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);

        $record=new AppSettingPage();
        $record->settingpage='LOGIN';
        $record->onlysuperadmin=true;
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                                'allowEdit'     => false,
                                                'allowDelete'   => false,
                                                'allowLock'     => false
                                        ]);

        $record=new AppSettingPage();
        $record->settingpage='POSTS';
        $record->onlysuperadmin=true;
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                                'allowEdit'     => false,
                                                'allowDelete'   => false,
                                                'allowLock'     => false
                                        ]);

        $record=new AppSettingPage();
        $record->settingpage='GENERAL';
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                                'allowEdit'     => false,
                                                'allowDelete'   => false,
                                                'allowLock'     => false
                                        ]);
    }
}
