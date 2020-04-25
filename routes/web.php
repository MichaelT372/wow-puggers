<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/raids/{raid}', 'RaidController@show')->name('raids.show');
Route::post('/raids/{raid}/signup', 'RaidSignupController@store')->name('raids.signup');

Route::middleware(['auth'])->group(function () {
    Route::get('/raids', 'RaidController@index')->name('raids.index');
    Route::post('/raids/create', 'RaidController@store')->name('raids.create');
});

