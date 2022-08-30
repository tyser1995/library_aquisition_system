<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);


Route::get('user/{id}/avatar', function ($id) {
    // Find the user
    $user = App\Models\User::find(1);

    // Return the image in the response with the correct MIME type
    return response()->make($user->profile_photo, 200, array(
        'Content-Type' => (new finfo(FILEINFO_MIME))->buffer($user->profile_photo)
    ));
});

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('users', ['as' => 'users', 'uses' => 'App\Http\Controllers\UserController@index']);
	Route::resource('user', 'App\Http\Controllers\UserController');

    //Department Type
    Route::get('department_types', ['as' => 'department_types', 'uses' => 'App\Http\Controllers\DepartmentTypeController@index']);
    Route::get('department_types/data', ['as' => 'department_types/data', 'uses' => 'App\Http\Controllers\DepartmentTypeController@data']);
    Route::get('department_types/delete/{id}', ['as' => 'department_types/delete/{id}', 'uses' => 'App\Http\Controllers\DepartmentTypeController@delete']);
    Route::resource('department_type','App\Http\Controllers\DepartmentTypeController');
    //Department Name
    Route::get('department_names', ['as' => 'department_names', 'uses' => 'App\Http\Controllers\DepartmentNameController@index']);
    Route::get('department_names/data', ['as' => 'department_names/data', 'uses' => 'App\Http\Controllers\DepartmentNameController@data']);
    Route::resource('department_name','App\Http\Controllers\DepartmentNameController');

  	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
  	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
  	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'App\Http\Controllers\DashboardController@index']);

    Route::get('contacts', ['as' => 'contacts', 'uses' => 'App\Http\Controllers\ContactController@index']);
    //Route::get('contact/get_contacts', ['as' => 'country/get_countries', 'uses' => 'App\Http\Controllers\ContactController@getCountries']);
    Route::resource('contact', 'App\Http\Controllers\ContactController');

    //Roles
    Route::get('roles', ['as' => 'roles', 'uses' => 'App\Http\Controllers\RoleController@index']);
    Route::resource('role', 'App\Http\Controllers\RoleController');
});

Route::group(['middleware' => 'auth'], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});