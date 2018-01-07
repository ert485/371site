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
    $history = array();
    array_push($history,"test");
    return view('welcome')
        ->with('history_list', $history);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
