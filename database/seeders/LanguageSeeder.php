<?php

namespace Database\Seeders;

use App\Models\Aux\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record=new Language;
        $record->language="Spanish";
        $record->code='es';
        $record->save();
        $record->allowedActions()->create([     'allowShow'     => false,
                                                'allowEdit'     => false,
                                                'allowDelete'   => false,
                                                'allowLock'     => false
                                        ]);
        $record->setTranslation('language', 'es', mb_strtoupper('Español') );

        $record=new Language;
        $record->language="English";
        $record->code='en';
        $record->save();
        $record->allowedActions()->create([     'allowShow'     => false,
                                                'allowEdit'     => false,
                                                'allowDelete'   => false,
                                                'allowLock'     => false
                                        ]);

        $record->setTranslation('language', 'es', mb_strtoupper('Inglés') );

    }
}
