<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'middleware' => ['jwt.verify'],
    'namespace' => '\App\Interfaces\Http\Controllers'
], function()
{
    Route::apiResources([
        'files' => 'File\FileController',
        'profiles' => 'Profile\ProfileController',
        'specialities' => 'Speciality\SpecialityController',
        'users' => 'User\UserController',
        'user.backgrounds' => 'User\UserBackgroundController',
        'user.contacts' => 'User\UserContactController',
        'user.documents' => 'User\UserDocumentController',
        'user.files' => 'User\UserFileController',
        'user.payments' => 'User\UserPaymentController',
        'user.specialities' => 'User\UserSpecialityController',
        'user.status' => 'User\UserStatusController',
        'user.vehicles' => 'User\UserVehicleController'
    ]);

    Route::put('user/password', 'User\UserPasswordController@update')->name('user.password.update');
    Route::get('dashboard/report', 'Dashboard\InfoController@report')->name('dashboard.info.report');
    Route::get('register/documents/{id}', 'Register\DocumentController@show')->name('register.documents');
    Route::put('register/documents/{id}', 'Register\DocumentController@update')->name('register.documents.update');
    Route::post('register/documents', 'Register\DocumentController@store')->name('register.documents.store');
    Route::get('register/contacts/{id}', 'Register\ContactController@show')->name('register.contacts');
    Route::put('register/contacts/{id}', 'Register\ContactController@update')->name('register.contacts.update');
    Route::post('register/contacts', 'Register\ContactController@store')->name('register.contacts.store');
    Route::get('register/vehicles/{id}', 'Register\VehicleController@show')->name('register.vehicles');
    Route::put('register/vehicles/{id}', 'Register\VehicleController@update')->name('register.vehicles.update');
    Route::post('register/vehicles', 'Register\VehicleController@store')->name('register.vehicles.store');
    Route::get('register/payments/{id}', 'Register\PaymentController@show')->name('register.payments');
    Route::put('register/payments/{id}', 'Register\PaymentController@update')->name('register.payments.update');
    Route::post('register/payments', 'Register\PaymentController@store')->name('register.payments.store');
});

Route::group([
    'middleware' => ['jwt.verify'],
    'namespace' => '\App\Interfaces\Http\Controllers\Auth'
], function()
{
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('register', 'AuthController@register')->name('register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
});

Route::group([
    'prefix' => 'auth',
    'namespace' => '\App\Interfaces\Http\Controllers\Auth'
], function()
{
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('register', 'AuthController@register')->name('register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');
});
