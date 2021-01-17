<?php

return [

    /*
    |--------------------------------------------------------------------------
    | System
    |--------------------------------------------------------------------------
    |
    */

    'version'               =>  '0.1',
    'vendor'                =>  'lopsoft',
    'copyright'             =>  '(C) Lopsoft 2020',
    'vendorlink'            =>  'https://lopsoft.com',
    'vendorweb'             =>  'www.lopsoft.com',
    'vendorlogo_overblack'  =>  'system/vendorlogo_bgblack.png',
    'vendorlogo'            =>  'system/vendorlogo.png',
    'prefix_admin'          =>  'admin',

    /*
    |--------------------------------------------------------------------------
    | Date
    |--------------------------------------------------------------------------
    |
    */
    'country_default'       =>  'DOMINICAN REPUBLIC',
    'timezone_default'      =>  'America/Santo_Domingo',
    'locale_default'        =>  'es',
    'firstweekday'          =>  1,  // Monday
    'date_format'           =>  'd/m/Y',
    'time_format'           =>  'hh:mm',

    /*
    |--------------------------------------------------------------------------
    | Activities
    |--------------------------------------------------------------------------
     */

    'maxActivityLog'    =>  2000,


    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    |
    */

    'title_line1'           =>  'CENTRO EDUCATIVO',
    'title_line2'           =>  'TIA SANDRA SCHOOL',
    'title_line1_class'     =>  'font-bold text-red-500 text-2xl',
    'title_line2_class'     =>  'font-bold text-red-500 text-2xl',
    'loginlogo'             =>  'system/logo.png',
    'showavatar'            =>  true,


     /*
    |--------------------------------------------------------------------------
    | Files
    |--------------------------------------------------------------------------
    |
    */

    'temp_disk'                 =>  'public',        // default
    'temp_dir'                  =>  'temp',         // Folder of disk public
    'garbagecollection_days'    =>  1,              // Days to let temp files



    /*
    |--------------------------------------------------------------------------
    | Files Manager
    |--------------------------------------------------------------------------
    |
    */
    'filemanager_disk'              =>  'public',
    'filemanager_storage_folder'    =>  'files',
    'filemanager_max_upload_size'   =>  8192,


     /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    |
    */

    'default_avatar'        => 'system/userdefault.png',
    'avatar_max_size'       => 5120, // 5Mb
    'ucAccess'              => true,        // Uppercase Access Models (users,roles)
    'maxLevelAdmin'         => 10,          // Maximun level for admins ( between 1 and maxLevelAdmin both includes)
    'maxlevelVIPUsers'      => 100,
    'progressRoleLevels'            => [
        [ 'min'   => 1,     'max'  => 1,        'color' => 'color-teal'     ],   // Superadmin
        [ 'min'   => 2,     'max'  => 10,       'color' => 'color-blue'     ],   // Admins
        [ 'min'   => 11,    'max'  => 100,      'color' => 'color-gray'     ],     // VIP Users
        [ 'min'   => 101,   'max'  => 5000,     'color' => 'color-gray'     ],     // Users
        [ 'min'   => 5001,  'max'  => 50000,    'color' => 'color-gray'     ],     // Services
    ],


    /*
    |--------------------------------------------------------------------------
    | System presets
    |--------------------------------------------------------------------------
    |
    */

    'default_paginate'      =>  15,
    'richeditor_timeout'    =>  2000, // 2s after change



    /*
    |--------------------------------------------------------------------------
    | Students
    |--------------------------------------------------------------------------
    |
    */

    'studentsname_uppercase'      =>  true,


    /*
    |--------------------------------------------------------------------------
    | Posts
    |--------------------------------------------------------------------------
    |
    */

    'posts_default_width'           => 800,
    'posts_default_height'          => 600,


];
