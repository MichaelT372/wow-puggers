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

Route::get('/', 'PageController@home')->name('home');
Route::get('/contact', 'PageController@contact')->name('contact');
Route::post('/contact', 'PageController@contactEmail')->name('contact.email');
Route::get('/privacy', 'PageController@privacy')->name('privacy');

Auth::routes();

Route::get('/raids/{raid}', 'RaidController@show')->name('raids.show');
Route::post('/raids/{raid}/signup', 'RaidSignupController@store')->name('raids.signup');

Route::middleware(['auth'])->group(function () {
    Route::get('/raids', 'RaidController@index')->name('raids.index');
    Route::post('/raids/create', 'RaidController@store')->name('raids.create');
    Route::put('/raids/{raid}/update', 'RaidController@update')->name('raids.update');
    Route::delete('/raids/{raid}/delete', 'RaidController@destroy')->name('raids.delete');
    Route::put('/raider/{raidSignup}', 'RaidSignupController@update')->name('raider.update');
    Route::delete('/raider/{raidSignup}', 'RaidSignupController@destroy')->name('raider.delete');
});
