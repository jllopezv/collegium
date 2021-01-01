<?php

    use Illuminate\Support\Facades\Auth;
    use Carbon\Carbon;


    // To Debug. Imitate delay com

    if (! function_exists('delayCom')) {

        function delayCom()
        {
            for($i=0,$a=0;$i<1000000000;$i++) $a=$a+$i;
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

    if (! function_exists('getDate')) {

        /**
         * getDate
         *
         * @param  Carbon $carbondate
         * @return void
         */
        function getDate( $carbondate )
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

        function getImage($image) {

            if ($image!="")
            {
                // THUMB?
                if ( file_exists(Storage::disk(config('lopsoft.filemanager_disk'))->path('thumbs'.DIRECTORY_SEPARATOR.config('lopsoft.filemanager_storage_folder').DIRECTORY_SEPARATOR.$image)))
                {
                    return (Storage::disk(config('lopsoft.filemanager_disk'))->url('thumbs'.DIRECTORY_SEPARATOR.config('lopsoft.filemanager_storage_folder').DIRECTORY_SEPARATOR.$image));
                }
                if ( file_exists(Storage::disk(config('lopsoft.filemanager_disk'))->path(config('lopsoft.filemanager_storage_folder').DIRECTORY_SEPARATOR.$image)))
                {
                    return (Storage::disk(config('lopsoft.filemanager_disk'))->url(config('lopsoft.filemanager_storage_folder').DIRECTORY_SEPARATOR.$image));
                }
            }

            return Storage::disk(config('lopsoft.filemanager_disk'))->url('fileicons'.DIRECTORY_SEPARATOR.'default_image.png');
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




