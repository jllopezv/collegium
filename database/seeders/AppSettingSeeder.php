<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting\AppSetting;
use App\Models\Setting\AppSettingPage;

class AppSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record=new AppSetting();
        $record->settingkey='VERSION';
        $record->settingdesc='APPLICATION VERSION';
        $record->settingvalue=config('lopsoft.version');
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','SISTEMA')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='VENDOR';
        $record->settingdesc='VENDOR NAME';
        $record->settingvalue=config('lopsoft.vendor');
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','SISTEMA')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='VENDORLINK';
        $record->settingdesc='LINK TO VENDOR WEBSITE';
        $record->settingvalue=config('lopsoft.vendorlink');
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','SISTEMA')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='VENDORWEB';
        $record->settingdesc='VENDOR WEBSITE';
        $record->settingvalue=config('lopsoft.vendorweb');
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','SISTEMA')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='VENDORLOGO_OVERBLACK';
        $record->settingdesc='LOGO DE LA APLICACIÓN EN FONDO NEGRO';
        $record->settingvalue=config('lopsoft.vendorlogo_overblack');
        $record->type='image';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','SISTEMA')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='VENDORLOGO';
        $record->settingdesc='LOGO DE LA APLICACIÓN';
        $record->settingvalue=config('lopsoft.vendorlogo');
        $record->type='image';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','SISTEMA')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='MAXACTIVITYLOG';
        $record->settingdesc='MAX LINES IN ACTIVITY LOG';
        $record->settingvalue=config('lopsoft.maxActivityLog');
        $record->type='number';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','SISTEMA')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='TITLE_LINE1';
        $record->settingdesc='LOGIN LINE1 TEXT';
        $record->settingvalue=config('lopsoft.title_line1');
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','LOGIN')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='TITLE_LINE1_CLASS';
        $record->settingdesc='LOGIN LINE1 TEXT CLASS';
        $record->settingvalue=config('lopsoft.title_line1_class');
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','LOGIN')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='TITLE_LINE2';
        $record->settingdesc='LOGIN LINE2 TEXT';
        $record->settingvalue=config('lopsoft.title_line2');
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','LOGIN')->first()->id;
        $record->save();


        $record=new AppSetting();
        $record->settingkey='TITLE_LINE2_CLASS';
        $record->settingdesc='LOGIN LINE2 TEXT CLASS';
        $record->settingvalue=config('lopsoft.title_line2_class');
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','LOGIN')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='LOGINLOGO';
        $record->settingdesc='LOGIN LOGO';
        $record->settingvalue=config('lopsoft.loginlogo');
        $record->type='image';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','LOGIN')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='SHOWAVATAR';
        $record->settingdesc='MUST SHOW AVATAR USER';
        $record->settingvalue=config('lopsoft.showavatar')?'true':'false';
        $record->type='boolean';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','LOGIN')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='POSTS_DEFAULT_WIDTH';
        $record->settingdesc='POST WIDTH';
        $record->settingvalue=config('lopsoft.posts_default_width');
        $record->type='number';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','POSTS')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='POSTS_DEFAULT_HEIGHT';
        $record->settingdesc='POST HEIGHT';
        $record->settingvalue=config('lopsoft.posts_default_height');
        $record->type='number';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','POSTS')->first()->id;
        $record->save();


    }
}
