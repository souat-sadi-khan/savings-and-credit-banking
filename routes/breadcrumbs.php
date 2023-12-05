<?php

// Home

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > Settings
Breadcrumbs::for('settings', function ($trail) {
    $trail->parent('home');
    $trail->push('Settings', route('admin.setting'));
});

// Home > Expense Category
Breadcrumbs::for('expense-category', function ($trail) {
    $trail->parent('home');
    $trail->push('Expense Category', route('admin.expense-category.index'));
});

// Home > Income Category
Breadcrumbs::for('income-category', function ($trail) {
    $trail->parent('home');
    $trail->push('Income Category', route('admin.income-category.index'));
});

// Home > System Configuration
Breadcrumbs::for('system-settings', function ($trail) {
    $trail->parent('home');
    $trail->push('System Configuration', route('admin.system.setting'));
});

// Home > mail Configuration
Breadcrumbs::for('mail-settings', function ($trail) {
    $trail->parent('home');
    $trail->push('Mail Configuration', route('admin.mail.setting'));
});

// Home > sms Configuration
Breadcrumbs::for('sms-settings', function ($trail) {
    $trail->parent('home');
    $trail->push('SMS Configuration', route('admin.sms.setting'));
});

// Home > Module Configuration
Breadcrumbs::for('module-settings', function ($trail) {
    $trail->parent('home');
    $trail->push('Module Configuration', route('admin.module.setting'));
});

// Home > Employee Id Card
Breadcrumbs::for('employee-id-card', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Id Card', route('admin.id-card-template'));
});


// Employee Section

// Home > Employee Department
Breadcrumbs::for('employee-department', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Department', route('admin.employee.department.index'));
});
// Home > Employee Document Type
Breadcrumbs::for('employee-document-type', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Document Type', route('admin.employee-document-type.index'));
});

// Home > Employee Category
Breadcrumbs::for('employee-category', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Category', route('admin.employee-category.index'));
});


// Home > Employee Attendance Type
Breadcrumbs::for('employee-attendance-type', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Attendance Type', route('admin.employee-attendance-type.index'));
});

// Home > Employee Attendance
Breadcrumbs::for('employee-attendance', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Attendance', route('admin.employee-attendance.index'));
});

// Home > Employee Attendance Create
Breadcrumbs::for('employee-attendance-create', function ($trail) {
    $trail->parent('employee-attendance');
    $trail->push('Create', route('admin.employee-attendance.create'));
});

// Home > Employee leave
Breadcrumbs::for('employee-leave', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Leave', route('admin.employee-leave.view'));
});

// Home > Employee payroll
Breadcrumbs::for('employee-payroll', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Payroll', route('admin.employee-payroll.view'));
});

// Home > Employee payroll template
Breadcrumbs::for('employee-payroll-template', function ($trail) {
    $trail->parent('employee-payroll');
    $trail->push('Template', route('admin.employee-payroll-template.index'));
});

// Home > Employee leave allocation
Breadcrumbs::for('employee-leave-allocation', function ($trail) {
    $trail->parent('employee-leave');
    $trail->push('Allocation', route('admin.employee-leave-allocation.index'));
});

// Home > Employee leave Request
Breadcrumbs::for('employee-leave-request', function ($trail) {
    $trail->parent('employee-leave');
    $trail->push('Request', route('admin.employee-leave-request.index'));
});

// Home > Employee leave type
Breadcrumbs::for('employee-leave-type', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Leave Type', route('admin.employee-leave-type.index'));
});

// Home > Employee Pay Head
Breadcrumbs::for('employee-pay-head', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Pay Head', route('admin.employee-pay-head.index'));
});

// Home > Designation
Breadcrumbs::for('designation', function ($trail) {
    $trail->parent('home');
    $trail->push('Designation', route('admin.designation.index'));
});
// Home > Employee list
Breadcrumbs::for('employee-list', function ($trail) {
    $trail->parent('home');
    $trail->push('Employee Designation', route('admin.employee-list.index'));
});

// Home > Language
Breadcrumbs::for('language', function ($trail) {
    $trail->parent('home');
    $trail->push('Language', route('admin.language'));
});

// Home > Language > Translate
Breadcrumbs::for('language/edit', function ($trail) {
    $trail->parent('home');
    $trail->push('Language', route('admin.language'));
    $trail->push('Translate', route('admin.language.edit'));
});

// Home > Roles & Permission
Breadcrumbs::for('role', function ($trail) {
    $trail->parent('home');
    $trail->push('Roles & Permission', route('admin.user.role'));
});

// Home > Roles & Permission > Create
Breadcrumbs::for('role/create', function ($trail) {
    $trail->parent('home');
    $trail->push('Roles & Permission', route('admin.user.role'));
    $trail->push('Create', route('admin.user.role.create'));
});

// Home > Roles & Permission > Edit
Breadcrumbs::for('role/edit', function ($trail, $id) {
    $trail->parent('home');
    $trail->push('Roles & Permission', route('admin.user.role'));
    $trail->push('Edit', route('admin.user.role.edit', $id));
});

// Home > User
Breadcrumbs::for('/', function ($trail) {
    $trail->parent('home');
    $trail->push('Users', route('admin.user.index'));
});

// Home > User > Create
Breadcrumbs::for('/create', function ($trail) {
    $trail->parent('home');
    $trail->push('Users', route('admin.user.index'));
    $trail->push('Create', route('admin.user.create'));
});

// Home > User > Edit
Breadcrumbs::for('/edit', function ($trail, $id) {
    $trail->parent('home');
    $trail->push('Users', route('admin.user.index'));
    $trail->push('Edit', route('admin.user.edit', $id));
});

// Home > Employee List > Employee Details
Breadcrumbs::for('/employee-details', function ($trail, $id) {
    $trail->parent('home');
    $trail->push('Employee List', route('admin.employee-list.index'));
    $trail->push('Employee Details Information', route('admin.employee-list.edit', $id));
});

// // Home > Blog
// Breadcrumbs::for('blog', function ($trail) {
//     $trail->parent('home');
//     $trail->push('Blog', route('blog'));
// });

// Recycle Bin Start

// Trash Home 
Breadcrumbs::for('trash', function ($trail) {
    $trail->push('Recycle Bin Home', route('admin.trash.index'));
});

// Home > Trash Employee Catagory
Breadcrumbs::for('trash-employee-category', function ($trail) {
    $trail->parent('trash');
    $trail->push('Trash Employee Category', route('admin.trash.employee-category'));
});

// Home > Trash Employee Department
Breadcrumbs::for('trash-employee-department', function ($trail) {
    $trail->parent('trash');
    $trail->push('Trash Employee Department', route('admin.trash.employee.department'));
});

// Home > Trash Employee Document Type
Breadcrumbs::for('trash-employee-document-type', function ($trail) {
    $trail->parent('trash');
    $trail->push('Trash Employee Document Type', route('admin.trash.employee.document.type'));
});

// Home > Trash Employee Leave Type
Breadcrumbs::for('trash-employee-leave-type', function ($trail) {
    $trail->parent('trash');
    $trail->push('Trash Employee leave Type', route('admin.trash.employee.leave.type'));
});

// Home > Trash Employee Pay Head
Breadcrumbs::for('trash-employee-pay-head', function ($trail) {
    $trail->parent('trash');
    $trail->push('Trash Employee Pay Head', route('admin.trash.employee.payhead'));
});

// Member Setting Home
Breadcrumbs::for('member_setting', function ($trail) {
    $trail->push('Member Setting Home', route('admin.member-setting'));
});

// Member Home > Nationality
Breadcrumbs::for('setting_member_nationality', function ($trail) {
    $trail->parent('member_setting');
    $trail->push('Nationality', route('admin.setting.member-setting.nationality'));
});

// Member Home > Religious
Breadcrumbs::for('setting_member_religious', function ($trail) {
    $trail->parent('member_setting');
    $trail->push('Religious', route('admin.setting.member-setting.religious'));
});

// Member Home > Occupation
Breadcrumbs::for('setting_member_occupation', function ($trail) {
    $trail->parent('member_setting');
    $trail->push('Occupation', route('admin.setting.member-setting.occupation'));
});


// Member Section Start

//  Home > Member List
Breadcrumbs::for('member-list', function ($trail) {
    $trail->parent('home');
    $trail->push('Member List', route('admin.member-list.index'));
});

//  Home > Member List >Member Create
Breadcrumbs::for('member-list-create', function ($trail) {
    $trail->parent('member-list');
    $trail->push('Create', route('admin.member-list.create'));
});

// Home > Member List > Member Details
Breadcrumbs::for('/member-details', function ($trail, $id) {
    $trail->parent('member-list');
    $trail->push('Member Details Information', route('admin.member-list.edit', $id));
});


// Home > Calender > Holiday
Breadcrumbs::for('holiday', function ($trail) {
    $trail->parent('home');
    $trail->push('Holiday Information', route('admin.holiday.index'));
});

// Home > Expense > Expense Type
Breadcrumbs::for('expense-type', function ($trail) {
    $trail->parent('home');
    $trail->push('Expense Type', route('admin.expense-type.index'));
});

// Home > Expense > Expense list
Breadcrumbs::for('expense-list', function ($trail) {
    $trail->parent('home');
    $trail->push('Expense List', route('admin.expense-list.index'));
});

// Home > Income > Income Type
Breadcrumbs::for('income-type', function ($trail) {
    $trail->parent('home');
    $trail->push('Income Type', route('admin.income-type.index'));
});

// Home > Income > Income list
Breadcrumbs::for('income-list', function ($trail) {
    $trail->parent('home');
    $trail->push('Income List', route('admin.income-list.index'));
});

// Home > Settings > Area
Breadcrumbs::for('area', function ($trail) {
    $trail->parent('home');
    $trail->push('Area Information', route('admin.area.index'));
});

// Home > Settings > Zone
Breadcrumbs::for('zone', function ($trail) {
    $trail->parent('home');
    $trail->push('Zone Information', route('admin.zone.index'));
});

// Home > Service Type > Loan Type
Breadcrumbs::for('loan-type', function ($trail) {
    $trail->parent('home');
    $trail->push('Loan Type', route('admin.loan-type.index'));
});

// Home > Service Type > Savings Type
Breadcrumbs::for('savings-type', function ($trail) {
    $trail->parent('home');
    $trail->push('Savings Type', route('admin.savings-type.index'));
});

// Home > Service Type > DPS Type
Breadcrumbs::for('dps-type', function ($trail) {
    $trail->parent('home');
    $trail->push('DPS Type', route('admin.dps-type.index'));
});

// Home > Service Type > FDR Type
Breadcrumbs::for('fdr-type', function ($trail) {
    $trail->parent('home');
    $trail->push('Loan From Member Type', route('admin.fdr-type.index'));
});

// Home > Service Type > DOUBLE BENIFIT Type
Breadcrumbs::for('double-benifit-type', function ($trail) {
    $trail->parent('home');
    $trail->push('Double Benifit Type', route('admin.double-benifit-type.index'));
});

// Home > Service Type > Share Type
Breadcrumbs::for('share-type', function ($trail) {
    $trail->parent('home');
    $trail->push('Share Type', route('admin.share-type.index'));
});

// Home > Accounts > Savings Account
Breadcrumbs::for('savings-account', function ($trail) {
    $trail->parent('home');
    $trail->push('Savings Account', route('admin.savings-account.index'));
});

// Home > Accounts > Savings Deposit
Breadcrumbs::for('savings-deposit', function ($trail) {
    $trail->parent('home');
    $trail->push('Savings Deposit', route('admin.savings-deposit.index'));
});

// Home > Accounts > Savings Deposit
Breadcrumbs::for('savings-withdraw', function ($trail) {
    $trail->parent('home');
    $trail->push('Savings Withdraw', route('admin.savings-withdraw.index'));
});


// Home > Accounts > Loan Account
Breadcrumbs::for('loan-account', function ($trail) {
    $trail->parent('home');
    $trail->push('Loan Account', route('admin.loan-account.index'));
});



// Home > Accounts > Loan Account
Breadcrumbs::for('verified-loan', function ($trail) {
    $trail->parent('home');
    $trail->push('Verified Loan', route('admin.verified-loan.index'));
});

// Home > Accounts > Approved Loan 
Breadcrumbs::for('approved-loan', function ($trail) {
    $trail->parent('home');
    $trail->push('Approved Loan', route('admin.approved-loan.index'));
});

// Home > Accounts > Approved Loan 
Breadcrumbs::for('rejected-loan', function ($trail) {
    $trail->parent('home');
    $trail->push('Rejected Loan', route('admin.rejected-loan.index'));
});

// Home > Accounts > Loan repay 
Breadcrumbs::for('loan-repay', function ($trail) {
    $trail->parent('home');
    $trail->push('Loan Repay', route('admin.loan-repay.index'));
});

// Home > DPS > DPS Application 
Breadcrumbs::for('dps-application', function ($trail) {
    $trail->parent('home');
    $trail->push('DPS Application', route('admin.dps-application.index'));
});

// Home > DPS > DPS Pending Application 
Breadcrumbs::for('dps-pending-application', function ($trail) {
    $trail->parent('home');
    $trail->push('DPS Pending Application', route('admin.dps-pending-application.index'));
});

// Home > DPS > Approved DPS
Breadcrumbs::for('approved-dps', function ($trail) {
    $trail->parent('home');
    $trail->push('Approved DPS', route('admin.approved-dps.index'));
});

// Home > DPS > rejected DPS
Breadcrumbs::for('rejected-dps', function ($trail) {
    $trail->parent('home');
    $trail->push('Rejected DPS', route('admin.rejected-dps.index'));
});

// Home > DPS >  DPS deposit
Breadcrumbs::for('dps-deposit', function ($trail) {
    $trail->parent('home');
    $trail->push('DPS Deposit', route('admin.dps-deposit.index'));
});

// Home  > Double Benifit Application
Breadcrumbs::for('double-benifit-application', function ($trail) {
    $trail->parent('home');
    $trail->push('Double Benifit Application', route('admin.double-benifit-application.index'));
});



// Home  > double-benifit-pending-application
Breadcrumbs::for('double-benifit-pending-application', function ($trail) {
    $trail->parent('home');
    $trail->push('Double Benifit Pending Application', route('admin.double-benifit-pending-application.index'));
});

// Home  > rejected-double-benifit
Breadcrumbs::for('rejected-double-benifit', function ($trail) {
    $trail->parent('home');
    $trail->push('Rejected Double Benifit Application', route('admin.rejected-double-benifit.index'));
});
// Home  > approved-double-benifit
Breadcrumbs::for('approved-double-benifit', function ($trail) {
    $trail->parent('home');
    $trail->push('Approved Double Benifit Application', route('admin.approved-double-benifit.index'));
});

// Home  > loan-from-member-application
Breadcrumbs::for('loan-from-member-application', function ($trail) {
    $trail->parent('home');
    $trail->push('Loan From Member Application', route('admin.loan-from-member-application.index'));
});

// Home  > bank-accounts
Breadcrumbs::for('bank-accounts', function ($trail) {
    $trail->parent('home');
    $trail->push('Bank Accounts', route('admin.bank-accounts.index'));
});

// Home  > bank-deposits
Breadcrumbs::for('bank-deposits', function ($trail) {
    $trail->parent('home');
    $trail->push('Bank Deposits', route('admin.bank-deposits.index'));
});

// Home  > bank-withdraw
Breadcrumbs::for('bank-withdraws', function ($trail) {
    $trail->parent('home');
    $trail->push('Bank Withdraws', route('admin.bank-withdraws.index'));
});

// Home  > daily-report
Breadcrumbs::for('daily-report', function ($trail) {
    $trail->parent('home');
    $trail->push('Daily Reports', route('admin.daily-report.index'));
});

// Home  > voucher-report
Breadcrumbs::for('voucher-report', function ($trail) {
    $trail->parent('home');
    $trail->push('Voucher Reports', route('admin.voucher-report.index'));
});

// Home  > credit voucher
Breadcrumbs::for('credit-voucher', function ($trail) {
    $trail->parent('home');
    $trail->push('Credit Voucher', route('admin.voucher-report.index'));
});

// Home  > debit voucher
Breadcrumbs::for('debit-voucher', function ($trail) {
    $trail->parent('home');
    $trail->push('Debit Voucher', route('admin.voucher-report.index'));
});

// Home  > debit voucher
Breadcrumbs::for('share-deposit', function ($trail) {
    $trail->parent('home');
    $trail->push('Share Deposit', route('admin.share-deposit.index'));
});

// Sadik Start

    // Home > Employee payroll Salary Structure
    Breadcrumbs::for('employee-payroll-salary-structure', function ($trail) {
        $trail->parent('employee-payroll');
        $trail->push('Salary Structure', route('admin.payroll-s-structure.index'));
    });

    // Home > Employee payroll Iniatitalization
    Breadcrumbs::for('employee-payroll-init', function ($trail) {
        $trail->parent('employee-payroll');
        $trail->push('Init', route('admin.payroll-initialize.index'));
    });
    
    // Home > Employee payroll Transection
    Breadcrumbs::for('employee-payroll-transection', function ($trail) {
        $trail->parent('employee-payroll');
        $trail->push('Transection', route('admin.payroll-transection.index'));
    });