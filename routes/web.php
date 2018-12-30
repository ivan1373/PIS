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
    Route::get('{id}', 'NoteController@show');
    Route::delete('{note}', 'NoteController@destroy');
    });

    Route::prefix('sobe')->group(function(){
    Route::get('/', 'RoomController@index');
    Route::get('nova', 'RoomController@create');
    Route::post('nova', 'RoomController@store');
    Route::get('vrste', 'RoomController@roomtypes');
    Route::post('vrste', 'RoomController@store_roomtypes');
    Route::get('vrste/{id}/izmjena', 'RoomController@edit_roomtypes');
    Route::put('vrste/{id}', 'RoomController@update_roomtypes');
    Route::delete('vrste/{id}', 'RoomController@destroy_roomtypes');
    Route::get('{room}/izmjena', 'RoomController@edit');
    Route::put('{room}', 'RoomController@update');
    Route::delete('{room}', 'RoomController@destroy');
    Route::get('{room}', 'RoomController@show');
    });

    Route::prefix('korisnici')->group(function(){
    Route::get('/', 'UserController@index');
    Route::get('{id}/izmjena', 'UserController@edit');
    Route::put('{id}', 'UserController@update');
    });

    Route::get('logout', 'ProfileController@logout');
    Route::get('izmjena', 'ProfileController@edit');
    Route::put('izmjena', 'ProfileController@update');

});

Route::get('google', 'Auth\LoginController@redirectToProvider');
Route::get('google/callback', 'Auth\LoginController@handleProviderCallback');


