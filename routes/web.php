<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
Route::group(['prefix' => 'admin',  'middleware' => 'auth'], function()
{
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth', 'role:admin');
});
 php artisan crud:generate Posts --fields_from_file="crud.json" --view-path=admin --controller-namespace=Admin --route-group=admin --form-helper=html --soft-deletes=yes
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
