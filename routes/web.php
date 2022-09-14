<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'berandaController@beranda')->name('beranda');

Route::get('arsip', 'arsipController@index')->name('arsip');
Route::get('arsip/create', 'arsipController@create')->name('create');
Route::post('arsip/store', 'arsipController@store')->name('store');

Route::get('about', 'aboutController@index')->name('about');