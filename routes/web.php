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
    Route::get('users/delete/{id}', ['as' => 'users/delete/{id}', 'uses' => 'App\Http\Controllers\UserController@delete']);
	Route::resource('user', 'App\Http\Controllers\UserController');

    //User Management
    Route::get('employees', ['as' => 'employees', 'uses' => 'App\Http\Controllers\EmployeeController@index']);
    Route::get('employees/delete/{id}', ['as' => 'employees/delete/{id}', 'uses' => 'App\Http\Controllers\EmployeeController@delete']);
    Route::get('employees/data', ['as' => 'employees/data', 'uses' => 'App\Http\Controllers\EmployeeController@data']);
    Route::resource('employee','App\Http\Controllers\EmployeeController');
    //Request Management
    //Purchase Request
    Route::get('purchase_requests', ['as' => 'purchase_requests', 'uses' => 'App\Http\Controllers\PurchaseRequestController@index']);
    Route::get('purchase_requests/delete/{id}', ['as' => 'purchase_requests/delete/{id}', 'uses' => 'App\Http\Controllers\PurchaseRequestController@delete']);
    Route::get('purchase_requests/department_data', ['as' => 'purchase_requests/department_data', 'uses' => 'App\Http\Controllers\PurchaseRequestController@department_data']);
    Route::get('purchase_requests/data', ['as' => 'purchase_requests/data', 'uses' => 'App\Http\Controllers\PurchaseRequestController@data']);
    Route::get('purchase_requests/requested_books/{id}', ['as' => 'purchase_requests/requested_books/{id}', 'uses' => 'App\Http\Controllers\PurchaseRequestController@requested_books_edit']);
    Route::put('purchase_requests/requested_books_put', ['as' => 'purchase_requests/requested_books_put', 'uses' => 'App\Http\Controllers\PurchaseRequestController@requested_books_update']);
    Route::resource('purchase_request','App\Http\Controllers\PurchaseRequestController');
    //Approved Request
    Route::get('purchase_approves',['as' => 'purchase_approves', 'uses' => 'App\Http\Controllers\PurchaseRequestApprovedController@index']);
    Route::get('purchase_approves/preview/{id}',['as' => 'purchase_approves/preview/{id}', 'uses' => 'App\Http\Controllers\PurchaseRequestApprovedController@print_preview']);
    Route::resource('purchase_approve','App\Http\Controllers\PurchaseRequestApprovedController');
    //Department Type
    Route::get('department_types', ['as' => 'department_types', 'uses' => 'App\Http\Controllers\DepartmentTypeController@index']);
    Route::get('department_types/data', ['as' => 'department_types/data', 'uses' => 'App\Http\Controllers\DepartmentTypeController@data']);
    Route::get('department_types/delete/{id}', ['as' => 'department_types/delete/{id}', 'uses' => 'App\Http\Controllers\DepartmentTypeController@delete']);
    Route::resource('department_type','App\Http\Controllers\DepartmentTypeController');
    //Department Name
    Route::get('department_names', ['as' => 'department_names', 'uses' => 'App\Http\Controllers\DepartmentNameController@index']);
    Route::get('department_names/data', ['as' => 'department_names/data', 'uses' => 'App\Http\Controllers\DepartmentNameController@data']);
    Route::get('department_names/delete/{id}', ['as' => 'department_names/delete/{id}', 'uses' => 'App\Http\Controllers\DepartmentNameController@delete']);
    Route::resource('department_name','App\Http\Controllers\DepartmentNameController');
    //Department Budget
    Route::get('department_budgets', ['as' => 'department_budgets', 'uses' => 'App\Http\Controllers\DepartmentBudgetController@index']);
    Route::get('department_budgets/delete/{id}', ['as' => 'department_budgets/delete/{id}', 'uses' => 'App\Http\Controllers\DepartmentBudgetController@delete']);
    Route::resource('department_budget','App\Http\Controllers\DepartmentBudgetController');
    //Signature Attachments
    Route::get('signature_attachments', ['as' => 'signature_attachments', 'uses' => 'App\Http\Controllers\SignatureAttachmentController@index']);
    Route::resource('signature_attachment','App\Http\Controllers\SignatureAttachmentController');
    //Accession Books
    Route::get('acquisition_books', ['as' => 'acquisition_books', 'uses' => 'App\Http\Controllers\AcquisitionBookController@index']);
    Route::get('acquisition_books/approved/{id}', ['as' => 'acquisition_books/approved/{id}', 'uses' => 'App\Http\Controllers\AcquisitionBookController@approved']);
    Route::get('acquisition_books/preview/{id}',['as' => 'acquisition_books/preview/{id}', 'uses' => 'App\Http\Controllers\AcquisitionBookController@print_preview']);
    Route::resource('acquisition_book','App\Http\Controllers\AcquisitionBookController');


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