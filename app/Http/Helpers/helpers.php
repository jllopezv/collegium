<?php

    use Illuminate\Support\Facades\Auth;
    use Carbon\Carbon;

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




