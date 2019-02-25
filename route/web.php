<?php


Auth::routes();

Route::get('/','HomeController@index');
Route::get('hi/{id1}/','TestController@index','t2');
Route::post('hi2/{id1}','TestController@index','t21');

Route::get('/test1','HomeController@index','test1');
Route::get('/js','HomeController@js','js');
