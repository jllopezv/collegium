<?php

namespace Database\Seeders;

use App\Models\Auth\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record=new Role;
        $record->role="SUPERUSER";
        $record->level=1;
        $record->dashboard='superuser';
        $record->color_id=2;
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);

        $record=new Role;
        $record->role="ADMIN";
        $record->level=5;
        $record->dashboard='admin';
        $record->color_id=1;
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);

        $record=new Role;
        $record->role="USER";
        $record->level=1000;
        $record->dashboard='user';
        $record->color_id=4;
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);
    }
}
