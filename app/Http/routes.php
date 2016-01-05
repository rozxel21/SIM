<?php

use Symfony\Component\HttpFoundation\File\UploadedFile;
//get
Route::get('/', 'AuthController@index');
Route::get('/login', 'AuthController@getLogin');
Route::get('/admin', 'AdminController@home');
Route::get('/admin/create-user', 'AdminController@getCreateUser');
Route::get('/admin/user', 'AdminController@getUser');
Route::get('/admin/new-student', 'AdminController@getCreateStudent');

//test
Route::get('/test', 'AdminController@cvs');
Route::post('/test', function(Request $request){
	$csvFile = Input::file('file');

	$file_handle = fopen($csvFile, 'r');
	while (!feof($file_handle) ) {
		$line_of_text[] = fgetcsv($file_handle, 1024);
	}
	fclose($file_handle);
	return $line_of_text;
});


// post
Route::post('/login', 'AuthController@postLogin');
Route::post('/api/admin/update/user', 'AdminController@updateUser');
Route::post('/api/admin/save/user', 'AdminController@saveCreateUser');

// get with parameters
Route::get('/admin/update/user/{id}', 'AdminController@getUserUpdate');