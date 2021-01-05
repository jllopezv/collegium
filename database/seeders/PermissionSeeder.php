<?php

namespace Database\Seeders;

use App\Models\Auth\Permission;
use Illuminate\Database\Seeder;
use App\Models\Auth\PermissionGroup;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $table='permissions';
        $this->createPermissions($table,'AUTENTICACIÓN');

        $table='permission_groups';
        $this->createPermissions($table,'AUTENTICACIÓN');

        $table='users';
        $this->createPermissions($table,'AUTENTICACIÓN');

        $table='roles';
        $this->createPermissions($table,'AUTENTICACIÓN');

        $table='colors';
        $this->createPermissions($table,'AUXILIARES');

        $table='countries';
        $this->createPermissions($table,'AUXILIARES');

        $table='timezones';
        $this->createPermissions($table,'AUXILIARES');

        $table='languages';
        $this->createPermissions($table,'AUXILIARES');

        $table='students';
        $this->createPermissions($table,'ACADÉMICA');

        $table='school_levels';
        $this->createPermissions($table,'ACADÉMICA');

        $table='school_grades';
        $this->createPermissions($table,'ACADÉMICA');

        $table='annos';
        $this->createPermissions($table,'ACADÉMICA');

        $table='app_setting_pages';
        $this->createPermissions($table,'CONFIGURACIÓN');

        $table='app_settings';
        $this->createPermissions($table,'CONFIGURACIÓN');

        $table='website_post_cats';
        $this->createPermissions($table,'WEBSITE');

        $record=new Permission;
        $record->name="HACER LOGIN DE USUARIOS";
        $record->slug='users.login';
        $record->description="PERMITE HACER LOGIN DE USUARIOS";
        $record->group=$this->getGroupID('ESPECIALES');
        $record->save();
        $record->allowedActions()->create([ 'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false,
                                        ]);

        $record=new Permission;
        $record->name="CAMBIAR CONFIGURACIÓN";
        $record->slug='app.settings';
        $record->description="PERMITE CAMBIAR PARÁMETROS DE CONFIGURACIÓN";
        $record->group=$this->getGroupID('ESPECIALES');
        $record->save();
        $record->allowedActions()->create([ 'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false,
                                        ]);
    }

    public function createPermissions($table, $group)
    {
        $record=new Permission;
        $record->name="ACCEDER A LOS REGISTROS";
        $record->slug=$table.'.access';
        $record->description="PERMITE ACCEDER A LOS REGISTROS";
        $record->group=$this->getGroupID($group);
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

        $record=new Permission;
        $record->name="LISTAR REGISTROS";
        $record->slug=$table.'.index';
        $record->description="PERMITE LISTAR LOS REGISTROS";
        $record->group=$this->getGroupID($group);
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

        $record=new Permission;
        $record->name="LISTAR SOLO MIS REGISTROS";
        $record->slug=$table.'.index.owner';
        $record->description="PERMITE LISTAR SOLO LOS REGISTROS CREADOS POR EL USUARIO";
        $record->group=$this->getGroupID($group);
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

        $record=new Permission;
        $record->name="CREAR REGISTROS";
        $record->slug=$table.'.create';
        $record->description="CREAR REGISTROS";
        $record->group=$this->getGroupID($group);
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

        $record=new Permission;
        $record->name="ELIMINAR REGISTROS";
        $record->slug=$table.'.destroy';
        $record->description="ELIMINAR REGISTROS";
        $record->group=$this->getGroupID($group);
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

        $record=new Permission;
        $record->name="ELIMINAR REGISTROS PROPIOS";
        $record->slug=$table.'.destroy.owner';
        $record->description="SOLO SE PODRÁN ELIMINAR REGISTROS CREADOS POR EL USUARIO";
        $record->group=$this->getGroupID($group);
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

        $record=new Permission;
        $record->name="VER REGISTROS";
        $record->slug=$table.'.show';
        $record->description="PERMITE VER REGISTROS LOS REGISTROS";
        $record->group=$this->getGroupID($group);
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

        $record=new Permission;
        $record->name="VER REGISTROS PROPIOS";
        $record->slug=$table.'.show.owner';
        $record->description="VER SOLO LOS REGISTROS CREADOS POR EL USUARIO";
        $record->group=$this->getGroupID($group);
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

        $record=new Permission;
        $record->name="EDITAR REGISTROS";
        $record->slug=$table.'.edit';
        $record->description="PUEDE EDITAR REGISTROS";
        $record->group=$this->getGroupID($group);
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

        $record=new Permission;
        $record->name="EDITAR REGISTROS PROPIOS";
        $record->slug=$table.'.edit.owner';
        $record->description="EDITAR SOLO LOS REGISTROS CREADOS POR EL USUARIO";
        $record->group=$this->getGroupID($group);
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

        $record=new Permission;
        $record->name="IMPRIMIR REGISTROS";
        $record->slug=$table.'.print';
        $record->description="PUEDE IMPRIMIR REGISTROS";
        $record->group=$this->getGroupID($group);
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

        $record=new Permission;
        $record->name="IMPRIMIR SOLO REGISTROS DEL USUARIO";
        $record->slug=$table.'.print.owner';
        $record->description="IMPRIMIR SOLO REGISTROS CREADOS POR EL USUARIO";
        $record->group=$this->getGroupID($group);
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

    }

    public function getGroupID($group)
    {
        $groupid=PermissionGroup::where('group',$group)->first();
        return $groupid->id;
    }
}
