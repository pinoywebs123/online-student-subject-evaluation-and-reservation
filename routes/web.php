<?php

use App\User;

Route::get('/aw', function(){

	return App::VERSION();
});


Route::get('/', function(){
	return redirect()->route('login');
});

/*
====================MORLEY=================================
					AUTHENTICATION 
====================MORLEY=================================
*/

Route::group(['prefix'=> 'auth'], function(){

	Route::get('/forget-password/link/{id}/{email}', [
		'as'=> 'forget_password_link',
		'uses'=> 'auth\AuthController@forget_password_link'
	]);


	Route::post('/forget-password/{id}',[
		'as'=> 'forget_change_pass',
		'uses'=> 'auth\AuthController@forget_change_pass'
	]);

	

	Route::get('/verifyStudent/{id}', [
		'as'=> 'very_student',
		'uses'=> 'VerifyController@very_student'
	]);

	Route::post('/verifynowmorley', [
		'as'=> 'verify_now_morley',
		'uses'=> 'VerifyController@verify_now_morley'
	]);

	Route::get('/login', [
		'as'=> 'login',
		'uses'=> 'auth\AuthController@login'
	]);

	Route::post('/login', [
		'as'=> 'login_check',
		'uses'=> 'auth\AuthController@login_check'
	]);

	Route::get('/forgot-password', [
		'as'=> 'forgot',
		'uses'=> 'auth\AuthController@forgot'
	]);

	Route::post('/forgot-check', [
		'as'=> 'forgot_check',
		'uses'=> 'auth\AuthController@forgot_check'
	]);

	Route::get('/sign-up', [
		'as'=> 'signup',
		'uses'=> 'auth\AuthController@signup'
	]);

	Route::post('/sign-up', [
		'as'=> 'signup_check',
		'uses'=> 'auth\AuthController@signup_check'
	]);

});

/*
====================MORLEY=================================
					ADMIN 
====================MORLEY=================================
*/

Route::group(['prefix'=> 'admin'], function(){

	Route::get('/notify-all-students-tuition/{id}', [
		'as'=> 'notify_all',
		'uses'=> 'admin\AdminController@notify_all'
	]);

	Route::post('/subject-tuition/{id}', [
		'as'=> 'subject_tuition',
		'uses'=> 'admin\AdminController@subject_tuition'
	]);

	Route::get('/main', [
		'as'=> 'admin_main',
		'uses'=> 'admin\AdminController@admin_main'
	]);

	Route::get('/login', [
		'as'=> 'admin_logout',
		'uses'=> 'admin\AdminController@admin_logout'
	]);

	Route::get('/subject', [
		'as'=> 'admin_subject',
		'uses'=> 'admin\AdminController@admin_subject'
	]);

	Route::get('/subject-create', [
		'as'=> 'admin_subject_create',
		'uses'=> 'admin\AdminController@admin_subject_create'
	]);

		Route::post('/subject-create', [
			'as'=> 'admin_create_check',
			'uses'=> 'admin\AdminController@admin_create_check'
		]);

		Route::get('/subject-delete/{subject_id}', [
			'as'=> 'admin_subject_delete',
			'uses'=> 'admin\AdminController@admin_subject_delete'
		]);		

		Route::get('/subject-close/{subject_id}', [
			'as'=> 'admin_subject_close',
			'uses'=> 'admin\AdminController@admin_subject_close'
		]);

	Route::get('/inquiry', [
		'as'=> 'admin_inquiry',
		'uses'=> 'admin\AdminController@admin_inquiry'
	]);

		Route::get('/inquiry/{id}', [
			'as'=> 'admin_inquiry_view',
			'uses'=> 'admin\AdminController@admin_inquiry_view'
		]);

		Route::get('/send-inquiry-sms/{id}', [
			'as'=> 'admin_inquiry_email',
			'uses'=> 'admin\AdminController@admin_inquiry_email'
		]);

		Route::get('/send-inquiry-email/{id}', [
			'as'=> 'admin_inquiry_sms',
			'uses'=> 'admin\AdminController@admin_inquiry_sms'
		]);

	Route::get('/reserve', [
		'as'=> 'admin_reserve',
		'uses'=> 'admin\AdminController@admin_reserve'
	]);

		Route::get('/second', [
			'as'=> 'admin_reserve_second',
			'uses'=> 'admin\AdminController@admin_reserve_second'
		]);

		Route::get('/third', [
			'as'=> 'admin_reserve_third',
			'uses'=> 'admin\AdminController@admin_reserve_third'
		]);

		Route::get('/fourth', [
			'as'=> 'admin_reserve_fourth',
			'uses'=> 'admin\AdminController@admin_reserve_fourth'
		]);

		Route::get('/fifth', [
			'as'=> 'admin_reserve_fifth',
			'uses'=> 'admin\AdminController@admin_reserve_fifth'
		]);

		Route::get('/reserve/{id}/view-list', [
			'as'=> 'admin_view_list',
			'uses'=> 'admin\AdminController@admin_view_list'
		]);



	Route::get('/student/list', [
		'as'=> 'admin_students',
		'uses'=> 'admin\AdminController@admin_students'
    ]);

    	Route::get('/student/create', [
    		'as'=> 'admin_students_create',
    		'uses'=> 'admin\AdminController@admin_students_create'
    	]);

    	Route::post('/student/create-check', [
    		'as'=> 'admin_students_create_check',
    		'uses'=> 'admin\AdminController@admin_students_create_check'
    	]);

    	Route::get('/student/upload', [
    		'as'=> 'admin_students_upload',
    		'uses'=> 'admin\AdminController@admin_students_upload'
    	]);

    Route::get('/staff', [
    	'as'=> 'admin_staff',
    	'uses'=> 'admin\AdminController@admin_staff'
    ]);	

    Route::get('/staff-create', [
    	'as'=> 'admin_staff_create',
    	'uses'=> 'admin\AdminController@admin_staff_create'
    ]);

    	Route::post('/staff-create-check',[
    		'as'=> 'admin_staff_check',
    		'uses'=> 'admin\AdminController@admin_staff_check'
    	]);


    Route::post('/disable-user/{user_id}', [
    	'as'=> 'admin_disable_user',
    	'uses'=> 'admin\AdminController@admin_disable_user'
    ]);	

    Route::post('/disable-staff/{staff_id}', [
    	'as'=> 'admin_disable_staff',
    	'uses'=> 'admin\AdminController@admin_disable_staff'
    ]);

    Route::get('/evaluation', [
    	'as'=> 'admin_evaluation',
    	'uses'=> 'admin\AdminController@admin_evaluation'
    ]);

    Route::get('/evaluation/{id}', [
    	'as'=> 'admin_evaluation_now',
    	'uses'=> 'admin\AdminController@admin_evaluation_now'
    ]);

    Route::post('/evaluation/{id}', [
    	'as'=> 'admin_evaluation_ajax',
    	'uses'=> 'admin\AdminController@admin_evaluation_ajax'
    ]);

    Route::post('/eval/me/{id}',[
    	'as'=> 'admin_eval_me',
    	'uses'=> 'admin\AdminController@admin_eval_me'
    ]);

    Route::post('/search/evaluation', [
    	'as'=> 'admin_search_evaluation',
    	'uses'=> 'admin\AdminController@admin_search_evaluation'
    ]);
});

/*
====================MORLEY=================================
					STUDENTS 
====================MORLEY=================================
*/

Route::group(['prefix'=> 'student'], function(){

	Route::get('/main', [
		'as'=> 'student_main',
		'uses'=> 'student\StudentController@student_main'
	]);

	Route::get('/second', [
		'as'=> 'student_main_second',
		'uses'=> 'student\StudentController@student_main_second'
	]);

	Route::get('/third', [
		'as'=> 'student_main_third',
		'uses'=> 'student\StudentController@student_main_third'
	]);

	Route::get('/fourth', [
		'as'=> 'student_main_fourth',
		'uses'=> 'student\StudentController@student_main_fourth'
	]);

	Route::get('/fifth', [
		'as'=> 'student_main_fifth',
		'uses'=> 'student\StudentController@student_main_fifth'
	]);

	Route::get('/logout', [
		'as'=> 'student_logout',
		'uses'=> 'student\StudentController@student_logout'
	]);

	Route::get('/activity', [
		'as'=> 'student_activity',
		'uses'=> 'student\StudentController@student_activity'
	]);

	Route::get('/inquiries', [
		'as'=> 'student_inquiries',
		'uses'=> 'student\StudentController@student_inquiries'
	]);

	Route::get('/subject/{id}/reservation', [
		'as'=> 'student_reservation',
		'uses'=> 'student\StudentController@student_reservation'
	]);

	Route::get('/inquire-now', [
		'as'=> 'student_inquire_now',
		'uses'=> 'student\StudentController@student_inquire_now'
	]);

	Route::post('/inquiry-check', [
		'as'=> 'student_inquiry_check',
		'uses'=> 'student\StudentController@student_inquiry_check'
	]);

	Route::post('/reserve-me-now/{id}', [
		'as'=> 'studnet_reserve_me_now',
		'uses'=> 'student\StudentController@studnet_reserve_me_now'
	]);


	Route::get('/settings', [
		'as'=> 'student_settings',
		'uses'=> 'student\StudentController@student_settings'
	]);

	Route::post('/settings', [
		'as'=> 'student_settings_check',
		'uses'=> 'student\StudentController@student_settings_check'
	]);

	Route::get('/evaluated/subjects', [
		'as'=> 'student_evaluated',
		'uses'=> 'student\StudentController@student_evaluated'
	]);

});



/*
===============MORLEY========================
===============STAFF=========================

*/

Route::group(['prefix'=> 'staff'], function(){

	Route::get('/main', [
		'as'=> 'staff_main',
		'uses'=> 'staff\StaffController@staff_main'

	]);

	Route::get('/second', [
		'as'=> 'staff_second',
		'uses'=> 'staff\StaffController@staff_second'
	]);

	Route::get('/third', [
		'as'=> 'staff_third',
		'uses'=> 'staff\StaffController@staff_third'
	]);

	Route::get('/fourth',[
		'as'=> 'staff_fourth',
		'uses'=> 'staff\StaffController@staff_fourth'
	]);

	Route::get('/fifth', [
		'as'=> 'staff_fifth',
		'uses'=> 'staff\StaffController@staff_fifth'
	]);

	Route::get('/studnet-subject-list/{id}', [
		'as'=> 'view_student_list',
		'uses'=> 'staff\StaffController@view_student_list'
	]);

	Route::get('/subjects', [
		'as'=> 'staff_subjects',
		'uses'=> 'staff\StaffController@staff_subjects'
	]);

	Route::get('/students', [
		'as'=> 'staff_students',
		'uses'=> 'staff\StaffController@staff_students'
	]);

	Route::get('/logout', [
		'as'=> 'staff_logout',
		'uses'=> 'staff\StaffController@staff_logout'
	]);

	Route::get('/settings', [
		'as'=> 'staff_settings',
		'uses'=> 'staff\StaffController@staff_settings'
	]);

	Route::post('/settings', [
		'as'=> 'staff_settings_check',
		'uses'=> 'staff\StaffController@staff_settings_check'
	]);
});

Route::get('/new_student', function(){

	
	$user = new User ;
	$user->id = '789789';
	$user->fname = 'Zac';
	$user->mname = 'Yu';
	$user->lname = 'Maestro';
	$user->contact = '09069541280';
	$user->address = 'Near far where ever you are';
	$user->course = 'BSIT';
	$user->email = 'email12sa23@yahoo.com';
	$user->password = bcrypt('789789');
	$user->status_id = 1;
	$user->role_id = 3;
	$user->save();
});