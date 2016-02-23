<?php

//get
Route::get('/', 'AuthController@index');
Route::get('/login', 'AuthController@getLogin');
Route::get('/admin', 'AdminGetController@home');

Route::get('/admin/new/user', 'AdminGetController@getCreateUser');
Route::get('/admin/user', 'AdminGetController@getUser');
Route::get('/admin/college', 'AdminGetController@getCollege');
Route::get('/admin/course', 'AdminGetController@getCourse');
Route::get('/admin/new/student', 'AdminGetController@getCreateStudent');
Route::get('/admin/new/college', 'AdminGetController@getCreateCollege');
Route::get('/admin/new/course', 'AdminGetController@getCreateCourse');
Route::get('/admin/new/subject', 'AdminGetController@getCreateSubject');
Route::get('/admin/subject', 'AdminGetController@getSubject');
Route::get('/admin/new/curriculum', 'AdminGetController@getCurriculum');

// post
Route::post('/login', 'AuthController@postLogin');
Route::post('/api/admin/update/user', 'AdminUpdateController@updateUser');
Route::post('/api/admin/save/user', 'AdminSaveController@saveCreateUser');

Route::post('/api/admin/save/student', 'AdminSaveController@saveFile');
Route::post('/api/admin/save/college', 'AdminSaveController@saveCreateCollege');
Route::post('/api/admin/update/college', 'AdminUpdateController@updateCollege');

Route::post('/api/admin/save/course', 'AdminSaveController@saveCourse');
Route::post('/api/admin/update/course', 'AdminUpdateController@updateCourse');

Route::post('/api/admin/save/subject', 'AdminSaveController@saveSubject');
Route::post('/api/admin/update/subject', 'AdminUpdateController@updateSubject');

Route::post('/api/admin/save/curriculum', 'AdminSaveController@saveCurriculum');


Route::get('/api/search/subjects', 'AdminGetController@searchSubject');


// get with parameters
Route::get('/admin/update/user/{id}', 'AdminGetController@getUserUpdate');
Route::get('/admin/update/college/{id}', 'AdminGetController@getCollegeUpdate');
Route::get('/admin/update/course/{id}', 'AdminGetController@getCourseUpdate');
Route::get('/admin/update/subject/{id}', 'AdminGetController@getSubjectUpdate');
Route::get('/admin/curriculum/{guid}', 'AdminGetController@getCreateElective');

Route::get('/admin/api/get/majors/{courseGuid}', 'AdminGetController@getMajorsFromCourse');

Route::get('/api/get/subject/data/{catalog}', 'AdminGetController@getSubjectByCatalog');