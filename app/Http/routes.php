<?php

//view
Route::get('/admin', 'AdminViewController@home');
Route::get('/admin/new/user', 'AdminViewController@createUser');
Route::get('/admin/user', 'AdminViewController@user');
Route::get('/admin/college', 'AdminViewController@college');
Route::get('/admin/course', 'AdminViewController@course');
Route::get('/admin/new/student', 'AdminViewController@createStudent');
Route::get('/admin/new/college', 'AdminViewController@createCollege');
Route::get('/admin/new/course', 'AdminViewController@createCourse');
Route::get('/admin/new/subject', 'AdminViewController@createSubject');
Route::get('/admin/subject', 'AdminViewController@subject');
Route::get('/admin/new/curriculum', 'AdminViewController@createCurriculum');
Route::get('/admin/curriculum', 'AdminViewController@curriculum');

Route::get('/admin/update/user/{id}', 'AdminViewController@userUpdate');
Route::get('/admin/update/college/{id}', 'AdminViewController@collegeUpdate');
Route::get('/admin/update/course/{id}', 'AdminViewController@courseUpdate');
Route::get('/admin/update/subject/{id}', 'AdminViewController@subjectUpdate');
Route::get('/admin/curriculum/{year}/{guid}', 'AdminViewController@prospectus');


//get
Route::get('/', 'AuthController@index');
Route::get('/login', 'AuthController@getLogin');
Route::get('/api/search/subjects', 'AdminGetController@searchSubject');



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
Route::post('/api/admin/save/prospectus', 'AdminSaveController@saveProspectus');


// get with parameters
Route::get('/admin/api/get/majors/{courseGuid}', 'AdminGetController@getMajorsFromCourse');

Route::get('/api/get/subject/data/{catalog}', 'AdminGetController@getSubjectByCatalog');
Route::get('/api/get/subjects/{curriculum}', 'AdminGetController@getSubjectForPrereq');