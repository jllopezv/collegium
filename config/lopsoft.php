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
    'debug_mode'            =>  true,
    'copyright'             =>  '(C) Lopsoft 2020',
    'vendorlink'            =>  'https://lopsoft.com',
    'vendorweb'             =>  'www.lopsoft.com',
    'vendorlogo_overblack'  =>  'system/vendorlogo_bgblack.png',
    'vendorlogo'            =>  'system/vendorlogo.png',
    'prefix_admin'          =>  'admin',
    'timeout_ckeditor'      =>  2000,           //  It dependes of webserver
    'entrypoint_website'    =>  false,

    /*
    |--------------------------------------------------------------------------
    | Emails
    |--------------------------------------------------------------------------
    |
    */
    'email_from'              =>  'collegium@lopsoft.com',
    'email_from_name'         =>  'COLLEGIUM',
    'email_to'                =>  'jllopezvicente@gmail.com',



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
    'maintenance_mode'      =>  false,


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

    'default_avatar'        => 'defaults/userdefault.png',
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
    'users_defaultpassword' =>  '123456',
    'emails_generate_domain'=>  'tiasandraschool.com',

    /*
    |--------------------------------------------------------------------------
    | Modules
    |--------------------------------------------------------------------------
    |
    */

    'module_school'         =>  true,

    /*
    |--------------------------------------------------------------------------
    | Students
    |--------------------------------------------------------------------------
    |
    */

    'studentsname_uppercase'      =>  true,
    'students_exp_prefix'         =>  'EXP',
    'students_exp_long'           =>  '5',
    'students_exp_sufix'          =>  '',

    /*
    |--------------------------------------------------------------------------
    | Customers
    |--------------------------------------------------------------------------
    |
    */

    'customersname_uppercase'      =>  true,
    'customers_code_prefix'         =>  'C',
    'customers_code_long'           =>  '5',
    'customers_code_sufix'          =>  '',
    'customers_avatar'             =>  true,

    /*
    |--------------------------------------------------------------------------
    | Suppliers
    |--------------------------------------------------------------------------
    |
    */

    'suppliersname_uppercase'      =>  true,
    'suppliers_code_prefix'         =>  'S',
    'suppliers_code_long'           =>  '5',
    'suppliers_code_sufix'          =>  '',
    'suppliers_avatar'             =>  true,

    /*
    |--------------------------------------------------------------------------
    | Invoices
    |--------------------------------------------------------------------------
    |
    */

    'invoices_ref_prefix'                   =>  'F',
    'invoices_ref_long'                     =>  '5',
    'invoices_ref_sufix'                    =>  '',
    'invoices_quantity_decimals'            =>  2,

    /*
    |--------------------------------------------------------------------------
    | Website
    |--------------------------------------------------------------------------
    |
    */

    'website_maintenance_mode'              =>   false,
    'website_maintenance_mode_page_name'    =>  'WEBSITE_MAINTENANCE_MODE_PAGE',

    /*
    |--------------------------------------------------------------------------
    | Posts
    |--------------------------------------------------------------------------
    |
    */

    'posts_default_width'           => 800,
    'posts_default_height'          => 600,
    'posts_default_image'           => 'defaults/default_image.png',
    'posts_index_showthumb'         => false,

    /*
    |--------------------------------------------------------------------------
    | Advertisements
    |--------------------------------------------------------------------------
    |
    */

    'advertisements_default_width'           => 1500,
    'advertisements_default_height'          => 500,
    'advertisements_default_image'           => 'defaults/default_image.png',
    'advertisements_index_showthumb'         => true,
    'advertisements_to_show'                 => 8,

    /*
    |--------------------------------------------------------------------------
    | News
    |--------------------------------------------------------------------------
    |
    */

    'news_default_width'           => 1500,
    'news_default_height'          => 500,
    'news_default_image'           => 'defaults/default_image.png',
    'news_index_showthumb'         => false,
    'news_to_show'                 => 1,

    /*
    |--------------------------------------------------------------------------
    | Sections
    |--------------------------------------------------------------------------
    |
    */

    'sections_default_width'           => 1500,
    'sections_default_height'          => 500,
    'sections_default_image'           => 'defaults/default_image.png',
    'sections_index_showthumb'         => true,

    /*
    |--------------------------------------------------------------------------
    | Banners
    |--------------------------------------------------------------------------
    |
    */

    'banners_default_width'           => 1500,
    'banners_default_height'          => 500,
    'banners_default_image'           => 'defaults/default_image.png',
    'banners_index_showthumb'         => false,

    /*
    |--------------------------------------------------------------------------
    | Images
    |--------------------------------------------------------------------------
    |
    */

    'images_default_image'           => 'defaults/default_image.png',
    'images_index_showthumb'         => false,


    /*
    |--------------------------------------------------------------------------
    | Currency
    |--------------------------------------------------------------------------
    |
    */

    'currency_api'  => 'https://v6.exchangerate-api.com/v6/0905ec1bd05e22078f86294d/latest/',



];
