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

        /* AUX */

        $table='colors';
        $this->createPermissions($table,'AUXILIARES');

        $table='countries';
        $this->createPermissions($table,'AUXILIARES');

        $table='timezones';
        $this->createPermissions($table,'AUXILIARES');

        $table='languages';
        $this->createPermissions($table,'AUXILIARES');

        $table='images';
        $this->createPermissions($table,'AUXILIARES');

        $table='currencies';
        $this->createPermissions($table,'AUXILIARES');

        /* ACADEMIC */

        $table='students';
        $this->createPermissions($table,'ACADÉMICA');

        $table='school_levels';
        $this->createPermissions($table,'ACADÉMICA');

        $table='school_grades';
        $this->createPermissions($table,'ACADÉMICA');

        $table='annos';
        $this->createPermissions($table,'ACADÉMICA');

        $table='school_batches';
        $this->createPermissions($table,'ACADÉMICA');

        $table='school_sections';
        $this->createPermissions($table,'ACADÉMICA');

        $table='school_modalities';
        $this->createPermissions($table,'ACADÉMICA');

        $table='school_periods';
        $this->createPermissions($table,'ACADÉMICA');

        $table='school_subjects';
        $this->createPermissions($table,'ACADÉMICA');

        $table='teachers';
        $this->createPermissions($table,'ACADÉMICA');


        /* CRM */

        $table='employee_type';
        $this->createPermissions($table,'CRM');

        $table='employees';
        $this->createPermissions($table,'CRM');

        $table='customer_type';
        $this->createPermissions($table,'CRM');

        $table='customers';
        $this->createPermissions($table,'CRM');

        $table='suppliers';
        $this->createPermissions($table,'CRM');

        $table='supplier_type';
        $this->createPermissions($table,'CRM');

        $table='invoices';
        $this->createPermissions($table,'CRM');

        /* SETTINGS */

        $table='app_setting_pages';
        $this->createPermissions($table,'CONFIGURACIÓN');

        $table='app_settings';
        $this->createPermissions($table,'CONFIGURACIÓN');

        $table='model_configs';
        $this->createPermissions($table,'CONFIGURACIÓN');

        $table='website_post_cats';
        $this->createPermissions($table,'WEBSITE');

        $table='website_posts';
        $this->createPermissions($table,'WEBSITE');

        $table='website_banners';
        $this->createPermissions($table,'WEBSITE');

        $table='website_pages';
        $this->createPermissions($table,'WEBSITE');

        $table='website_menus';
        $this->createPermissions($table,'WEBSITE');

        $table='website_advertisements';
        $this->createPermissions($table,'WEBSITE');

        $table='website_advertisement_cats';
        $this->createPermissions($table,'WEBSITE');

        $table='website_news';
        $this->createPermissions($table,'WEBSITE');

        $table='website_news_cats';
        $this->createPermissions($table,'WEBSITE');

        $table='website_sections';
        $this->createPermissions($table,'WEBSITE');

        $table='website_section_cats';
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


        $record=new Permission;
        $record->name="CAMBIAR CONFIGURACIÓN";
        $record->slug='users.changeannosession';
        $record->description="PERMITE CAMBIAR DE SESIÓN";
        $record->group=$this->getGroupID('ESPECIALES');
        $record->save();
        $record->allowedActions()->create([ 'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false,
                                        ]);

        $record=new Permission;
        $record->name="ACTIVAR/DESACTIVAR REGISTROS EN OTROS AÑOS";
        $record->slug='records.activateanno';
        $record->description="PERMITE ACTIVAR O DESACTIVAR REGISTROS PARA PASARLOS DE AÑO";
        $record->group=$this->getGroupID('ESPECIALES');
        $record->save();
        $record->allowedActions()->create([ 'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false,
                                        ]);

        $record=new Permission;
        $record->name="CAMBIAR PRIORIDAD";
        $record->slug='records.changepriority';
        $record->description="PERMITE CAMBIAR EL ORDEN DE PRIORIDAD DE LOS REGISTROS";
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
        $record->name="BLOQUEAR REGISTROS";
        $record->slug=$table.'.lock';
        $record->description="PUEDE BLOQUEAR REGISTROS";
        $record->group=$this->getGroupID($group);
        $record->save();
        $record->allowedActions()->create([  'allowShow'     => false,
                                            'allowEdit'     => false,
                                            'allowDelete'   => false,
                                            'allowLock'     => false
                                        ]);

        $record=new Permission;
        $record->name="BLOQUEAR REGISTROS PROPIOS";
        $record->slug=$table.'.lock.owner';
        $record->description="BLOQUEAR SOLO LOS REGISTROS CREADOS POR EL USUARIO";
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
