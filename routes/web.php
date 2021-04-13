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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/launchGame', 'HomeController@launchGame')->name('launchGame');
Route::get('/joinGame', 'HomeController@joinGame')->name('joinGame');
Route::post('/createGame', 'HomeController@createGame')->name('createGame');
Route::post('/codeGame', 'HomeController@codeGame')->name('codeGame');
Route::get('/oublie', 'HomeController@oublie')->name('oublie');
Route::get('/readyGame', 'HomeController@readyGame')->name('readyGame');
Route::get('/game', 'HomeController@game')->name('game');
Route::get('/playOneTime', 'HomeController@playOneTime')->name('playOneTime');

