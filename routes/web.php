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

Route::get('/', function () {
    return view('Hotel');
});

Route::get('/habitaciones', 'habitaciones@index');
Route::get('/reservaciones', 'habitaciones@indexReservaciones');
Route::get('/showHabitaciones', 'habitaciones@indexHabitaciones');
Route::get('/showReservaciones', 'reservaciones@indexReservaciones');
Route::post('/saveHabitacion', 'habitaciones@store');
Route::post('/saveReservaciones','reservaciones@store');
Route::post('/darBaja/{id}', 'bajas@store');
Route::post('/actualizarHab/{id}', 'habitaciones@update');
