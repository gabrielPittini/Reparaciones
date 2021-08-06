<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\ProductoController@index');
Route::get('/historial/{id}', 'App\Http\Controllers\HistorialController@index');
Route::get('/rips', 'App\Http\Controllers\ProductoController@rips');
Route::post('/create', 'App\Http\Controllers\ProductoController@create');
Route::post('/update', 'App\Http\Controllers\ProductoController@update');
Route::post('/historial/create', 'App\Http\Controllers\HistorialController@create');
Route::post('/historial/update', 'App\Http\Controllers\HistorialController@update');
