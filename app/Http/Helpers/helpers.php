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




