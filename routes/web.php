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
    });

    Route::prefix('sobe')->group(function(){
    Route::get('/', 'RoomController@index');
    Route::get('nova', 'RoomController@create');
    Route::post('nova', 'RoomController@store');
    Route::get('vrste', 'RoomController@roomtypes');
    Route::post('vrste', 'RoomController@store_roomtypes');
    Route::get('{id}', 'RoomController@show');
    });

});


