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
        'user.offices' => 'User\UserOfficeController',
        'user.payments' => 'User\UserPaymentController',
        'user.specialities' => 'User\UserSpecialityController',
        'user.status' => 'User\UserStatusController',
        'user.vehicles' => 'User\UserVehicleController'
    ]);
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
