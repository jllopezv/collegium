<?php

use App\Models\School\Anno;
use App\Models\Setting\AppSetting;

    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Auth;
    use Carbon\Carbon;


    // To Debug. Imitate delay com

    if (! function_exists('delayCom')) {

        function delayCom()
        {
            for($i=0,$a=0;$i<1000000000;$i++) $a=$a+$i;
        }
    }

    // Config

    if (! function_exists('appsetting'))
    {
        function appsetting($key)
        {
            $cfg=AppSetting::where('settingkey', $key)->first();
            if (is_null($cfg)) return config('lopsoft.'.$key);
            if ($cfg->type=='boolean')
            {
                return $cfg->settingvalue=='true'?true:false;
            }
            return $cfg->settingvalue;
        }
    }

    // Carbon Helpers

    if (! function_exists('getNow')) {

        function getNow()
        {
            return Carbon::now()
                        ->setTimezone( Auth::user()->timezone->name??config('lopsoft.timezone_default') )
                        ->locale( Auth::user()->language->code??config('lopsoft.locale_default') )
                        ->format( Auth::user()->dateformat??config('lopsoft.date_format') );
        }
    }

    if (! function_exists('getNowFile')) {

        function getNowFile()
        {
            return Carbon::now()
                        ->setTimezone( Auth::user()->timezone->name??config('lopsoft.timezone_default') )
                        ->locale( Auth::user()->language->code??config('lopsoft.locale_default') )
                        ->format( 'YmdHisv' );
        }
    }

    if (! function_exists('getToday')) {

        function getToday()
        {
            return Carbon::today(Auth::user()->timezone->name??config('lopsoft.timezone_default'))
                        ->locale( Auth::user()->language->code??config('lopsoft.locale_default') );
        }
    }

    if (! function_exists('getDateFromDate')) {

        function getDateFromDate( $year, $month, $day )
        {
            return Carbon::createFromDate($year, $month, $day, Auth::user()->timezone->name??config('lopsoft.timezone_default'))
                    ->locale( Auth::user()->language->code??config('lopsoft.locale_default') );
        }
    }

    if (! function_exists('getDateFromFormat')) {

        function getDateFromFormat( $value, $format='' )
        {
            if ($format=='') $format=Auth::user()->dateformat??config('lopsoft.date_format');
            return Carbon::createFromFormat($format, $value,Auth::user()->timezone->name??config('lopsoft.timezone_default') )
                ->locale( Auth::user()->language->code??config('lopsoft.locale_default') );
        }
    }

    if (! function_exists('getDateCarbon')) {

        /**
         * getDate
         *
         * @param  Carbon $carbondate
         * @return void
         */
        function getDateCarbon( $carbondate )
        {
            return $carbondate->setTimezone( Auth::user()->timezone->name??config('lopsoft.timezone_default') )
                        ->locale( Auth::user()->language->code??config('lopsoft.locale_default') )
                        ->format( Auth::user()->dateformat??config('lopsoft.date_format') );
        }
    }

    if (! function_exists('getDateString')) {

        /**
         * getDate
         *
         * @param  Carbon $carbondate
         * @return void
         */
        function getDateString( $carbondate )
        {
            if ($carbondate==null) return getNow();
            return $carbondate->format( Auth::user()->dateformat??config('lopsoft.date_format') );
        }
    }

    if (! function_exists('getAge')) {

        /**
         * getDate
         *
         * @param  Carbon $carbondate
         * @return void
         */
        function getAge( $carbondate )
        {
            return $carbondate->diff(\Carbon\Carbon::now())->format('%y '.transup('years'));
        }
    }

    if (! function_exists('getHiredTime')) {

        /**
         * getDate
         *
         * @param  Carbon $carbondate
         * @return void
         */
        function getHiredTime( $carbondate )
        {
            return $carbondate->diff(\Carbon\Carbon::now())->format('%y '.transup('years'). ' %m '.transup('months'). ' %d '.transup('days'));
        }
    }

    if (! function_exists('getAgo')) {

        /**
         * getDate
         *
         * @param  Carbon $carbondate
         * @return void
         */
        function getAgo( $carbondate )
        {
            return $carbondate->diffForHumans();
        }
    }


    // Files
    if (! function_exists('humanFileSize')) {

        function humanFileSize($size,$unit="") {
            if( (!$unit && $size >= 1<<30) || $unit == "GB")
            return number_format($size/(1<<30),2)."GB";
            if( (!$unit && $size >= 1<<20) || $unit == "MB")
            return number_format($size/(1<<20),2)."MB";
            if( (!$unit && $size >= 1<<10) || $unit == "KB")
            return number_format($size/(1<<10),2)."KB";
            return number_format($size)." bytes";
        }

    }

    // Images from filemanager

    if (! function_exists('getImage')) {

        function getImage($image,$getthumb=true)
        {
            // Example:   /2/folder/image.jpg
            if ($image!="")
            {
                // THUMB?
                if ( $getthumb && file_exists(Storage::disk(config('lopsoft.filemanager_disk'))->path('thumbs/'.$image)))
                {
                    return (Storage::disk(config('lopsoft.filemanager_disk'))->url('thumbs/'.$image));
                }
                if ( file_exists(Storage::disk(config('lopsoft.filemanager_disk'))->path($image)))
                {
                    return (Storage::disk(config('lopsoft.filemanager_disk'))->url($image));
                }
            }

            return Storage::disk(config('lopsoft.filemanager_disk'))->url('fileicons'.DIRECTORY_SEPARATOR.'default_image.png');
        }

    }

    if (! function_exists('getImageUrl')) {

        function getImageUrl($image,$getthumb=true)
        {
           return getImage(Str::after($image,Storage::disk(config('lopsoft.filemanager_disk'))->url('')), $getthumb);
        }

    }


    // Translate

    if (! function_exists('translate')) {

        function translate( $s )
        {
            return __('lopsoft.'.$s);
        }
    }

    if (! function_exists('transup')) {

        function transup( $s )
        {
            return mb_strtoupper(__('lopsoft.'.$s));
        }
    }

    if (! function_exists('transdown')) {

        function transdown( $s )
        {
            return mb_strtolower(__('lopsoft.'.$s));
        }
    }


    // Generate Emails

    if (! function_exists('generateAppEmail')) {

        function generateAppEmail( $email )
        {
            return $email."@".config('lopsoft.emails_generate_domain');
        }
    }


    // Strings

    if (! function_exists('withoutAccents')) {

        function withoutAccents( $str )
        {
            $str=str_replace('á','a', $str);
            $str=str_replace('é','e', $str);
            $str=str_replace('í','i', $str);
            $str=str_replace('ó','o', $str);
            $str=str_replace('ú','u', $str);
            $str=str_replace('Á','A', $str);
            $str=str_replace('É','E', $str);
            $str=str_replace('Í','I', $str);
            $str=str_replace('Ó','O', $str);
            $str=str_replace('Ú','U', $str);
            return $str;
        }
    }

    // Anno

    if (! function_exists('getUserAnnoSession')) {

        function getUserAnnoSession()
        {
            $useranno=Auth::check()?Auth::user()->anno:null;
            if ($useranno==null) $useranno=(new Anno)->current();   // By default the current Anno
            return $useranno;
        }
    }

    if (! function_exists('getUserAnnoSessionId')) {

        function getUserAnnoSessionId()
        {
            $anno=getUserAnnoSession();
            if ($anno==null) return 0;
            return $anno->id;
        }
    }

    if (! function_exists('getAnnoSessionId')) {

        function getAnnoSessionId($anno_id=null)
        {
            if (!$anno_id==null) return Anno::find($anno_id)->id;
            $anno=getUserAnnoSession();
            if ($anno==null) return 0;
            return $anno->id;
        }
    }


    // Phones and emails

    if (! function_exists('getPhones')) {

        function getPhones($phones)
        {
            $retphones=[];
            foreach($phones as $phone)
            {
                $retphones[]=[
                    'id'            =>  $phone->id,
                    'phone'         =>  $phone->phone,
                    'description'   =>  $phone->description,
                ];
            }
            return $retphones;
        }
    }

    if (! function_exists('getEmails')) {

        function getEmails($emails)
        {
            $retemails=[];
            foreach($emails as $email)
            {
                $retemails[]=[
                    'id'            =>  $email->id,
                    'email'         =>  $email->email,
                    'description'   =>  $email->description,
                    'notif'         =>  $email->notif,
                ];
            }
            return $retemails;
        }
    }

    if (! function_exists('getInvoiceLines')) {

        function getInvoiceLines($lines)
        {
            $retlines=[];
            foreach($lines as $line)
            {
                $retlines[]=[
                    'id'            =>  $line->id,
                    'code'         =>  $line->code,
                    'item'   =>  $line->item,
                ];
            }
            return $retlines;
        }
    }







