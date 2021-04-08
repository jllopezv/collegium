<?php

use App\Models\User;
use App\Lopsoft\LopHelp;
use App\Models\Auth\Role;
use App\Models\Aux\Color;
use App\Models\Aux\Image;

use App\Models\Aux\Country;
use App\Models\School\Anno;
use App\Models\Aux\Language;
use App\Models\School\Student;
use App\Models\Auth\Permission;
use App\Models\School\SchoolBatch;
use App\Models\School\SchoolGrade;
use App\Models\School\SchoolLevel;
use App\Models\Setting\AppSetting;
use App\Models\School\SchoolParent;
use App\Models\Setting\ModelConfig;
use App\Models\Website\WebsiteMenu;
use App\Models\Website\WebsitePage;
use App\Models\Website\WebsitePost;
use App\Models\Auth\PermissionGroup;
use App\Models\School\SchoolSection;
use App\Models\School\SchoolModality;
use App\Models\Website\WebsiteBanner;
use Illuminate\Support\Facades\Route;
use App\Models\Setting\AppSettingPage;
use App\Models\Website\WebsitePostCat;
use App\Models\Website\WebsiteAdvertisement;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Aux\ColorController;
use App\Http\Controllers\Aux\ImageController;
use App\Http\Controllers\Aux\CountryController;
use App\Http\Controllers\School\AnnoController;
use App\Models\Website\WebsiteAdvertisementCat;
use App\Http\Controllers\Aux\LanguageController;
use App\Http\Controllers\School\StudentController;
use App\Http\Controllers\Auth\PermissionController;
use App\Http\Controllers\School\SchoolBatchController;
use App\Http\Controllers\School\SchoolGradeController;
use App\Http\Controllers\School\SchoolLevelController;
use App\Http\Controllers\Setting\AppSettingController;
use App\Http\Controllers\School\SchoolParentController;
use App\Http\Controllers\Setting\ModelConfigController;
use App\Http\Controllers\Website\WebsiteMenuController;
use App\Http\Controllers\Website\WebsitePageController;
use App\Http\Controllers\Website\WebsitePostController;
use App\Http\Controllers\Auth\PermissionGroupController;
use App\Http\Controllers\School\SchoolSectionController;
use App\Http\Controllers\School\SchoolModalityController;
use App\Http\Controllers\Website\WebsiteBannerController;
use App\Http\Controllers\Setting\AppSettingPageController;
use App\Http\Controllers\Website\WebsitePostCatController;
use App\Http\Controllers\Website\WebsiteAdvertisementController;
use App\Http\Controllers\Website\WebsiteAdvertisementCatController;

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


/* ENTRY POINT */
Route::get('/', function () {
    return view('website.welcome');
});


/* TEST ROUTES */
Route::get('/checkcache',  function () {
    return view('checkcache');
});

Route::get('/testpaths', function () {
    return view('testpaths');
});

Route::get('/testpage', function() {
    return view('testpage');
})->name('testpage');

Route::get('/fm', function () {
    return view('lopsoft.filemanager.browser');
})->middleware('permission:filemanager')->name('filemanager.browser');

Route::get('/testfm', function () {
    return view('testfm');
})->middleware('permission:filemanager')->name('filemanager.test');

Route::get('/phpinfo', function () {
    return phpinfo();
})->middleware('auth')->name('php.info');

/*****************************************************/
/* ADMIN                                             */
/*****************************************************/

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/profile', function() {
    return view('lopsoft.auth.profile');
})->name('profile');

Route::post('/changeannosession/{id}', [ AnnoController::class, 'changeAnnoSession' ])->name('changeannosession')->middleware('auth');

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
    LopHelp::generateCommonModelRoute('school_sections', SchoolSectionController::class, SchoolSection::class);
    LopHelp::generateCommonModelRoute('school_batches', SchoolBatchController::class, SchoolBatch::class);
    LopHelp::generateCommonModelRoute('school_modalities', SchoolModalityController::class, SchoolModality::class);
    LopHelp::generateCommonModelRoute('school_parents', SchoolParentController::class, SchoolParent::class);




    Route::get('/showstudentslevel/{id}', function($id) {
        return view('school.showstudentslevel', ['id' => $id]);
    })->name('showstudentslevel');
    Route::get('/showstudentsgrade/{id}', function($id) {
        return view('school.showstudentsgrade', ['id' => $id]);
    })->name('showstudentsgrade');
    Route::get('/showstudentsanno/{id}', function($id) {
        return view('school.showstudentsanno', ['id' => $id]);
    })->name('showstudentsanno');
});


/*****************************************************/
/* SETTINGS                                          */
/*****************************************************/

Route::group( [ 'prefix'        => config('lopsoft.prefix_admin'),
                'middleware'    => ['web', 'auth', 'verified'],
                'namespace'     => '\App\Http\Controllers\Setting' ], function() {

    LopHelp::generateCommonModelRoute('app_setting_pages', AppSettingPageController::class, AppSettingPage::class);
    LopHelp::generateCommonModelRoute('app_settings', AppSettingController::class, AppSetting::class);
    LopHelp::generateCommonModelRoute('model_configs', ModelConfigController::class, ModelConfig::class);

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
    LopHelp::generateCommonModelRoute('images', ImageController::class, Image::class);

});

/*****************************************************/
/* WEBSITE                                           */
/*****************************************************/

Route::group( [ 'prefix'        => config('lopsoft.prefix_admin'),
                'middleware'    => ['web', 'auth', 'verified'],
                'namespace'     => '\App\Http\Controllers\Website' ], function() {

    LopHelp::generateCommonModelRoute('website_post_cats', WebsitePostCatController::class, WebsitePostCat::class);
    LopHelp::generateCommonModelRoute('website_posts', WebsitePostController::class, WebsitePost::class);
    LopHelp::generateCommonModelRoute('website_banners', WebsiteBannerController::class, WebsiteBanner::class);
    LopHelp::generateCommonModelRoute('website_pages', WebsitePageController::class, WebsitePage::class);
    LopHelp::generateCommonModelRoute('website_menus', WebsiteMenuController::class, WebsiteMenu::class);
    LopHelp::generateCommonModelRoute('website_advertisement_cats', WebsiteAdvertisementCatController::class, WebsiteAdvertisementCat::class);
    LopHelp::generateCommonModelRoute('website_advertisements', WebsiteAdvertisementController::class, WebsiteAdvertisement::class);

});

