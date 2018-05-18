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
Route::get('/','Front@index')->name('home');
	
Route::get('/one', function () {
    return view('welcome');
});

Route::post('/add','Front@add')->name('add');

Route::post('/load','Front@load')->name('load');

Route::get('/test','Front@test')->name('test');

Route::get('/pdf','Front@pdf')->name('pdf');
