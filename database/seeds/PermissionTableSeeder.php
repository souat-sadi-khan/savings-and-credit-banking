<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$data = [
			// service type settings permission
			['name' => 'service_type.view'],

			// Loan type permission 
			['name' => 'loan_type.view'],
			['name' => 'loan_type.create'],
			['name' => 'loan_type.update'],
			['name' => 'loan_type.delete'],

			// DPS type permission 
			['name' => 'dps_type.view'],
			['name' => 'dps_type.create'],
			['name' => 'dps_type.update'],
			['name' => 'dps_type.delete'],

			// Loan From Member type permission 
			['name' => 'loan_from_memebr_type.view'],
			['name' => 'loan_from_memebr_type.create'],
			['name' => 'loan_from_memebr_type.update'],
			['name' => 'loan_from_memebr_type.delete'],

			// Double Benifit type permission 
			['name' => 'double_benifit_type.view'],
			['name' => 'double_benifit_type.create'],
			['name' => 'double_benifit_type.update'],
			['name' => 'double_benifit_type.delete'],

			// member and share permission
			['name' => 'member_&_share.view'],

			// member permisssion
			['name' => 'member_list.view'],
			['name' => 'member_list.action'],

			// share deposit permission
			['name' => 'share_deposit.view'],

			// share withdraw permission
			['name' => 'share_withdraw.view'],

			// ssavings_account permission
			['name' => 'savings_account.view'],

			// savings account list permission
			['name' => 'savings_account_list.view'],
			['name' => 'savings_account_list.create'],
			['name' => 'savings_account_list.update'],
			['name' => 'savings_account_list.delete'],
			['name' => 'savings_account_list.show'],

			// saving deposit permission
			['name' => 'savings_deposit.view'],
			['name' => 'savings_deposit.create'],
			['name' => 'savings_deposit.update'],
			['name' => 'savings_deposit.delete'],

			// saving withdraw permission
			['name' => 'savings_withdraw.view'],
			['name' => 'savings_withdraw.create'],
			['name' => 'savings_withdraw.update'],
			['name' => 'savings_withdraw.delete'],

			// loan permission
			['name' => 'loan.view'],

			// Loan Application permission
			['name' => 'loan_application.view'],
			['name' => 'loan_application.update'],
			['name' => 'loan_application.delete'],
			['name' => 'loan_application.verification'],

			//Verified Loan permission
			['name' => 'verified_loan.view'],
			['name' => 'verified_loan.update'],
			['name' => 'verified_loan.approve'],
			['name' => 'verified_loan.delete_last_verification'],

			//approved_loan permission
			['name' => 'approved_loan.view'],
			['name' => 'approved_loan.update_last_verification'],
			['name' => 'approved_loan.delete_last_verification'],

			// Rejected Loan Permission
			['name' => 'rejected_loan.view'],
			['name' => 'rejected_loan.verification'],

			//  Loan Repay Permission
			['name' => 'loan_repay.view'],

			//  dps Permission
			['name' => 'dps.view'],

			//  dps_application Permission
			['name' => 'dps_application.view'],
			['name' => 'dps_application.create'],

			//  dps_pending_application Permission
			['name' => 'dps_pending_application.view'],
			['name' => 'dps_pending_application.update'],
			['name' => 'dps_pending_application.delete'],
			['name' => 'dps_pending_application.approval'],

			//  approved_dps Permission
			['name' => 'approved_dps.view'],
			['name' => 'approved_dps.update'],
			['name' => 'approved_dps.delete'],
			['name' => 'approved_dps.update_approval'],

			//  rejected_dps Permission
			['name' => 'rejected_dps.view'],
			['name' => 'rejected_dps.update'],
			['name' => 'rejected_dps.delete'],
			['name' => 'rejected_dps.update_approval'],

			//  dps_withdraw Permission
			['name' => 'dps_withdraw.view'],

			//  dps_deposit Permission
			['name' => 'dps_deposit.view'],

			//  double_benifit Permission
			['name' => 'double_benifit.view'],

			//  double benifit application Permission
			['name' => 'double_benifit_application.view'],

			//  double benifit Pending application Permission
			['name' => 'double_benifit_pending_application.view'],
			['name' => 'double_benifit_pending_application.update'],
			['name' => 'double_benifit_pending_application.delete'],
			['name' => 'double_benifit_pending_application.approval'],

			//  approved_double_benifit Permission
			['name' => 'approved_double_benifit.view'],
			['name' => 'approved_double_benifit.update'],
			['name' => 'approved_double_benifit.delete'],
			['name' => 'approved_double_benifit.update_approval'],

			//  rejected_double_benifit Permission
			['name' => 'rejected_double_benifit.view'],
			['name' => 'rejected_double_benifit.update'],
			['name' => 'rejected_double_benifit.delete'],
			['name' => 'rejected_double_benifit.update_approval'],

			//  double_benifit_withdraw Permission
			['name' => 'double_benifit_withdraw.view'],

			//  loan_from_member Permission
			['name' => 'loan_from_member.view'],

			//  loan_from_member_application Permission
			['name' => 'loan_from_member_application.view'],

			//  loan_from_member_pending_application Permission
			['name' => 'loan_from_member_pending_application.view'],
			['name' => 'loan_from_member_pending_application.update'],
			['name' => 'loan_from_member_pending_application.delete'],
			['name' => 'loan_from_member_pending_application.approval'],

			//  loan_from_member_approved_application Permission
			['name' => 'loan_from_member_approved_application.view'],
			['name' => 'loan_from_member_approved_application.update'],
			['name' => 'loan_from_member_approved_application.delete'],
			['name' => 'loan_from_member_approved_application.approval'],


			//  loan_from_member_rejected_application Permission
			['name' => 'loan_from_member_rejected_application.view'],
			['name' => 'loan_from_member_rejected_application.update'],
			['name' => 'loan_from_member_rejected_application.delete'],
			['name' => 'loan_from_member_rejected_application.approval'],

			//  loan_from_member_withdraw Permission
			['name' => 'loan_from_member_withdraw.view'],

			//  expense Permission
			['name' => 'expense.view'],
			['name' => 'expense.update'],
			['name' => 'expense.delete'],
			['name' => 'expense.pay'],

			//  expense_type Permission
			['name' => 'expense_type.view'],
			['name' => 'expense_type.create'],
			['name' => 'expense_type.update'],
			['name' => 'expense_type.delete'],

			//  income Permission
			['name' => 'income.view'],
			['name' => 'income.update'],
			['name' => 'income.delete'],
			['name' => 'income.pay'],

			//  income_type Permission
			['name' => 'income_type.view'],
			['name' => 'income_type.create'],
			['name' => 'income_type.update'],
			['name' => 'income_type.delete'],

			// bank transactions permission
			['name' => 'bank_transactions.view'],

			//  bank_accounts Permission
			['name' => 'bank_accounts.view'],
			['name' => 'bank_accounts.create'],
			['name' => 'bank_accounts.update'],
			['name' => 'bank_accounts.delete'],
			['name' => 'bank_accounts.deposit'],
			['name' => 'bank_accounts.withdraw'],

			//  bank_deposit Permission
			['name' => 'bank_deposit.view'],
			['name' => 'bank_deposit.update'],
			['name' => 'bank_deposit.delete'],

			//  bank_withdraw Permission
			['name' => 'bank_withdraw.view'],
			['name' => 'bank_withdraw.update'],
			['name' => 'bank_withdraw.delete'],

			//  sundry Permission
			['name' => 'sundry.view'],
			['name' => 'sundry_calculation.view'],
			['name' => 'sundry_withdraw.view'],

			//  report Permission
			['name' => 'report.view'],

			//  daily_report Permission
			['name' => 'daily_report.view'],

			//  voucher_report Permission
			['name' => 'voucher_report.view'],

			//  financial_year_report Permission
			['name' => 'financial_year_report.view'],

			//  service_report Permission
			['name' => 'service_report.view'],

			//  member_report Permission
			['name' => 'member_report.view'],

			//  income_expense_report Permission
			['name' => 'income_expense_report.view'],

			//  bank_tx_report Permission
			['name' => 'bank_tx_report.view'],

			//  all_transactions_report Permission
			['name' => 'all_transactions_report.view'],

			// Setting Permission
			['name' => 'setting.view'],
			['name' => 'setting.update'],

			// System Configuration Permission
			['name' => 'system_configuration.view'],
			['name' => 'system_configuration.update'],

			// Mail Configuration Permission
			['name' => 'mail_configuration.view'],
			['name' => 'mail_configuration.update'],

			// SMS Configuration Permission
			['name' => 'sms_configuration.view'],
			['name' => 'sms_configuration.update'],

			// Module Configuration Permission
			['name' => 'module_configuration.view'],
			['name' => 'module_configuration.update'],

			// member
			['name' => 'member.view'],

			// member_nationality_setting
			['name' => 'member_nationality_setting.view'],
			['name' => 'member_nationality_setting.create'],
			['name' => 'member_nationality_setting.update'],
			['name' => 'member_nationality_setting.delete'],

			// member_occupation_setting
			['name' => 'member_occupation_setting.view'],
			['name' => 'member_occupation_setting.create'],
			['name' => 'member_occupation_setting.update'],
			['name' => 'member_occupation_setting.delete'],

			// member_religious_setting
			['name' => 'member_religious_setting.view'],
			['name' => 'member_religious_setting.create'],
			['name' => 'member_religious_setting.update'],
			['name' => 'member_religious_setting.delete'],

			// area settings 
			['name' => 'area.view'],
			['name' => 'area.create'],
			['name' => 'area.update'],
			['name' => 'area.delete'],

			// area settings 
			['name' => 'zone.view'],
			['name' => 'zone.create'],
			['name' => 'zone.update'],
			['name' => 'zone.delete'],

			// Language Permission
			['name' => 'language.view'],
			['name' => 'language.create'],
			['name' => 'language.update'],
			['name' => 'language.delete'],

			// user and permission
			['name' => 'user_&_permission.view'],

			// user permission
			['name' => 'user.view'],
			['name' => 'user.create'],
			['name' => 'user.update'],
			['name' => 'user.delete'],


			// Role Permission
			['name' => 'role.view'],
			['name' => 'role.create'],
			['name' => 'role.update'],
			['name' => 'role.delete'],

			// Database Backup Permission
			['name' => 'backup.view'],


			// the following roll permission is for employee and payroll

			// Employee Permission
			['name' => 'employee.view'],

			// Employee Catagory 
			['name' => 'employee_category.view'],
			['name' => 'employee_category.create'],
			['name' => 'employee_category.update'],
			['name' => 'employee_category.delete'],

			// Employee Designation
			['name' => 'employee-designation.view'],
			['name' => 'employee-designation.create'],
			['name' => 'employee-designation.update'],
			['name' => 'employee-designation.delete'],

			// Employee Department
			['name' => 'employee_department.view'],
			['name' => 'employee_department.create'],
			['name' => 'employee_department.update'],
			['name' => 'employee_department.delete'],

			// Employee Document Type
			['name' => 'employee_document_type.view'],
			['name' => 'employee_document_type.create'],
			['name' => 'employee_document_type.update'],
			['name' => 'employee_document_type.delete'],

			// Employee ID Card
			['name' => 'employee_id_card.view'],
			['name' => 'employee_id_card.create'],
			['name' => 'employee_id_card.update'],
			['name' => 'employee_id_card.delete'],

			// Employee Leave Type
			['name' => 'employee_leave_type.view'],
			['name' => 'employee_leave_type.create'],
			['name' => 'employee_leave_type.update'],
			['name' => 'employee_leave_type.delete'],

			// Employee Leave
			['name' => 'employee_leave.view'],
			['name' => 'employee_leave.create'],
			['name' => 'employee_leave.update'],
			['name' => 'employee_leave.delete'],

			// Employee Leave Allocation
			['name' => 'employee_leave_allocation.view'],
			['name' => 'employee_leave_allocation.create'],
			['name' => 'employee_leave_allocation.update'],
			['name' => 'employee_leave_allocation.delete'],

			// Employee Leave Request
			['name' => 'employee_leave_request.view'],
			['name' => 'employee_leave_request.create'],
			['name' => 'employee_leave_request.update'],
			['name' => 'employee_leave_request.delete'],

			// Employee Attendance
			['name' => 'employee_attendance.view'],
			['name' => 'employee_attendance.create'],
			['name' => 'employee_attendance.update'],
			['name' => 'employee_attendance.delete'],

			// Employee Attendance Type
			['name' => 'employee_attendance_type.view'],
			['name' => 'employee_attendance_type.create'],
			['name' => 'employee_attendance_type.update'],
			['name' => 'employee_attendance_type.delete'],

			//  Employee Payhead	
			['name' => 'employee_payhead.view'],
			['name' => 'employee_payhead.create'],
			['name' => 'employee_payhead.update'],
			['name' => 'employee_payhead.delete'],


			//  Employee List
			['name' => 'employee_list.view'],
			['name' => 'employee_list.create'],
			['name' => 'employee_list.update'],
			['name' => 'employee_list.delete'],
			['name' => 'employee_list.action'],

			// calender and holiday permission
			['name' => 'calender.view'],
			['name' => 'holiday.create'],
			['name' => 'holiday.update'],
			['name' => 'holiday.delete'],

			// Payroll Permission
			['name' => 'employee_payroll.view'],

			// Employee payroll temeplate permission
			['name' => 'employee_payroll_template.view'],
			['name' => 'employee_payroll_template.upsate'],
			['name' => 'employee_payroll_template.delete'],

			// employee payroll salary structure permission
			['name' => 'employee_payroll_salary_structure.view'],
			['name' => 'employee_payroll_salary_structure.delete'],

			// employee payroll init permission
			['name' => 'employee_payroll_init.view'],
			['name' => 'employee_payroll_init.update'],
			['name' => 'employee_payroll_init.print'],
			['name' => 'employee_payroll_init.delete'],

			// Employee payroll transaction permission
			['name' => 'employee_payroll_transection.view'],
			['name' => 'employee_payroll_transection.delete'],

			//  Employee payroll template
			['name' => 'employee_payroll_template.view'],
			['name' => 'employee_payroll_template.create'],
			['name' => 'employee_payroll_template.update'],
			['name' => 'employee_payroll_template.delete'],
		];

		$insert_data = [];
		$time_stamp = Carbon::now();
		foreach ($data as $d) {
			$d['guard_name'] = 'web';
			$d['created_at'] = $time_stamp;
			$insert_data[] = $d;
		}
		Permission::insert($insert_data);
	}
}
