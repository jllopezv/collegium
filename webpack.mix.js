const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);

mix.copyDirectory('resources/css/lib', 'public/css/lib');

mix.copyDirectory('resources/js/lib', 'public/js/lib');

mix.scripts([
    'resources/js/lopsoft/common.js',
    'resources/js/lopsoft/sidebar.js',
    'resources/js/lopsoft/notifications.js',
    ], 'public/js/lopsoft.js');

mix.styles([
    'resources/css/lopsoft/customnoty.css',
    'resources/css/lopsoft/customckeditor.css',
], 'public/css/lopsoft.css');



/* Website */

mix.styles([
    'resources/css/website/navigation.css',
    'resources/css/website/menu.css',
    'resources/css/website/website.css',
], 'public/css/website.css');
