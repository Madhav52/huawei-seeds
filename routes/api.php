<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', 'AuthController@login')->name('login');
Route::post('/register', 'AuthController@register');
Route::middleware('auth:api')->post('logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => ['auth:api']], function () {
Route::get('get-all-users', 'UserDetailController@getAllUsers');
Route::get('generatePdf', 'UserDetailController@generatePdf');

    Route::get('user', function(){
        return response()->json(Auth::user());
    });
});
Route::post('user_profile', 'UserDetailController@store');
