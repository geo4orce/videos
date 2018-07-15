<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home', 'HomeController@home');
Route::get('mine', 'HomeController@mine');
Route::get('upload', 'HomeController@upload');

Route::resource('videos', 'VideoController');

Route::get('like/{id}', 'VideoController@like');
Route::get('unlike/{id}', 'VideoController@unlike');
