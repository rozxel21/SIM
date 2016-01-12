<?php

//get
Route::get('/', 'AuthController@index');
Route::get('/login', 'AuthController@getLogin');
Route::get('/admin', 'AdminController@home');
Route::get('/admin/new/user', 'AdminController@getCreateUser');
Route::get('/admin/user', 'AdminController@getUser');
Route::get('/admin/new/student', 'AdminController@getCreateStudent');

Route::get('/admin/new/college', 'AdminController@getCreateCollege');

// post
Route::post('/login', 'AuthController@postLogin');
Route::post('/api/admin/update/user', 'AdminController@updateUser');
Route::post('/api/admin/save/user', 'AdminController@saveCreateUser');

Route::post('/api/admin/save/student', 'AdminController@saveFile');

// get with parameters
Route::get('/admin/update/user/{id}', 'AdminController@getUserUpdate');