<?php

use App\Models\User;
use App\Lopsoft\LopHelp;
use App\Models\Auth\Role;
use App\Models\Aux\Color;
use App\Models\Aux\Country;

use App\Models\School\Anno;
use App\Models\Aux\Language;
use App\Models\School\Student;
use App\Models\Auth\Permission;
use App\Models\School\SchoolGrade;
use App\Models\School\SchoolLevel;
use App\Models\Setting\AppSetting;
use App\Models\Auth\PermissionGroup;
use Illuminate\Support\Facades\Route;
use App\Models\Setting\AppSettingPage;
use App\Models\Website\WebsitePostCat;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Aux\ColorController;
use App\Http\Controllers\Aux\CountryController;
use App\Http\Controllers\School\AnnoController;
use App\Http\Controllers\Aux\LanguageController;
use App\Http\Controllers\School\StudentController;
use App\Http\Controllers\Auth\PermissionController;
use App\Http\Controllers\School\SchoolGradeController;
use App\Http\Controllers\School\SchoolLevelController;
use App\Http\Controllers\Setting\AppSettingController;
use App\Http\Controllers\Auth\PermissionGroupController;
use App\Http\Controllers\Setting\AppSettingPageController;
use App\Http\Controllers\Website\WebsitePostCatController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/checkcache',  function () {
    return view('checkcache');
});

Route::get('/testpaths', function () {
    return view('testpaths');
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/testpage', function() {
    return view('testpage');
})->name('testpage');


Route::middleware(['auth:sanctum', 'verified'])->get('/profile', function() {
    return view('lopsoft.auth.profile');
})->name('profile');

Route::get('/fm', function () {
    return view('lopsoft.filemanager.browser');
})->middleware('permission:filemanager')->name('filemanager.browser');

Route::get('/testfm', function () {
    return view('testfm');
})->middleware('permission:filemanager')->name('filemanager.test');

/*****************************************************/
/* AUTENTICACIÓN                                     */
/*****************************************************/

Route::group( [ 'prefix'        => config('lopsoft.prefix_admin'),
                'middleware'    => ['web', 'auth', 'verified'],
                'namespace'     => '\App\Http\Controllers\Auth' ], function() {

    LopHelp::generateCommonModelRoute('permissions', PermissionController::class, Permission::class);
    LopHelp::generateCommonModelRoute('permission_groups', PermissionGroupController::class, PermissionGroup::class);
    LopHelp::generateCommonModelRoute('users', UserController::class, User::class);
    LopHelp::generateCommonModelRoute('roles', RoleController::class, Role::class);

});


/*****************************************************/
/* ACADÉMICA                                         */
/*****************************************************/

Route::group( [ 'prefix'        => config('lopsoft.prefix_admin'),
                'middleware'    => ['web', 'auth', 'verified'],
                'namespace'     => '\App\Http\Controllers\School' ], function() {

    LopHelp::generateCommonModelRoute('students', StudentController::class, Student::class);
    LopHelp::generateCommonModelRoute('school_levels', SchoolLevelController::class, SchoolLevel::class);
    LopHelp::generateCommonModelRoute('school_grades', SchoolGradeController::class, SchoolGrade::class);
    LopHelp::generateCommonModelRoute('annos', AnnoController::class, Anno::class);
});


/*****************************************************/
/* SETTINGS                                          */
/*****************************************************/

Route::group( [ 'prefix'        => config('lopsoft.prefix_admin'),
                'middleware'    => ['web', 'auth', 'verified'],
                'namespace'     => '\App\Http\Controllers\Setting' ], function() {

    LopHelp::generateCommonModelRoute('app_setting_pages', AppSettingPageController::class, AppSettingPage::class);
    LopHelp::generateCommonModelRoute('app_settings', AppSettingController::class, AppSetting::class);

    Route::get('settings', function () {
        return view('lopsoft.settings');
    })->middleware('permission:app.settings')->name('app.settings');

});

/*****************************************************/
/* AUXILIARES                                        */
/*****************************************************/

Route::group( [ 'prefix'        => config('lopsoft.prefix_admin'),
                'middleware'    => ['web', 'auth', 'verified'],
                'namespace'     => '\App\Http\Controllers\Aux' ], function() {

    LopHelp::generateCommonModelRoute('colors', ColorController::class, Color::class);
    LopHelp::generateCommonModelRoute('countries', CountryController::class, Country::class);
    LopHelp::generateCommonModelRoute('languages', LanguageController::class, Language::class);

});

/*****************************************************/
/* WEBSITE                                           */
/*****************************************************/

Route::group( [ 'prefix'        => config('lopsoft.prefix_admin'),
                'middleware'    => ['web', 'auth', 'verified'],
                'namespace'     => '\App\Http\Controllers\Website' ], function() {

    LopHelp::generateCommonModelRoute('website_post_cats', WebsitePostCatController::class, WebsitePostCat::class);

});

