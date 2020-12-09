<?php

namespace Database\Seeders;

use App\Models\Auth\Role;
use App\Models\Auth\Permission;
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

        $this->addPermissions($record, 'permissions');
        $this->addPermissions($record, 'permission_groups');
        $this->addPermissions($record, 'users');
        $this->addPermissions($record, 'roles');

        $this->addPermissions($record, 'colors');
        $this->addPermissions($record, 'countries');
        $this->addPermissions($record, 'timezones');
        $this->addPermissions($record, 'languages');

        $this->addPermissions($record, 'students');
        $this->addPermissions($record, 'school_levels');
        $this->addPermissions($record, 'school_grades');

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


    public function addPermissions($record, $table, $access=true, $create=true, $view=true, $viewall=true, $edit=true, $editall=true, $delete=true, $deleteall=true, $print=true, $printall=true )
    {
        $parray=[];
        if ($access) $parray[]=( Permission::where('slug',$table.".access")->first() )->id;
        if ($create) $parray[]=( Permission::where('slug',$table.".create")->first() )->id;
        if ($view) $parray[]=( Permission::where('slug',$table.".show")->first() )->id;
        if ($viewall) $parray[]=( Permission::where('slug',$table.".show.owner")->first() )->id;
        if ($edit) $parray[]=( Permission::where('slug',$table.".edit")->first() )->id;
        if ($editall) $parray[]=( Permission::where('slug',$table.".edit.owner")->first() )->id;
        if ($delete) $parray[]=( Permission::where('slug',$table.".destroy")->first() )->id;
        if ($deleteall) $parray[]=( Permission::where('slug',$table.".destroy.owner")->first() )->id;
        if ($print) $parray[]=( Permission::where('slug',$table.".print")->first() )->id;
        if ($printall) $parray[]=( Permission::where('slug',$table.".print.owner")->first() )->id;

        $record->permissions()->attach($parray);


    }
}
