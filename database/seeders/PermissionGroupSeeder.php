<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Auth\PermissionGroup;

class PermissionGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $group=new PermissionGroup;
        $group->group='ESPECIALES';
        $group->priority=1;
        $group->save();
        $group->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

        $group=new PermissionGroup;
        $group->group='AUTENTICACIÓN';
        $group->priority=2;
        $group->save();
        $group->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

        $group=new PermissionGroup;
        $group->group='ACADÉMICA';
        $group->priority=3;
        $group->save();
        $group->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

        $group=new PermissionGroup;
        $group->group='CONFIGURACIÓN';
        $group->priority=4;
        $group->save();
        $group->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

        $group=new PermissionGroup;
        $group->group='WEBSITE';
        $group->priority=5;
        $group->save();
        $group->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

        $group=new PermissionGroup;
        $group->group='AUXILIARES';
        $group->priority=10;
        $group->save();
        $group->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

    }
}
