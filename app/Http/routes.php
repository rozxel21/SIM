<?php

//get
Route::get('/', 'AuthController@index');
Route::get('/login', 'AuthController@getLogin');
Route::get('/admin', 'AdminController@home');
Route::get('/admin/new/user', 'AdminController@getCreateUser');
Route::get('/admin/user', 'AdminController@getUser');
Route::get('/admin/college', 'AdminController@getCollege');
Route::get('/admin/new/student', 'AdminController@getCreateStudent');
Route::get('/admin/new/college', 'AdminController@getCreateCollege');
Route::get('/admin/new/course', 'AdminController@getCreateCourse');
Route::get('/admin/new/subject', 'AdminController@getCreateSubject');

// post
Route::post('/login', 'AuthController@postLogin');
Route::post('/api/admin/update/user', 'AdminController@updateUser');
Route::post('/api/admin/save/user', 'AdminController@saveCreateUser');

Route::post('/api/admin/save/student', 'AdminController@saveFile');
Route::post('/api/admin/save/college', 'AdminController@saveCreateCollege');
Route::post('/api/admin/update/college', 'AdminController@updateCollege');

// get with parameters
Route::get('/admin/update/user/{id}', 'AdminController@getUserUpdate');
Route::get('/admin/update/college/{id}', 'AdminController@getCollegeUpdate');