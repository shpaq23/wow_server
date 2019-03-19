<?php

use Illuminate\Http\Request;
use App\Character;
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
Route::get('characters', 'CharacterController@index');
Route::get('characters/{character}', 'CharacterController@show');
Route::post('characters', 'CharacterController@store');
Route::put('characters/{character}', 'CharacterController@update');
Route::delete('characters/{character}', 'CharacterController@delete');


Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');