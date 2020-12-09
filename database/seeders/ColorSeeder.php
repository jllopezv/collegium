<?php

namespace Database\Seeders;

use App\Models\Aux\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $color=new Color;
        $color->name='azul';
        $color->textcolor='white';
        $color->background='blue-400';
        $color->save();
        $color->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);

        $color=new Color;
        $color->name='rojo';
        $color->textcolor='white';
        $color->background='red-400';
        $color->save();
        $color->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);

        $color=new Color;
        $color->name='verde';
        $color->textcolor='white';
        $color->background='green-400';
        $color->save();
        $color->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);

        $color=new Color;
        $color->name='amarillo';
        $color->textcolor='yellow-400';
        $color->background='yellow-100';
        $color->save();
        $color->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);

        $color=new Color;
        $color->name='rosa';
        $color->textcolor='white';
        $color->background='pink-400';
        $color->save();
        $color->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);

        $color=new Color;
        $color->name='indigo';
        $color->textcolor='white';
        $color->background='indigo-500';
        $color->save();
        $color->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);

        $color=new Color;
        $color->name='gris';
        $color->textcolor='white';
        $color->background='gray-500';
        $color->save();
        $color->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);

        $color=new Color;
        $color->name='grisazul';
        $color->textcolor='white';
        $color->background='cool-gray-400';
        $color->save();
        $color->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);

        $color=new Color;
        $color->name='naranja';
        $color->textcolor='white';
        $color->background='orange-400';
        $color->save();
        $color->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);

        $color=new Color;
        $color->name='negro';
        $color->textcolor='white';
        $color->background='black';
        $color->save();
        $color->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);

        $color=new Color;
        $color->name='blanco';
        $color->textcolor='black';
        $color->background='white';
        $color->save();
        $color->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);

        $color=new Color;
        $color->name='aguamarina';
        $color->textcolor='white';
        $color->background='teal-400';
        $color->save();
        $color->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);

        $color=new Color;
        $color->name='púrpura';
        $color->textcolor='white';
        $color->background='purple-400';
        $color->save();
        $color->allowedActions()->create([  'allowShow'     => false,
                                             'allowEdit'     => false,
                                             'allowDelete'   => false,
                                             'allowLock'     => false
                                        ]);
    }
}
