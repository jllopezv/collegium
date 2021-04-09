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




        /* WEBSITE */

        $record=new AppSetting();
        $record->settingkey='WEBSITE_LOGO_SMALL';
        $record->settingdesc='WEBSITE LOGO IN SMALL SIZE';
        $record->settingvalue='';
        $record->type='image';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','WEBSITE')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='WEBSITE_LOGO';
        $record->settingdesc='WEBSITE LOGO';
        $record->settingvalue='';
        $record->type='image';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','WEBSITE')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='WEBSITE_BUSINESS_NAME';
        $record->settingdesc='WEBSITE BUSINESS NAME';
        $record->settingvalue='TIA SANDRA SCHOOL';
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','WEBSITE')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='WEBSITE_BUSINESS_ADDRESS1';
        $record->settingdesc='WEBSITE BUSINESS ADDRESS1';
        $record->settingvalue='LAS MARGARITAS, ESQ. LAS VIOLETAS';
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','WEBSITE')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='WEBSITE_BUSINESS_ADDRESS2';
        $record->settingdesc='WEBSITE BUSINESS ADDRESS2';
        $record->settingvalue='BAVARO - LA ALTAGRACIA - REP. DOMINICANA';
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','WEBSITE')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='WEBSITE_BANNER_MAIN';
        $record->settingdesc='WEBSITE MAIN BANNER';
        $record->settingvalue='MAINBANNER';
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','WEBSITE')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='WEBSITE_PHONE_MAIN';
        $record->settingdesc='WEBSITE MAIN PHONE';
        $record->settingvalue='XXX-XXX-XXXX';
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','WEBSITE')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='WEBSITE_EMAIL_MAIN';
        $record->settingdesc='WEBSITE MAIN EMAIL';
        $record->settingvalue='email@domain.com';
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','WEBSITE')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='WEBSITE_WHATSAPP_MAIN';
        $record->settingdesc='WEBSITE MAIN WHATSAPP NUMBER';
        $record->settingvalue='XXX-XXX-XXXX';
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','WEBSITE')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='WEBSITE_SOCIAL_FACEBOOK';
        $record->settingdesc='WEBSITE SOCIAL FACEBOOK';
        $record->settingvalue='FACEBOOK';
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','WEBSITE')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='WEBSITE_SOCIAL_INSTAGRAM';
        $record->settingdesc='WEBSITE SOCIAL INSTAGRAM';
        $record->settingvalue='INSTAGRAM';
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','WEBSITE')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='WEBSITE_SOCIAL_TWITTER';
        $record->settingdesc='WEBSITE SOCIAL TWITTER';
        $record->settingvalue='TWITTER';
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','WEBSITE')->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='WEBSITE_SOCIAL_YOUTUBE';
        $record->settingdesc='WEBSITE SOCIAL YOUTUBE';
        $record->settingvalue='YOUTUBE';
        $record->type='text';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage','WEBSITE')->first()->id;
        $record->save();

        /* POSTS */

        $record=new AppSetting();
        $record->settingkey='POSTS_DEFAULT_WIDTH';
        $record->settingdesc='POST WIDTH';
        $record->settingvalue=config('lopsoft.posts_default_width');
        $record->type='number';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage',transup('posts'))->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='POSTS_DEFAULT_HEIGHT';
        $record->settingdesc='POST HEIGHT';
        $record->settingvalue=config('lopsoft.posts_default_height');
        $record->type='number';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage',transup('posts'))->first()->id;
        $record->save();

        /* ADVERTISEMENTS */

        $record=new AppSetting();
        $record->settingkey='ADVERTISEMENTS_DEFAULT_WIDTH';
        $record->settingdesc='ADVERTISEMENT WIDTH';
        $record->settingvalue=config('lopsoft.advertisements_default_width');
        $record->type='number';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage',transup('advertisements'))->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='ADVERTISEMENTS_DEFAULT_HEIGHT';
        $record->settingdesc='ADVERTISEMENT HEIGHT';
        $record->settingvalue=config('lopsoft.advertisements_default_height');
        $record->type='number';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage',transup('advertisements'))->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='ADVERTISEMENTS_TO_SHOW';
        $record->settingdesc='ADVERTISEMENTS TO SHOW IN WEBSITE';
        $record->settingvalue=config('lopsoft.advertisements_to_show');
        $record->type='number';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage',transup('advertisements'))->first()->id;
        $record->save();

        /* NEWS */

        $record=new AppSetting();
        $record->settingkey='NEWS_DEFAULT_WIDTH';
        $record->settingdesc='NEWS WIDTH';
        $record->settingvalue=config('lopsoft.news_default_width');
        $record->type='number';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage',transup('news'))->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='NEWS_DEFAULT_HEIGHT';
        $record->settingdesc='NEWS HEIGHT';
        $record->settingvalue=config('lopsoft.news_default_height');
        $record->type='number';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage',transup('news'))->first()->id;
        $record->save();

        $record=new AppSetting();
        $record->settingkey='NEWS_TO_SHOW';
        $record->settingdesc='NEWS TO SHOW IN WEBSITE';
        $record->settingvalue=config('lopsoft.news_to_show');
        $record->type='number';
        $record->level=1;
        $record->page_id=AppSettingPage::where('settingpage',transup('news'))->first()->id;
        $record->save();


    }
}
