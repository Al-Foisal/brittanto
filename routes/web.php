<?php

//for email verification
Auth::routes(['verify' => true]);

//for public visible
Route::get('/', 'Coaching\Fornt\CoachingForntController@showInstitutionList')->name('institution.list');
Route::get('/institution-details/{serial}', 'Coaching\Fornt\CoachingForntController@showInstitutionDetails')->name('institution.details');
Route::post('/institution-details/student-information/store', 'Coaching\Fornt\CoachingForntController@storeOnlineStudent')->name('institution.online_student.store');
Route::get('/institution-details/single-course/{id}','Coaching\Fornt\CoachingForntController@showSingleCourse')->name('institution.single_course');
Route::get('/institution-details/single-event/{id}','Coaching\Fornt\CoachingForntController@showSingleEvent')->name('institution.single_event');
Route::get('features','Coaching\Fornt\CoachingForntController@feature');

//authenticated user willnot enter
Route::group(['middleware' => 'guest'], function(){
	Route::get('/register', 'AuthController@showRegisterForm')->name('register');
	Route::post('/register', 'AuthController@register');
	Route::get('/login', 'AuthController@showLogin')->name('login');
	Route::post('/login', 'AuthController@login');
});

//authenticated user will enter only
Route::group(['middleware' => 'auth'], function(){
	Route::get('/logout','AuthController@logout')->name('logout');

	Route::group(['middleware' => 'verified' ], function(){

		//dashboard for all verified coaching 
		Route::get('/dashboard', 'DashboardController@showDashboard')->name('dashboard');

		//admin area
		Route::group(['middleware' => 'admin' , 'namespace'=>'Admin'], function(){
			Route::get('/admin/{FI}', 'AdminController@adminRequest')->name('admin.request');
		});

		Route::group(['middleware'=>'coaching'],function(){

			Route::post('/feedback','DashboardController@feedback')->name('feedback');

			//resource controller for caoching
			Route::resource('/coaching-students','Coaching\StudentOperationController');			
			Route::resource('/coaching-employees','Coaching\EmployeeOperationController');
			Route::resource('/coaching-owners','Coaching\OwnerOperationController');
			Route::resource('/coaching-sections','Coaching\SectionOperationController');
			Route::resource('/coaching-proceeds','Coaching\ProceedOperationController');
			Route::resource('/coaching-exam-titles','Coaching\ExaminationTitleController');

			//SMS section
			Route::post('/coaching-sms','Coaching\CoachingSMSController@showExamSMSArea')->name('sms.exam.show');
			Route::post('/coaching-sms/send','Coaching\CoachingSMSController@sendExamSMS')->name('sms.exam.send');

			// Exam number and grade calculation 
			Route::get('/coaching/exam-details/batch-and-subject-store-under-a-class-and-test/{test}','Coaching\ExamNumberCalculation@showExamSectionSubject')->name('exam.section.subject_show');
			Route::post('/coaching/exam-details/section-subject-store','Coaching\ExamNumberCalculation@storeExamSectionSubject')->name('exam.section.subject_store');
			Route::post('/coaching/exam-details/section-subject-delete/{id}','Coaching\ExamNumberCalculation@deleteExamSectionSubject')->name('exam.section.subject_delete');

			Route::get('/coaching/number-area/{id}','Coaching\ExamNumberCalculation@showNumberArea')->name('exam.number.area_show');
			Route::post('/coaching/number-area/{id}','Coaching\ExamNumberCalculation@storeNumberArea')->name('exam.number.area_store');
			Route::get('/coaching/number-area/number-details/{id}','Coaching\ExamNumberCalculation@detailNumberArea')->name('exam.number.area_detail');
			Route::get('/coaching/number-area/number-details/edit/{id}','Coaching\ExamNumberCalculation@editNumberArea')->name('exam.number.area_edit');
			Route::post('/coaching/number-area/number-details/update/{id}','Coaching\ExamNumberCalculation@updateNumberArea')->name('exam.number.area_update');

			//money ralated working starts
			//money receipt action
			Route::get('/money-receipt','Coaching\ProceedTokenController@showProceed')->name('proceed.show');
			Route::post('/money-receipt','Coaching\ProceedTokenController@findAndGenerateProceed');
			Route::get('/money-receipt/{save_proceed}','Coaching\ProceedTokenController@saveReceipt')->name('proceed.save');
			Route::get('/proceed/paid-receipt','Coaching\ProceedTokenController@paidProceed')->name('proceed.paid');
			Route::get('/proceed/receipt-details/{selfview}','Coaching\ProceedTokenController@viewSelfProceed')->name('proceed.selfview');


			//teacher salary and other cost
			Route::get('/coaching-finance/employee/{id}','Coaching\CoachingSalaryController@showSalaryForm')->name('salary.show');
			Route::post('/coaching-finance/employee/store','Coaching\CoachingSalaryController@storeSalaryForm')->name('salary.store');
			Route::post('/coaching-finance/employee/update','Coaching\CoachingSalaryController@updateSalaryForm')->name('salary.update');
			Route::get('/coaching-finance/voucher','Coaching\CoachingSalaryController@showVoucher')->name('voucher.show');
			Route::post('/coaching-finance/voucher/store','Coaching\CoachingSalaryController@storeVoucher')->name('voucher.store');
			Route::post('/coaching-finance/voucher/delete/{id}','Coaching\CoachingSalaryController@deleteVoucher')->name('voucher.delete');
			Route::get('/coaching-finance/voucher/cost_sheet','Coaching\CoachingSalaryController@costSheet')->name('cost.sheet');
			//money ralated working ends

		//coaching fornt area starts
		Route::group(['namespace'=>'Coaching\Fornt'],function(){

			Route::get('/ES', 'EducationalSolution@ES_index')->name('ES');
			Route::get('/ES_fetch_data', 'EducationalSolution@ES_fetch_data')->name('fornt.ES.fetch_data');
			Route::post('/ES_add_data', 'EducationalSolution@ES_add_data')->name('fornt.ES.add_data');
			Route::post('/ES_update_data', 'EducationalSolution@ES_update_data')->name('fornt.ES.update_data');
			Route::post('/ES_delete_data', 'EducationalSolution@ES_delete_data')->name('fornt.ES.delete_data');

			//popular courses
			Route::resource('/popular-courses','PopularCourse');
			Route::get('/popular-courses/create-category/{id}','PopularCourse@createCourseCategory')->name('create.course.category');
			Route::post('/popular-courses/create-category/store','PopularCourse@storeCourseCategory')->name('store.course.category');
			Route::get('/popular-courses/create-category/delete/{id}','PopularCourse@deleteCourseCategory')->name('delete.course.category');

			//upcoming event
			Route::resource('/upcoming-events','UpcomingEvent');

			Route::get('upcoming-events/create-category/{id}','UpcomingEvent@createEventCategory')->name('create.event.category');
			Route::post('upcoming-events/create-category/store','UpcomingEvent@storeEventCategory')->name('store.event.category');
			Route::get('upcoming-events/create-category/delete/{id}','UpcomingEvent@deleteEventCategory')->name('delete.event.category');

			//notice board
			Route::resource('/notice-boards','NoticeBoard');

			//mission and vision
			Route::resource('/mission-and-visions','MissionAndVision');


		});

			Route::post('/student-profile','Coaching\ProfileController@showStudentProfile')->name('profile.student.show');

			/*all PDF route  starts */
			Route::get('/pdf/student-details/{student}','Coaching\PdfGeneratorController@getStudentPdf')
				->name('pdf.student.details');
			Route::get('/pdf/student-attendence/{attendence}','Coaching\PdfGeneratorController@getStudentAttendenceSheetPdf')
				->name('pdf.student.attendence');

			/*all PDF route  ends */

			//all js request operation will perform here
			Route::post('/coaching_class/assigned_section','Coaching\allJsRequest@findSectionUnderClass')->name('class.assigned_section');

			//documentation
			Route::get('/docs','DashboardController@docs')->name('docs');
		});
	});
});