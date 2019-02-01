<?php


Auth::routes();

Route::get('/','HomeController@index');
Route::get('hi/{id1}/','TestController@index2','t2');
Route::post('hi/{id1}','TestController@index2','t2');

Route::get('/js','HomeController@js','js');
