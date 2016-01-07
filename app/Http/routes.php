<?php

//get
Route::get('/', 'AuthController@index');
Route::get('/login', 'AuthController@getLogin');
Route::get('/admin', 'AdminController@home');
Route::get('/admin/create-user', 'AdminController@getCreateUser');
Route::get('/admin/user', 'AdminController@getUser');
Route::get('/admin/new-student', 'AdminController@getCreateStudent');

Route::post('/test', 'AdminController@saveFile');


// post
Route::post('/login', 'AuthController@postLogin');
Route::post('/api/admin/update/user', 'AdminController@updateUser');
Route::post('/api/admin/save/user', 'AdminController@saveCreateUser');

// get with parameters
Route::get('/admin/update/user/{id}', 'AdminController@getUserUpdate');