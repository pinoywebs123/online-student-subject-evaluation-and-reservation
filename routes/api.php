<?php

use Illuminate\Http\Request;

Route::group(['prefix'=> 'user'], function(){

	Route::resource('/subjects','api\SubjectController');

	Route::post('/login', 'api\UserController@login');

	Route::resource('/students', 'api\StudentController');

	Route::get('/activity','api\StudentController@activity');

	Route::resource('/inquiry', 'api\InquiryController');

	Route::post('/subject_reserve', 'api\SubjectController@reserve');

});
