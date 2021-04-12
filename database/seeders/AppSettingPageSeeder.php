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
        $record->priority=1;
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);

        $record=new AppSettingPage();
        $record->settingpage='LOGIN';
        $record->onlysuperadmin=true;
        $record->priority=2;
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                                'allowEdit'     => false,
                                                'allowDelete'   => false,
                                                'allowLock'     => false
                                        ]);


        $record=new AppSettingPage();
        $record->settingpage='GENERAL';
        $record->priority=3;
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                                'allowEdit'     => false,
                                                'allowDelete'   => false,
                                                'allowLock'     => false
                                        ]);

        $record=new AppSettingPage();
        $record->settingpage='WEBSITE';
        $record->onlysuperadmin=true;
        $record->priority=4;
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                                'allowEdit'     => false,
                                                'allowDelete'   => false,
                                                'allowLock'     => false
                                        ]);


        $record=new AppSettingPage();
        $record->settingpage=transup('posts');
        $record->onlysuperadmin=true;
        $record->priority=5;
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                                'allowEdit'     => false,
                                                'allowDelete'   => false,
                                                'allowLock'     => false
                                        ]);

        $record=new AppSettingPage();
        $record->settingpage=transup('advertisements');
        $record->onlysuperadmin=true;
        $record->priority=6;
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                                'allowEdit'     => false,
                                                'allowDelete'   => false,
                                                'allowLock'     => false
                                        ]);

        $record=new AppSettingPage();
        $record->settingpage=transup('news');
        $record->onlysuperadmin=true;
        $record->priority=7;
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                                'allowEdit'     => false,
                                                'allowDelete'   => false,
                                                'allowLock'     => false
                                        ]);

        $record=new AppSettingPage();
        $record->settingpage=transup('sections');
        $record->onlysuperadmin=true;
        $record->priority=8;
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                                'allowEdit'     => false,
                                                'allowDelete'   => false,
                                                'allowLock'     => false
                                        ]);
    }
}
