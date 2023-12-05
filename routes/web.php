<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['install']], function () {
	Route::get('/', function () {
		\Artisan::call('storage:link');
		return redirect()->route('login');
		// return view('welcome');
	});

	Auth::routes();
	Route::group(['as' => 'admin.', 'prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
		//ui:::::::::::::::::::
		Route::get('/profile', 'UiController@index')->name('profile');
		Route::post('/profile', 'UiController@postprofile')->name('postprofile');
		Route::post('/password', 'UiController@password_change')->name('password');

		/*::::::::::::::Employee Section:::::::::*/
		Route::get('employee/department', 'Configuration\Employee\EmployeeController@Department_index')->name('employee.department.index');
		Route::get('employee/department/datatable', 'Configuration\Employee\EmployeeController@Department_datatable')->name('employee.department.datatable');
		Route::get('employee/department/create', 'Configuration\Employee\EmployeeController@Department_create')->name('employee.department.create');
		Route::any('employee/department/store', 'Configuration\Employee\EmployeeController@Department_store')->name('employee.department.store');
		Route::get('employee/department/edit/{id?}', 'Configuration\Employee\EmployeeController@Department_edit')->name('employee.department.edit');
		Route::any('employee/department/update/{id}', 'Configuration\Employee\EmployeeController@Department_update')->name('employee.department.update');
		Route::delete('/employee/department/delete/{id}', 'Configuration\Employee\EmployeeController@Department_delete')->name('employee.department.delete');
		//:::::::::::::::::::::::::::::Employee Document Type::::::::::::::::::::::::::::::::::::
		Route::get('employee/document/datatable', 'Configuration\Employee\EmployeeDocumentTypeController@datatable')->name('document.datatable');
		Route::resource('employee-document-type', 'Configuration\Employee\EmployeeDocumentTypeController');

		//:::::::::::::::::::::::::::::Employee Category::::::::::::::::::::::::::::::::::::
		Route::get('employee-category-datatable', 'Configuration\Employee\EmployeeCategoryController@datatable')->name('category.datatable');
		Route::resource('employee-category', 'Configuration\Employee\EmployeeCategoryController');

		//:::::::::::::::::::::::::::::Employee leave type:::::::::::::::::::::::::::::::
		Route::get('employee-leave-type-datatable', 'Configuration\Employee\EmployeeLeaveTypeController@datatable')->name('leave_type.datatable');
		Route::resource('employee-leave-type', 'Configuration\Employee\EmployeeLeaveTypeController');

		//:::::::::::::::::::::::::::::Employee leave Allocation:::::::::::::::::::::::::::::::
		Route::get('employee-leave', 'Configuration\Employee\EmployeeLeaveTypeController@view')->name('employee-leave.view');
		Route::get('employee-leave-allocation-datatable', 'Configuration\Employee\EmployeeLeaveAllocationController@datatable')->name('leave_allocation.datatable');
		Route::resource('employee-leave-allocation', 'Configuration\Employee\EmployeeLeaveAllocationController');

		//:::::::::::::::::::::::::::::Employee leave Request:::::::::::::::::::::::::::::::
		Route::get('employee-leave-request-datatable', 'Configuration\Employee\EmployeeLeaveRequestController@datatable')->name('leave_request.datatable');
		Route::post('employee-leave-request-details', 'Configuration\Employee\EmployeeLeaveRequestController@details')->name('employee-leave-request.details');
		Route::resource('employee-leave-request', 'Configuration\Employee\EmployeeLeaveRequestController');

		//:::::::::::::::::::::: Employee Pay Head ::::::::::::::::::::::::::::::
		Route::get('employee-pay-head-datatable', 'Configuration\Employee\EmployeePayHeadController@datatable')->name('pay_head.datatable');
		Route::resource('employee-pay-head', 'Configuration\Employee\EmployeePayHeadController');

		//:::::::::::::::::::::: Employee Pay Roll ::::::::::::::::::::::::::::::
		Route::get('employee-payroll', 'Configuration\Employee\EmployeePayRollTemplateController@view')->name('employee-payroll.view');
		Route::get('employee-payroll-template-datatable', 'Configuration\Employee\EmployeePayRollTemplateController@datatable')->name('employee-payroll-template.datatable');
		Route::resource('employee-payroll-template', 'Configuration\Employee\EmployeePayRollTemplateController');

		//:::::::::::::::::::::::::::::Designation::::::::::::::::::::::::::
		Route::get('designation-datatable', 'Configuration\Employee\DesignationController@datatable')->name('designation.datatable');
		Route::resource('employee/designation', 'Configuration\Employee\DesignationController');

		//:::::::::::::::::::::::::::::Employee Attendance:::::::::::::::::::::::::::::::::
		// Route::get('employee-attendance-datatable', 'Configuration\Employee\EmployeeAttendanceController@datatable')->name('attendance.datatable');

		Route::any('employee-attendance-department', 'Configuration\Employee\EmployeeAttendanceController@department')->name('employee-attendance.department');
		Route::any('employee-attendance-designation', 'Configuration\Employee\EmployeeAttendanceController@designation')->name('employee-attendance.designation');
		Route::any('employee-attendance-date', 'Configuration\Employee\EmployeeAttendanceController@date')->name('employee-attendance.date');
		Route::any('employee-attendance-fetch', 'Configuration\Employee\EmployeeAttendanceController@fetch')->name('employee-attendance.fetch');
		Route::resource('employee-attendance', 'Configuration\Employee\EmployeeAttendanceController');


		//:::::::::::::::::::::::::::::Employee Attendance Type:::::::::::::::::::::::::::::::::
		Route::get('employee-attendance-type-datatable', 'Configuration\Employee\EmployeeAttendanceTypeController@datatable')->name('attendance-type.datatable');
		Route::resource('employee-attendance-type', 'Configuration\Employee\EmployeeAttendanceTypeController');

		//:::::::::::::::::::::::::::::Employee List::::::::::::::::::::::::::::::::::::
		Route::get('employee-list-datatable', 'Configuration\Employee\EmployeeListController@datatable')->name('list.datatable');
		Route::resource('employee-list', 'Configuration\Employee\EmployeeListController');
		Route::post('admin/employee-list/basic_info', 'Configuration\Employee\EmployeeListController@Store_Basic_Info')->name('employee-list.basic_info');
		Route::post('admin/employee-list/contact_info', 'Configuration\Employee\EmployeeListController@Store_Contact_Info')->name('employee-list.contact_info');
		Route::any('employee-list/Image_Upload/{id}', 'Configuration\Employee\EmployeeListController@Image_Upload')->name('employee-list.Image_Upload');

		// Route for Employee Basic Info
		Route::get('/ajax/basic_info', 'Configuration\Employee\EmployeeListController@basic_info')->name('ajax.basic_info');
		Route::post('/employee/basic_info/update', 'Configuration\Employee\EmployeeListController@update_basic_info')->name('employee.basic_info.update');

		// Route for Employee Contact Info
		Route::get('/ajax/contact_info/{id}', 'Configuration\Employee\EmployeeListController@contact_info')->name('ajax.contact_info');
		Route::post('/employee/contact_info/update', 'Configuration\Employee\EmployeeListController@update_contact_info')->name('employee.contact_info.update');

		//  Route for Employee Document Info
		Route::get('/ajax/document_info', 'Employee\DocumentController@document_info')->name('ajax.document_info');
		// Route::resource('/employee-document/{id}', 'Employee\DocumentController');
		Route::get('/employee-document/create/{id}', 'Employee\DocumentController@create')->name('employee-document.create');
		Route::post('/employee-document/store', 'Employee\DocumentController@store')->name('employee-document.store');
		Route::get('/employee-document/show/{id}', 'Employee\DocumentController@show')->name('employee-document.show');
		Route::get('/employee-document/edit/{id}', 'Employee\DocumentController@edit')->name('employee-document.edit');
		Route::patch('/employee-document/update/{id}', 'Employee\DocumentController@update')->name('employee-document.update');
		Route::delete('/employee-document/destroy/{id}', 'Employee\DocumentController@destroy')->name('employee-document.destroy');
		// Route for Employee Account Info
		Route::get('/ajax/qua_info', 'Employee\QualificationController@qua_info')->name('ajax.qua_info');
		Route::get('/employee-qua/create/{id}', 'Employee\QualificationController@create')->name('employee-qua.create');
		Route::post('/employee-qua/store', 'Employee\QualificationController@store')->name('employee-qua.store');
		Route::get('/employee-qua/show/{id}', 'Employee\QualificationController@show')->name('employee-qua.show');
		Route::get('/employee-qua/edit/{id}', 'Employee\QualificationController@edit')->name('employee-qua.edit');
		Route::patch('/employee-qua/update/{id}', 'Employee\QualificationController@update')->name('employee-qua.update');
		Route::delete('/employee-qua/destroy/{id}', 'Employee\QualificationController@destroy')->name('employee-qua.destroy');

		// Route for Employee Account Info
		Route::get('/ajax/account_info', 'Employee\AccountController@account_info')->name('ajax.account_info');
		Route::get('/ajax/account/info/{id}', 'Employee\AccountController@create')->name('account.create');
		Route::post('/ajax/account/info/store/{id}', 'Employee\AccountController@store')->name('account.store');
		Route::delete('/ajax/account/info/destroy/{id}', 'Employee\AccountController@destroy')->name('account.destroy');
		Route::get('/ajax/account/info/edit/{id}', 'Employee\AccountController@edit')->name('account.edit');
		Route::get('/ajax/account/info/show/{id}', 'Employee\AccountController@show')->name('account.show');
		Route::patch('/ajax/account/info/update/{id}', 'Employee\AccountController@update')->name('account.update');

		// Route for Employee Designation Info
		Route::get('/ajax/desig_info', 'Employee\DesignationController@desig_info')->name('ajax.desig_info');

		// Route for Employee Designation add for
		Route::get('/designation_history/add', 'Employee\DesignationController@add_desig')->name('designation.add');
		Route::get('/designation_history/desig_info', 'Employee\DesignationController@desig_info')->name('ajax.desig_info');

		// Route for Employee Designation add for
		Route::get('/designation_history/add/{id}', 'Employee\DesignationController@add_desig')->name('designation.add');

		// Route for Employee  Designation Insert
		Route::post('/designation_history/store/', 'Employee\DesignationController@store')->name('designation.store_designation');

		// Route for Employee  Designation show
		Route::get('/designation_history/show/{id}', 'Employee\DesignationController@show')->name('designation.show_designation');

		// Route for Employee  Designation edit
		Route::get('/designation_history/edit/{id}', 'Employee\DesignationController@edit')->name('designation.edit_designation');

		// Route for Employee  Designation delete
		Route::delete('/designation_history/{id}', 'Employee\DesignationController@destroy')->name('designation.delete_designation');

		// Route for Employee  Designation update
		Route::patch('/designation_history/update/{id}', 'Employee\DesignationController@update')->name('designation.update_designation');

		// Route for Employee Term History
		Route::get('/term_history/term_info', 'Employee\TermController@term_info')->name('term_info');


		// Route for Employee  term show
		Route::get('/term_history/show/{id}', 'Employee\TermController@show')->name('term.show_term');

		// Route for Employee  term edit
		Route::get('/term_history/edit/{id}', 'Employee\TermController@edit')->name('term.edit_term');
		Route::patch('/term_history/update_term/{id}', 'Employee\TermController@update')->name('term.update_term');

		// Route for Employee  term edit
		Route::delete('/term_history/{id}', 'Employee\TermController@destroy')->name('term.delete_term');

		// Route for Employee  term update
		Route::patch('/term_history/update/{id}', 'Employee\TermController@update')->name('term.update_term');


		// Route for Employee Login Info
		Route::get('/ajax/login_info', 'UserController@login_info')->name('ajax.login_info');
		Route::any('/employee-details/login_info/{id}', 'UserController@set_login_info')->name('employee-details.login_info');



		//:::::::::::::::::::::::::::::Employee Payhead::::::::::::::::::::::::::::::::::::
		// Route::resource('employee-payhead', 'Configuration\Employee\EmployeePayHeadController');

		//:::::::::::::::::::::: Employee Pay Roll ::::::::::::::::::::::::::::::
		Route::get('payroll', 'Configuration\Employee\EmployeePayRollTemplateController@view')->name('payroll.view');
		Route::get('payroll-template-datatable', 'Configuration\Employee\EmployeePayRollTemplateController@datatable')->name('payroll-template.datatable');
		Route::resource('payroll-template', 'Configuration\Employee\EmployeePayRollTemplateController');

		// employee_salary_structure
		Route::resource('payroll-s-structure', 'Configuration\Employee\EmployeeSalaryStructureController');
		Route::post('employee-s-structure.ajax', 'Configuration\Employee\EmployeeSalaryStructureController@ajaxcall')->name('employee-s-structure.ajax');
		Route::get('employee-s-structure-datatable', 'Configuration\Employee\EmployeeSalaryStructureController@datatable')->name('employee-s-structure.datatable');

		// ::::::::::::::::::::::::::::::::::::::::::::::::::   Payroll ::::::::::::::::::::::::::::::::::::::::::::;;;;
		Route::get('payroll-initialize-datatable', 'Employee\PayrollController@datatable')->name('payroll-initialize.datatable');
		Route::get('payroll-initialize/print/{id}', 'Employee\PayrollController@print')->name('payroll-initialize.print');
		Route::post('payroll-initialize-step_one', 'Employee\PayrollController@step_one')->name('payroll-initialize.step_one');
		Route::resource('payroll-initialize', 'Employee\PayrollController');

		// ::::::::::::::::::::::::::::::::::::::::::::::::  Payroll Transection :::::::::::::::::::::::::::::::::::::::::::::::
		Route::get('payroll-transection-datatable', 'Employee\PayrollTransectionController@datatable')->name('payroll-transection.datatable');
		Route::post('check_payment_method', 'Employee\PayrollTransectionController@ajax')->name('check_payment_method');
		Route::post('/check_advane_return', 'Employee\PayrollTransectionController@check_advane_return')->name('check_advane_return');
		Route::post('/check_employee_payroll', 'Employee\PayrollTransectionController@check_employee_payroll')->name('check_employee_payroll');
		Route::resource('payroll-transection', 'Employee\PayrollTransectionController');


		// ::::::::::::::::::::::::::::Trash Controller:::::::::::::::::::::::::::::::::::::::::
		Route::get('trash', function () {
			return view('admin.trash.home');
		})->name('trash.index');


		//  ::::::::::::::::::::::::::::: Member Setting :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		Route::get('setting/member-setting', 'Configuration\Member\MemberSettingDashboardController@index')->name('member-setting');

		// Member Setting Nationality :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		Route::get('setting/member-setting/nationality', 'Configuration\Member\Member_Nationality_Setting_Controller@index')->name('setting.member-setting.nationality');
		Route::get('setting/member-setting/nationality-datatable', 'Configuration\Member\Member_Nationality_Setting_Controller@datatable')->name('setting.member-setting.nationality.datatable');
		Route::get('setting/member-setting/nationality/create', 'Configuration\Member\Member_Nationality_Setting_Controller@create')->name('setting.member-setting.nationality.create');
		Route::post('setting/member-setting/nationality/store', 'Configuration\Member\Member_Nationality_Setting_Controller@store')->name('setting.member-setting.nationality.store');
		Route::get('setting/member-setting/nationality/edit/{id}', 'Configuration\Member\Member_Nationality_Setting_Controller@edit')->name('setting.member-setting.nationality.edit');
		Route::patch('setting/member-setting/nationality/update/{id}', 'Configuration\Member\Member_Nationality_Setting_Controller@update')->name('setting.member-setting.nationality.update');
		Route::delete('setting/member-setting/nationality/destroy/{id}', 'Configuration\Member\Member_Nationality_Setting_Controller@destroy')->name('setting.member-setting.nationality.destroy');

		// Member Setting Religious :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		Route::get('setting/member-setting/religious', 'Configuration\Member\Member_Religious_Setting_Controller@index')->name('setting.member-setting.religious');
		Route::get('setting/member-setting/religious-datatable', 'Configuration\Member\Member_Religious_Setting_Controller@datatable')->name('setting.member-setting.religious.datatable');
		Route::get('setting/member-setting/religious/create', 'Configuration\Member\Member_Religious_Setting_Controller@create')->name('setting.member-setting.religious.create');
		Route::post('setting/member-setting/religious/store', 'Configuration\Member\Member_Religious_Setting_Controller@store')->name('setting.member-setting.religious.store');
		Route::get('setting/member-setting/religious/edit/{id}', 'Configuration\Member\Member_Religious_Setting_Controller@edit')->name('setting.member-setting.religious.edit');
		Route::patch('setting/member-setting/religious/update/{id}', 'Configuration\Member\Member_Religious_Setting_Controller@update')->name('setting.member-setting.religious.update');
		Route::delete('setting/member-setting/religious/destroy/{id}', 'Configuration\Member\Member_Religious_Setting_Controller@destroy')->name('setting.member-setting.religious.destroy');

		// Member Setting Occupation :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
		Route::get('setting/member-setting/occupation', 'Configuration\Member\Member_Occupation_Setting_Controller@index')->name('setting.member-setting.occupation');
		Route::get('setting/member-setting/occupation-datatable', 'Configuration\Member\Member_Occupation_Setting_Controller@datatable')->name('setting.member-setting.occupation.datatable');
		Route::get('setting/member-setting/occupation/create', 'Configuration\Member\Member_Occupation_Setting_Controller@create')->name('setting.member-setting.occupation.create');
		Route::post('setting/member-setting/occupation/store', 'Configuration\Member\Member_Occupation_Setting_Controller@store')->name('setting.member-setting.occupation.store');
		Route::get('setting/member-setting/occupation/edit/{id}', 'Configuration\Member\Member_Occupation_Setting_Controller@edit')->name('setting.member-setting.occupation.edit');
		Route::patch('setting/member-setting/occupation/update/{id}', 'Configuration\Member\Member_Occupation_Setting_Controller@update')->name('setting.member-setting.occupation.update');
		Route::delete('setting/member-setting/occupation/destroy/{id}', 'Configuration\Member\Member_Occupation_Setting_Controller@destroy')->name('setting.member-setting.occupation.destroy');


		// select2 ajax
		Route::get('member-list/get_people', 'Configuration\Member\MemberController@getMember');

		/*::::::::::::::Member List Section:::::::::*/
		Route::get('/member-qualification/create/{id}', 'Configuration\Member\MemberQualificationController@create')->name('member-qualification.m-create');

		Route::resource('member-qualification', 'Configuration\Member\MemberQualificationController');

		// Route for Member Contact Info
		Route::get('/member-ajax/basic_info', 'Configuration\Member\MemberController@basic_info')->name('member-ajax.basic_info');
		Route::post('/member/basic_info/update', 'Configuration\Member\MemberController@update_basic_info')->name('member.basic_info.update');


		// Route for Member Contact Info
		Route::get('/member-ajax/contact_info', 'Configuration\Member\MemberController@contact_info')->name('member-ajax.contact_info');
		Route::post('/member/contact_info/update', 'Configuration\Member\MemberController@update_contact_info')->name('member.contact_info.update');

		// Route for Member Login Info
		Route::get('/member-ajax/login_info', 'Configuration\Member\MemberController@login_info')->name('member-ajax.login_info');
		Route::any('/member-details/login_info/{id}', 'Configuration\Member\MemberController@set_login_info')->name('member-details.login_info');



		Route::get('member-list-datatable', 'Configuration\Member\MemberController@datatable')->name('member-list.datatable');
		Route::any('member-list/Image_Upload/{id}', 'Configuration\Member\MemberController@Image_Upload')->name('member-list.Image_Upload');
		Route::resource('member-list', 'Configuration\Member\MemberController');


		// the folowing route is for share deposit of a member 

		Route::get('share/share-deposit/search-member', 'Share\ShareDepositController@search_member')->name('share-deposit.search-member');

		Route::post('share/share-deposit/get-share-info', 'Share\ShareDepositController@get_share_info')->name('share-deposit.get-share-info');

		Route::resource('member/share-deposit', 'Share\ShareDepositController');

		// share withdraw 
		Route::resource('member/share-withdraw', 'Share\ShareWithdrawController');


		// the folowing route is for share withdraw of a member 
		// Route::resource('share-withdraw', 'Configuration\Member\MemberShareController');


		// ::::::::::::::::::::		Holiday section	 ::::::::::::::::::::::::::::::
		Route::get('calender/datable', 'Calender\HolidayController@datatable')->name('holiday.datatable');
		Route::resource('calender/holiday', 'Calender\HolidayController');

		// ::::::::::::::::::::		sundry calculation	 ::::::::::::::::::::::::::::::
		Route::get('sundry/sundry-calculation/datatable', 'Sundry\SundryCalculationController@datatable')->name('sundry-calculation.datatable');
		Route::resource('sundry/sundry-calculation', 'Sundry\SundryCalculationController');

		// ::::::::::::::::::::		sundry withdraw	 ::::::::::::::::::::::::::::::
		// Route::get('sundry/sundry-calculation/datatable', 'Sundry\SundryCalculationController@datatable')->name('sundry-calculation.datatable');
		Route::resource('sundry/sundry-withdraw', 'Sundry\SundryWithdrawController');

		// ::::::::::::::::::::		Expense Type	 ::::::::::::::::::::::::::::::
		Route::get('expense/expense-type/datatable', 'Expense\ExpenseTypeController@datatable')->name('expense-type.datatable');
		Route::resource('expense/expense-type', 'Expense\ExpenseTypeController');

		// ::::::::::::::::::::		Expense list Add Expense	 ::::::::::::::::::::::::::::::
		Route::get('expense/expense-list/datatable', 'Expense\ExpenseController@datatable')->name('expense-list.datatable');
		Route::get('expense/expense-list/pay/{id}', 'Expense\ExpenseController@pay')->name('expense-list.pay');
		Route::patch('expense/expense-list/submit-pay/{id}', 'Expense\ExpenseController@submit_pay')->name('expense-list.submit-pay');
		Route::resource('expense/expense-list', 'Expense\ExpenseController');


		// ::::::::::::::::::::		income Type	 ::::::::::::::::::::::::::::::
		// Route::get('income/income-type', 'Income\IncomeTypeController@datatable')->name('income-type.datatable');
		Route::get('income/income-type/datatable', 'Income\IncomeTypeController@datatable')->name('income-type.datatable');
		Route::resource('income/income-type', 'Income\IncomeTypeController');

		// ::::::::::::::::::::		income list Add income	 ::::::::::::::::::::::::::::::
		Route::get('income/income-list/datatable', 'Income\IncomeController@datatable')->name('income-list.datatable');
		Route::get('income/income-list/pay/{id}', 'Income\IncomeController@pay')->name('income-list.pay');
		Route::patch('income/income-list/submit-pay/{id}', 'Income\IncomeController@submit_pay')->name('income-list.submit-pay');
		Route::resource('income/income-list', 'Income\IncomeController');


		// :::::::::::::   The following routs are for Service Types   ::::::::::::::::

		// Loan type
		Route::get('service-type/loan-type/datable', 'Service_Type\LoanTypeController@datatable')->name('loan-type.datatable');
		Route::resource('/service-type/loan-type', 'Service_Type\LoanTypeController');



		// Savings type
		Route::get('service-type/savings-type/datable', 'Service_Type\SavingsTypeController@datatable')->name('savings-type.datatable');
		Route::resource('/service-type/savings-type', 'Service_Type\SavingsTypeController');

		// DPS type
		Route::get('service-type/dps-type/datable', 'Service_Type\DpsTypeController@datatable')->name('dps-type.datatable');
		Route::resource('/service-type/dps-type', 'Service_Type\DpsTypeController');

		// FDR type
		Route::get('service-type/fdr-type/datable', 'Service_Type\FdrTypeController@datatable')->name('fdr-type.datatable');
		Route::resource('/service-type/fdr-type', 'Service_Type\FdrTypeController');

		// double benifit type
		Route::get('service-type/double-benifit-type/datable', 'Service_Type\DoubleBenifitTypeController@datatable')->name('double-benifit-type.datatable');
		Route::resource('/service-type/double-benifit-type', 'Service_Type\DoubleBenifitTypeController');

		// Share type
		Route::get('service-type/share-type/datable', 'Service_Type\ShareTypeController@datatable')->name('share-type.datatable');
		Route::resource('/service-type/share-type', 'Service_Type\ShareTypeController');


		// :::::::::::::   The following routs are for Member Accounts   ::::::::::::::::

		// Savings Account list
		Route::get('accounts/savings-account/datable', 'Accounts\SavingsAccountController@datatable')->name('savings-account.datatable');
		Route::get('accounts/savings-account/member-info', 'Accounts\SavingsAccountController@member_info')->name('savings-account.member-info');
		Route::resource('/accounts/savings-account', 'Accounts\SavingsAccountController');
		Route::post('/store-cash-in-hand', 'Accounts\SavingsAccountController@store_cash_in_hand')->name('store_cash_in_hand');

		// Savings Deposit
		Route::get('accounts/savings-deposit/datable', 'Accounts\SavingsDepositController@datatable')->name('savings-deposit.datatable');
		Route::get('accounts/savings-deposit/member-info', 'Accounts\SavingsDepositController@member_info')->name('savings-deposit.member-info');
		Route::get('accounts/savings-deposit/member-info', 'Accounts\SavingsDepositController@member_info')->name('savings-deposit.member-info');
		Route::post('accounts/savings-deposit/get-savings-account', 'Accounts\SavingsDepositController@get_savings_account')->name('savings-deposit.get-savings-account');

		Route::post('accounts/savings-deposit/get-deposit-info', 'Accounts\SavingsDepositController@get_deposit_info')->name('savings-deposit.get-deposit-info');

		Route::resource('/accounts/savings-deposit', 'Accounts\SavingsDepositController');

		// Savings Withdraw
		Route::get('accounts/savings-withdraw/datable', 'Accounts\SavingsWithdrawConrtoller@datatable')->name('savings-withdraw.datatable');
		Route::get('accounts/savings-withdraw/member-info', 'Accounts\SavingsWithdrawConrtoller@member_info')->name('savings-withdraw.member-info');
		Route::get('accounts/savings-withdraw/member-info', 'Accounts\SavingsWithdrawConrtoller@member_info')->name('savings-withdraw.member-info');
		Route::post('accounts/savings-withdraw/get-savings-account', 'Accounts\SavingsWithdrawConrtoller@get_savings_account')->name('savings-withdraw.get-savings-account');

		Route::post('accounts/savings-withdraw/get-withdraw-info', 'Accounts\SavingsWithdrawConrtoller@get_withdraw_info')->name('savings-withdraw.get-withdraw-info');

		Route::resource('/accounts/savings-withdraw', 'Accounts\SavingsWithdrawConrtoller');

		// Loan Account
		Route::get('loan/loan-account/datable', 'Accounts\LoanAccountController@datatable')->name('loan-account.datatable');
		Route::get('loan/loan-account/member-info', 'Accounts\LoanAccountController@member_info')->name('loan-account.member-info');
		Route::get('loan/loan-account/zone-area', 'Accounts\LoanAccountController@zone_area')->name('loan-account.zone-area');
		Route::get('loan/loan-account/loan_type', 'Accounts\LoanAccountController@loan_type')->name('loan-account.loan_type');
		Route::get('loan/loan-account/verification/{uuid}', 'Accounts\LoanAccountController@verification')->name('loan-account.verification');
		Route::post('loan/loan-account.add-verification', 'Accounts\LoanAccountController@add_verification')->name('loan-account.add-verification');

		Route::get('loan/loan-account/approval/{uuid}', 'Accounts\LoanAccountController@approval')->name('loan-account.approval');
		Route::resource('loan/loan-account', 'Accounts\LoanAccountController');

		// Verified loan accounts 
		Route::get('loan/verified-loan/datable', 'Accounts\VerifiedLoanController@datatable')->name('verified-loan.datatable');
		Route::get('loan/verified-loan/approve/{uuid}', 'Accounts\VerifiedLoanController@approve')->name('verified-loan.approve');
		Route::get('loan/verified-loan/get_completation_date', 'Accounts\VerifiedLoanController@get_completation_date')->name('verified-loan.get_completation_date');

		Route::get('loan/verified-loan/previous_history/{id}', 'Accounts\VerifiedLoanController@previous_history')->name('verified-loan.previous_history');
		Route::post('loan/verified-loan.update-verification/{uuid}', 'Accounts\VerifiedLoanController@update_verification')->name('verified-loan.update-verification');
		Route::resource('loan/verified-loan', 'Accounts\VerifiedLoanController');

		// Approved loan information
		Route::get('loan/approved-loan/show/{uuid}', 'Accounts\ApprovedLoanController@show')->name('approved-loan.show');
		Route::get('loan/approved-loan/verification_info/{uuid}', 'Accounts\ApprovedLoanController@verification_info')->name('approved-loan.verification_info');
		Route::get('loan/approved-loan/datatable', 'Accounts\ApprovedLoanController@datatable')->name('approved-loan.datatable');
		Route::get('loan/approved-loan/index', 'Accounts\ApprovedLoanController@index')->name('approved-loan.index');


		// rejected loan accounts 
		Route::get('loan/rejected-loan/datatable', 'Accounts\RejectedLoanController@datatable')->name('rejected-loan.datatable');
		Route::get('loan/rejected-loan/member-info', 'Accounts\LoanAccountController@member_info')->name('rejected-loan.member-info');
		Route::get('loan/rejected-loan/zone-area', 'Accounts\LoanAccountController@zone_area')->name('rejected-loan.zone-area');
		Route::get('loan/rejected-loan/loan_type', 'Accounts\LoanAccountController@loan_type')->name('rejected-loan.loan_type');
		Route::get('loan/rejected-loan/verification/{uuid}', 'Accounts\LoanAccountController@verification')->name('rejected-loan.verification');
		Route::post('loan/rejected-loan.add-verification', 'Accounts\LoanAccountController@add_verification')->name('rejected-loan.add-verification');
		Route::get('loan/rejected-loan/approval/{uuid}', 'Accounts\LoanAccountController@approval')->name('rejected-loan.approval');
		Route::resource('loan/rejected-loan', 'Accounts\RejectedLoanController');

		// ::::::::::::::::::::::::: LOAN REPAY :::::::::::::::::::::::::::
		Route::get('loan/loan-repay/search-member', 'LoanRepay\LoanRepayController@search_member')->name('loan-repay.search-member');
		Route::post('loan/loan-repay/get-loan-account', 'LoanRepay\LoanRepayController@get_loan_account')->name('loan-repay.get-loan-account');
		Route::post('loan/loan-repay/get-loan-info', 'LoanRepay\LoanRepayController@get_loan_info')->name('loan-repay.get-loan-info');
		Route::resource('loan/loan-repay', 'LoanRepay\LoanRepayController');

		// DPS APPLICATION
		Route::get('dps/dps-application/dps_type', 'DPS\DpsApplicationController@dps_type')->name('dps-application.dps_type');
		Route::resource('dps/dps-application', 'DPS\DpsApplicationController');

		// Pending DPS APPLICATION
		Route::get('dps/dps-pending-application/datatable', 'DPS\DpsPendingApplicationController@datatable')->name('dps-pending-application.datatable');
		Route::get('dps/dps-pending-application/approval/{uuid}', 'DPS\DpsPendingApplicationController@approve')->name('dps-pending-application.approval');

		Route::patch('dps/dps-pending-application/add_approval/{uuid}', 'DPS\DpsPendingApplicationController@add_approve')->name('dps-pending-application.add_approval');
		Route::resource('dps/dps-pending-application', 'DPS\DpsPendingApplicationController');



		// Approved DPS
		Route::get('dps/approved-dps/datatable', 'DPS\ApprovedDpsController@datatable')->name('approved-dps.datatable');
		Route::get('dps/approved-dps/approval/{uuid}', 'DPS\ApprovedDpsController@approve')->name('approved-dps.approval');
		Route::patch('dps/approved-dps/add_approval/{uuid}', 'DPS\ApprovedDpsController@add_approve')->name('approved-dps.add_approval');
		Route::resource('dps/approved-dps', 'DPS\ApprovedDpsController');


		// Rejected DPS
		Route::get('dps/rejected-dps/datatable', 'DPS\RejectedDpsController@datatable')->name('rejected-dps.datatable');
		Route::get('dps/rejected-dps/approval/{uuid}', 'DPS\RejectedDpsController@approve')->name('rejected-dps.approval');
		Route::patch('dps/rejected-dps/add_approval/{uuid}', 'DPS\RejectedDpsController@add_approve')->name('rejected-dps.add_approval');
		Route::resource('dps/rejected-dps', 'DPS\RejectedDpsController');


		// dps Deposit
		Route::get('dps/dps-deposit/datable', 'DPS\DpsDepositController@datatable')->name('dps-deposit.datatable');
		Route::get('dps/dps-deposit/member-info', 'DPS\DpsDepositController@member_info')->name('dps-deposit.member-info');
		Route::get('dps/dps-deposit/member-info', 'DPS\DpsDepositController@member_info')->name('dps-deposit.member-info');
		Route::post('dps/dps-deposit/get-dps-account', 'DPS\DpsDepositController@get_dps_account')->name('dps-deposit.get-dps-account');

		Route::post('dps/dps-deposit/get-deposit-info', 'DPS\DpsDepositController@get_deposit_info')->name('dps-deposit.get-deposit-info');

		Route::resource('/dps/dps-deposit', 'DPS\DpsDepositController');




		// ::::::::::::::::::::::::: dps Withdraw :::::::::::::::::::::::::::
		Route::get('dps/dps-withdraw/search-member', 'DPS\DpsWithdrawController@search_member')->name('dps-withdraw.search-member');
		Route::post('dps/dps-withdraw/get-dps-account', 'DPS\DpsWithdrawController@get_dps_account')->name('dps-withdraw.get-dps-account');
		Route::post('dps/dps-withdraw/get-dps-info', 'DPS\DpsWithdrawController@get_dps_info')->name('dps-withdraw.get-dps-info');
		Route::resource('dps/dps-withdraw', 'DPS\DpsWithdrawController');





		// ::::::::::::::::::::::::::::: Double Benifit APPLICATION ::::::::::::::::::::::::::::::::::::::::::
		Route::get('double-benifit/double-benifit-application/double_benifit_type', 'DoubleBenifit\DoubleBenifitApplicationController@double_benifit_type')->name('double-benifit-application.double_benifit_type');
		Route::resource('double-benifit/double-benifit-application', 'DoubleBenifit\DoubleBenifitApplicationController');


		// ::::::::::::::::::::::::::::: Double Benifit Pending APPLICATION ::::::::::::::::::::::::::::::::::::::::::
		Route::get('double-benifit/pending-application/datatable', 'DoubleBenifit\DoubleBenifitPendingController@datatable')->name('double-benifit-pending-application.datatable');
		Route::get('double-benifit/pending-application/approval/{uuid}', 'DoubleBenifit\DoubleBenifitPendingController@approve')->name('double-benifit-pending-application.approval');
		Route::patch('double-benifit/pending-application/add_approval/{uuid}', 'DoubleBenifit\DoubleBenifitPendingController@add_approve')->name('double-benifit-pending-application.add_approval');
		Route::resource('double-benifit/pending-application', 'DoubleBenifit\DoubleBenifitPendingController');


		// ::::::::::::::::::::::::::::: Approved Double Benifit ::::::::::::::::::::::::::::::::::::::::::
		Route::get('double-benifit/approved/datatable', 'DoubleBenifit\ApprovedDoubleBenifitController@datatable')->name('approved-double-benifit.datatable');
		Route::get('double-benifit/approved/approval/{uuid}', 'DoubleBenifit\ApprovedDoubleBenifitController@approve')->name('approved-double-benifit.approval');
		Route::patch('double-benifit/approved/add_approval/{uuid}', 'DoubleBenifit\ApprovedDoubleBenifitController@add_approve')->name('approved-double-benifit.add_approval');
		Route::resource('double-benifit/approved-double-benifit', 'DoubleBenifit\ApprovedDoubleBenifitController');


		// ::::::::::::::::::::::::::::: Rejected Double Benifit ::::::::::::::::::::::::::::::::::::::::::
		Route::get('double-benifit/rejected/datatable', 'DoubleBenifit\RejectedDoubleBenifitController@datatable')->name('rejected-double-benifit.datatable');
		Route::get('double-benifit/rejected-double-benifit/approval/{uuid}', 'DoubleBenifit\RejectedDoubleBenifitController@approve')->name('rejected-double-benifit.approval');
		Route::patch('double-benifit/rejected-double-benifit/add_approval/{uuid}', 'DoubleBenifit\RejectedDoubleBenifitController@add_approve')->name('rejected-double-benifit.add_approval');
		Route::resource('double-benifit/rejected-double-benifit', 'DoubleBenifit\RejectedDoubleBenifitController');


		// ::::::::::::::::::::::::::::: Approved Double Benifit ::::::::::::::::::::::::::::::::::::::::::
		Route::get('double-benifit/approved/datatable', 'DoubleBenifit\ApprovedDoubleBenifitController@datatable')->name('approved-double-benifit.datatable');
		Route::get('double-benifit/approved-double-benifit/approval/{uuid}', 'DoubleBenifit\ApprovedDoubleBenifitController@approve')->name('approved-double-benifit.approval');
		Route::patch('double-benifit/approved-double-benifit/add_approval/{uuid}', 'DoubleBenifit\ApprovedDoubleBenifitController@add_approve')->name('approved-double-benifit.add_approval');
		Route::resource('double-benifit/approved-double-benifit', 'DoubleBenifit\ApprovedDoubleBenifitController');



		// ::::::::::::::::::::::::: double benifit withdraw :::::::::::::::::::::::::::
		Route::get('double-benifit/double-benifit-withdraw/search-member', 'DoubleBenifit\DoubleBenifitWithdrawController@search_member')->name('double-benifit-withdraw.search-member');
		Route::post('double-benifit/double-benifit-withdraw/get-double-benifit-account', 'DoubleBenifit\DoubleBenifitWithdrawController@get_double_benifit_account')->name('double-benifit-withdraw.get-double-benifit-account');
		Route::post('double-benifit/double-benifit-withdraw/get-double_benifit-info', 'DoubleBenifit\DoubleBenifitWithdrawController@get_double_benifit_info')->name('double-benifit-withdraw.get-double-benifit-info');
		Route::resource('double-benifit/double-benifit-withdraw', 'DoubleBenifit\DoubleBenifitWithdrawController');





		// ::::::::::::::::::::::::::::: Loan From Member APPLICATION::::::::::::::::::::::::::::::::::::::::::
		Route::get('from-member-loan/loan-from-member-application/loan_type', 'LoanFromMember\LoanFromMemberApplicatonController@loan_type')->name('loan-from-member-application.loan_type');
		Route::resource('from-member-loan/loan-from-member-application', 'LoanFromMember\LoanFromMemberApplicatonController');


		// :::::::::::::::::::::: Loan From Member Pending APPLICATION  :::::::::::::::::::::::::::::::
		Route::get('from-member-loan/pending-application/datatable', 'LoanFromMember\LoanFromMemberPendingController@datatable')->name('loan-member-pending-application.datatable');
		Route::get('from-member-loan/pending-application/approval/{uuid}', 'LoanFromMember\LoanFromMemberPendingController@approve')->name('loan-member-pending-application.approval');
		Route::get('from-member-loan/pending-application/get_completation_date', 'LoanFromMember\LoanFromMemberPendingController@get_completation_date')->name('loan-member-pending-application.get_completation_date');
		Route::patch('from-member-loan/pending-application/add_approval/{uuid}', 'LoanFromMember\LoanFromMemberPendingController@add_approve')->name('loan-member-pending-application.add_approval');
		Route::resource('from-member-loan/loan-member-pending-application', 'LoanFromMember\LoanFromMemberPendingController');

		// :::::::::::::::::::::: Loan From Member Approved APPLICATION  :::::::::::::::::::::::::::::::
		Route::get('from-member-loan/approved-application/datatable', 'LoanFromMember\LoanFromMemberApprovedController@datatable')->name('loan-member-approved-application.datatable');
		Route::get('from-member-loan/approved-application/approval/{uuid}', 'LoanFromMember\LoanFromMemberApprovedController@approve')->name('loan-member-approved-application.approval');
		Route::get('from-member-loan/approved-application/get_completation_date', 'LoanFromMember\LoanFromMemberApprovedController@get_completation_date')->name('loan-member-approved-application.get_completation_date');
		Route::patch('from-member-loan/approved-application/add_approval/{uuid}', 'LoanFromMember\LoanFromMemberApprovedController@add_approve')->name('loan-member-approved-application.add_approval');
		Route::resource('from-member-loan/loan-member-approved-application', 'LoanFromMember\LoanFromMemberApprovedController');

		// :::::::::::::::::::::: Loan From Member Rejected APPLICATION  :::::::::::::::::::::::::::::::
		Route::get('from-member-loan/rejected-application/datatable', 'LoanFromMember\LoanFromMemberRejectedController@datatable')->name('loan-member-rejected-application.datatable');
		Route::get('from-member-loan/rejected-application/approval/{uuid}', 'LoanFromMember\LoanFromMemberRejectedController@approve')->name('loan-member-rejected-application.approval');
		Route::get('from-member-loan/rejected-application/get_completation_date', 'LoanFromMember\LoanFromMemberRejectedController@get_completation_date')->name('loan-member-rejected-application.get_completation_date');
		Route::patch('from-member-loan/rejected-application/add_approval/{uuid}', 'LoanFromMember\LoanFromMemberRejectedController@add_approve')->name('loan-member-rejected-application.add_approval');
		Route::resource('from-member-loan/loan-member-rejected-application', 'LoanFromMember\LoanFromMemberRejectedController');



		// ::::::::::::::::::::::::: Loan from member withdraw :::::::::::::::::::::::::::
		Route::get('from-member-loan/fdr-withdraw/search-member', 'LoanFromMember\LoanFromMemberWithdrawController@search_member')->name('fdr-withdraw.search-member');
		Route::post('from-member-loan/fdr-withdraw/get-fdr-account', 'LoanFromMember\LoanFromMemberWithdrawController@get_fdr_account')->name('fdr-withdraw.get-fdr-account');
		Route::post('from-member-loan/fdr-withdraw/get-fdr-info', 'LoanFromMember\LoanFromMemberWithdrawController@get_fdr_info')->name('fdr-withdraw.get-fdr-info');
		Route::resource('from-member-loan/fdr-withdraw', 'LoanFromMember\LoanFromMemberWithdrawController');





		// :::::::::::::::::::::::	Bank Transactions	:::::::::::::::::::::::::::::::

		// ::::::::::::::::::::::   Bank Accounts 	::::::::::::::::::::::::::::::
		Route::get('bank-transactions/bank-accounts/datatable', 'BankAccouts\BankAccoutsController@datatable')->name('bank-accounts.datatable');
		Route::get('bank-transactions/bank-accounts/deposit/{id}', 'BankAccouts\BankAccoutsController@deposit')->name('bank-accounts.deposit');
		Route::get('bank-transactions/bank-accounts/withdraw/{id}', 'BankAccouts\BankAccoutsController@withdraw')->name('bank-accounts.withdraw');
		Route::patch('bank-transactions/bank-accounts/add-deposit/{id}', 'BankAccouts\BankAccoutsController@add_deposit')->name('bank-accounts.add-deposit');
		Route::patch('bank-transactions/bank-accounts/add-withdraw/{id}', 'BankAccouts\BankAccoutsController@add_withdraw')->name('bank-accounts.add-withdraw');
		Route::resource('bank-transactions/bank-accounts', 'BankAccouts\BankAccoutsController');


		// ::::::::::::::::::::::   Bank Deposits 	::::::::::::::::::::::::::::::
		Route::get('bank-transactions/bank-deposits/datatable', 'BankAccouts\BankDepositsController@datatable')->name('bank-deposits.datatable');
		Route::resource('bank-transactions/bank-deposits', 'BankAccouts\BankDepositsController');


		// ::::::::::::::::::::::   Bank Withdraws 	::::::::::::::::::::::::::::::
		Route::get('bank-transactions/bank-withdraws/datatable', 'BankAccouts\BankWithdrawsController@datatable')->name('bank-withdraws.datatable');
		Route::resource('bank-transactions/bank-withdraws', 'BankAccouts\BankWithdrawsController');



		// :::::::::::::::::::::: Now It's time to show Reports  :::::::::::::::::::::::::::::::

		// :::::::::::::::::::::: 			Daily Report		 :::::::::::::::::::::::::::::::
		Route::resource('reports/daily-report', 'Reports\DailyReportController');

		// :::::::::::::::::::::: 			Voucher Report		 :::::::::::::::::::::::::::::::
		Route::resource('reports/voucher-report', 'Reports\VoucherReportController');

		// :::::::::::::::::::::: 			Financial Year Report		 :::::::::::::::::::::::::::::::
		Route::resource('reports/financial-year-report', 'Reports\FinancialYearReportController');

		// :::::::::::::::::::::: 			Service Report		 :::::p::::::::::::::::::::::::::
		Route::resource('reports/service-report', 'Reports\ServiceReportController');

		// :::::::::::::::::::::: 			Member Report		 :::::p::::::::::::::::::::::::::
		Route::resource('reports/member-report', 'Reports\MemberReportController');
		Route::post('reports/member-acc-report/get-account', 'Reports\MemberReportController@get_account')->name('member-report.get-account');

		// :::::::::::::::::::::: 			income-expense Report		 :::::p::::::::::::::::::::::::::
		Route::resource('reports/income-expense-report', 'Reports\IncomeExpenseReportController');

		// :::::::::::::::::::::: 			Bank Transaction Report		 :::::p::::::::::::::::::::::::::
		Route::resource('reports/bank-tx-report', 'Reports\BankTransactionReportController');

		// :::::::::::::::::::::: 			All Transaction Report		 :::::p::::::::::::::::::::::::::
		Route::resource('reports/all-tx-report', 'Reports\AllTransactionController');

		// ::::::::::::::::::::::::::::: Trash Employee Catagory::::::::::::::::::::::::::::::::::::::::::
		Route::get('/trash/employee-category', 'TrashHandleController@EmployeeCatagoryIndex')->name('trash.employee-category');
		Route::get('/trash/employee-category-datatable', 'TrashHandleController@EmployeeCatagoryDatable')->name('trash.category.datatable');
		Route::delete('/trash/employee-category/restore/{id}', 'TrashHandleController@EmployeeCatagoryRestore')->name('trash.employee-category.restore');
		Route::delete('/trash/employee-category/destroy/{id}', 'TrashHandleController@EmployeeCatagoryForceDelete')->name('trash.employee-category.destroy');

		// ::::::::::::::::::::::::::: Trash Employee Department ::::::::::::::::::::::::::::::::::::::::::
		Route::get('/trash/employee/department', 'TrashHandleController@Employee_Department_Index')->name('trash.employee.department');
		Route::get('/trash/employee/department/datatable', 'TrashHandleController@Employee_Department_Datable')->name('trash.department.datatable');
		Route::delete('/trash/employee-department/restore/{id}', 'TrashHandleController@Employee_Department_Restore')->name('trash.employee-department.restore');
		Route::delete('/trash/employee-department/destroy/{id}', 'TrashHandleController@Employee_Department_ForceDelete')->name('trash.employee-department.destroy');

		// ::::::::::::::::::::::::::: Trash Employee Document Type ::::::::::::::::::::::::::::::::::::::::::
		Route::get('/trash/employee/document/type', 'TrashHandleController@Employee_Document_Type_index')->name('trash.employee.document.type');
		Route::get('/trash/employee/document-type/datatable', 'TrashHandleController@Employee_Document_Type_Datable')->name('trash.document-type.datatable');
		Route::delete('/trash/employee-document-type/restore/{id}', 'TrashHandleController@Employee_Document_type_Restore')->name('trash.employee-document-type.restore');
		Route::delete('/trash/employee-document-type/destroy/{id}', 'TrashHandleController@Employee_Document_Type_ForceDelete')->name('trash.employee-document-type.destroy');

		// ::::::::::::::::::::::::::: Trash Employee Leave Type ::::::::::::::::::::::::::::::::::::::::::
		Route::get('/trash/employee/leave/type', 'TrashHandleController@Employee_Leave_Type_index')->name('trash.employee.leave.type');
		Route::get('/trash/employee/leave-type/datatable', 'TrashHandleController@Employee_Leave_Type_Datable')->name('trash.leave-type.datatable');
		Route::delete('/trash/employee-leave-type/restore/{id}', 'TrashHandleController@Employee_Leave_type_Restore')->name('trash.employee-leave-type.restore');
		Route::delete('/trash/employee-leave-type/destroy/{id}', 'TrashHandleController@Employee_Leave_Type_ForceDelete')->name('trash.employee-leave-type.destroy');

		// ::::::::::::::::::::::::::: Trash Employee Pay Head ::::::::::::::::::::::::::::::::::::::::::
		Route::get('/trash/employee/payhead', 'TrashHandleController@Employee_Pay_Head_index')->name('trash.employee.pay.head');
		Route::get('/trash/employee/leave-type/datatable', 'TrashHandleController@Employee_Leave_Type_Datable')->name('trash.leave-type.datatable');
		Route::delete('/trash/employee-leave-type/restore/{id}', 'TrashHandleController@Employee_Leave_type_Restore')->name('trash.employee-leave-type.restore');
		Route::delete('/trash/employee-leave-type/destroy/{id}', 'TrashHandleController@Employee_Leave_Type_ForceDelete')->name('trash.employee-leave-type.destroy');



		// Employee Section End


		// Employee Id Card Section

		Route::get('setting/id-card-template', 'IdCardController@index')->name('id-card-template');
		Route::get('/employee-id-card/', 'IdCardController@id_card')->name('employee-id-card.id_card');
		Route::post('/employee-id-card/show', 'IdCardController@show')->name('employee-id-card.show');

		Route::get('setting/id-card-template/create', 'IdCardController@create')->name('id-card-template.create');
		Route::post('setting/id-card-template/store', 'IdCardController@store')->name('id-card-template.store');
		Route::any('setting/id-card-template/datatable', 'IdCardController@datatable')->name('id-card-template.datatable');
		Route::get('setting/id-card-template/edit/{id}', 'IdCardController@edit')->name('id-card-template.edit');
		Route::patch('setting/id-card-template/update/{id}', 'IdCardController@update')->name('id-card-template.update');
		Route::delete('setting/id-card-template/destroy/{id}', 'IdCardController@destroy')->name('id-card-template.destroy');


		Route::any('setting/general-setting', 'SettingController@index')->name('setting');
		Route::any('setting/system-setting', 'SettingController@SystemConfiguration')->name('system.setting');
		Route::any('setting/mail-setting', 'SettingController@MainConfiguration')->name('mail.setting');
		Route::any('setting/sms-setting', 'SettingController@SmsConfiguration')->name('sms.setting');
		Route::any('setting/module-setting', 'SettingController@ModudelConfiguraion')->name('module.setting');
		Route::get('backup', 'SettingController@getBackup')->name('backup');


		//  area section 

		Route::get('settings/area/datable', 'AreaController@datatable')->name('area.datatable');
		Route::resource('settings/area', 'AreaController');

		// zone section

		Route::get('settings/zone/datable', 'ZoneController@datatable')->name('zone.datatable');
		Route::resource('settings/zone', 'ZoneController');
		Route::get('settings/language', 'LanguageController@index')->name('language');
		Route::match(['get', 'post'], 'create', 'LanguageController@create')->name('language.create');

		Route::get('language/edit/{id?}', 'LanguageController@edit')->name('language.edit');
		Route::patch('language/update/{id}', 'LanguageController@update')->name('language.update');
		Route::delete('/language/delete/{id}', 'LanguageController@delete')->name('language.delete');


		/*::::::::::::::Expense & Income Section:::::::::*/
		// Route::get('setting/income-category/datatable', 'Configuration\IncomeCategoryController@datatable')->name('income-category.datatable');
		// Route::resource('setting/income-category', 'Configuration\IncomeCategoryController');

		// Route::get('setting/expense-category/datatable', 'Configuration\ExpenseCategoryController@datatable')->name('expense-category.datatable');
		// Route::resource('setting/expense-category', 'Configuration\ExpenseCategoryController');

		/*::::::::::::::user role Permission:::::::::*/
		Route::group(['as' => 'user.', 'prefix' => 'user'], function () {
			Route::get('/role', 'RoleController@index')->name('role');
			Route::get('/role/datatable', 'RoleController@datatable')->name('role.datatable');
			Route::any('/role/create', 'RoleController@create')->name('role.create');
			Route::get('/role/edit/{id}', 'RoleController@edit')->name('role.edit');
			Route::post('/role/edit', 'RoleController@update')->name('role.update');
			Route::delete('/role/delete/{id}', 'RoleController@distroy')->name('role.delete');
			//user:::::::::::::::::::::::::::::::::
			Route::get('/', 'UserController@index')->name('index');
			Route::get('/datatable', 'UserController@datatable')->name('datatable');
			Route::any('/create', 'UserController@create')->name('create');
			Route::put('/change/{value}/{id}', 'UserController@status')->name('change');
			Route::get('/edit/{id}', 'UserController@edit')->name('edit');
			Route::put('/edit', 'UserController@update')->name('update');
			Route::delete('/delete/{id}', 'UserController@destroy')->name('delete');
		});
	});

	Route::get('/home', 'HomeController@index')->name('home');
});


Route::get('/installs', 'Install\InstallController@index');
Route::get('install/database', 'Install\InstallController@database');
Route::post('install/process_install', 'Install\InstallController@process_install');
Route::get('install/create_user', 'Install\InstallController@create_user');
Route::post('install/store_user', 'Install\InstallController@store_user');
Route::get('install/system_settings', 'Install\InstallController@system_settings');
Route::post('install/finish', 'Install\InstallController@final_touch');
