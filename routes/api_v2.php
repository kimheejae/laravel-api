<?php
use Illuminate\Http\Request;
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

Route::get('goods','GoodController@index');
Route::get('goods/{id}', 'GoodController@show');
Route::post('goods', 'GoodController@store');
Route::put('goods/{id}', 'GoodController@update');

