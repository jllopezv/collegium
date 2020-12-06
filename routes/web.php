<?php

use App\Models\User;
use App\Lopsoft\LopHelp;
use App\Models\Auth\Role;
use App\Models\Aux\Color;
use App\Models\Aux\Country;

use App\Models\Aux\Language;
use App\Models\School\Student;
use App\Models\Auth\Permission;
use Illuminate\Support\Facades\App;
use App\Models\Auth\PermissionGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Aux\ColorController;
use App\Http\Controllers\Aux\CountryController;
use App\Http\Controllers\Aux\LanguageController;
use App\Http\Controllers\School\StudentController;
use App\Http\Controllers\Auth\PermissionController;
use App\Http\Controllers\Auth\PermissionGroupController;

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


/*****************************************************/
/* AUTENTICACIÓN                                     */
/*****************************************************/

Route::group( [ 'prefix'        => '/admin',
                'middleware'    => ['web', 'auth', 'verified'],
                'namespace'     => '\App\Http\Controllers\Auth' ], function() {

    LopHelp::generateCommonModelRoute('permissions', PermissionController::class, Permission::class);
    LopHelp::generateCommonModelRoute('permission_groups', PermissionGroupController::class, PermissionGroup::class);
    LopHelp::generateCommonModelRoute('users', UserController::class, User::class);
    LopHelp::generateCommonModelRoute('roles', RoleController::class, Role::class);
    LopHelp::generateCommonModelRoute('students', StudentController::class, Student::class);

});

/*****************************************************/
/* AUXILIARES                                        */
/*****************************************************/

Route::group( [ 'prefix'        => '/admin',
                'middleware'    => ['web', 'auth', 'verified'],
                'namespace'     => '\App\Http\Controllers\Aux' ], function() {

    LopHelp::generateCommonModelRoute('colors', ColorController::class, Color::class);
    LopHelp::generateCommonModelRoute('countries', CountryController::class, Country::class);
    LopHelp::generateCommonModelRoute('languages', LanguageController::class, Language::class);

});

