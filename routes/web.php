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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->group(function(){

    Route::get('/', 'PagesController@dashboard');

    Route::prefix('napomene')->group(function(){
    Route::get('/', 'NoteController@index');
    Route::get('nova', 'NoteController@create');
    Route::post('nova', 'NoteController@store');
    Route::get('{note}', 'NoteController@show');
    Route::delete('{note}', 'NoteController@destroy');
    });

    Route::prefix('rezervacije')->group(function(){
    Route::get('/', 'ReservationController@index');
    Route::get('nova','ReservationController@create');
    Route::post('nova','ReservationController@store');
    Route::get('{reservation}/racun','ReservationController@invoice');
    Route::get('{reservation}','ReservationController@checkOut');
    Route::get('{reservation}/izmjena','ReservationController@edit');
    Route::put('{reservation}','ReservationController@update');
    Route::delete('{reservation}','ReservationController@destroy')->middleware('admin');
    });

    Route::prefix('sobe')->group(function(){
    Route::get('/', 'RoomController@index');
    Route::get('nova', 'RoomController@create')->middleware('admin');;
    Route::post('nova', 'RoomController@store')->middleware('admin');;
    Route::get('vrste', 'RoomController@roomtypes');
    Route::post('vrste', 'RoomController@store_roomtypes');
    Route::get('vrste/{id}/izmjena', 'RoomController@edit_roomtypes');
    Route::put('vrste/{id}', 'RoomController@update_roomtypes');
    Route::delete('vrste/{id}', 'RoomController@destroy_roomtypes');
    Route::get('{room}/izmjena', 'RoomController@edit')->middleware('admin');
    Route::put('{room}', 'RoomController@update')->middleware('admin');
    Route::delete('{room}', 'RoomController@destroy')->middleware('admin');
    Route::get('{room}', 'RoomController@show');
    });




    Route::prefix('korisnici')->middleware('admin')->group(function(){
    Route::get('/', 'UserController@index');
    Route::get('{id}/izmjena', 'UserController@edit');
    Route::put('{id}', 'UserController@update');
    Route::get('{id}', 'UserController@show');
    Route::delete('{id}','UserController@destroy');
    });

    Route::get('logout', 'ProfileController@logout');
    Route::get('izmjena', 'ProfileController@edit');
    Route::put('izmjena', 'ProfileController@update');
    Route::get('izvjestaj','PagesController@report');

});

Route::get('google', 'Auth\LoginController@redirectToProvider');
Route::get('google/callback', 'Auth\LoginController@handleProviderCallback');


