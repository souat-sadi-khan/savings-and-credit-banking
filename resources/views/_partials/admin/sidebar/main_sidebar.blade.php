        {{-- Dashboard --}}
        <li><a class="app-menu__item {{ Request::is('home') ? ' active' : '' }}" href="{{ route('home') }}"><i
                    class="app-menu__icon fa fa-dashboard"></i><span
                    class="app-menu__label">{{_lang('dashboard')}}</span></a></li>

        @can('employee.view')
        {{-- Employee --}}
        <li class="treeview {{ Request::is('admin/employee*') ? ' is-expanded' : '' }}"><a class="app-menu__item"
                href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-circle"></i><span
                    class="app-menu__label">{{_lang('Employee')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('employee_category.view')
                {{-- Employee Document Type --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee-category*') ? 'active':''}}"
                        href="{{ route('admin.employee-category.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Employee Category')}}</a></li>
                @endcan

                @can('employee-designation.view')
                {{-- Designation Type --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee/designation*') ? 'active':''}}"
                        href="{{ route('admin.designation.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Designation')}}</a></li>
                @endcan

                @can('employee_departmeent.view')
                {{-- Employee Department --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee/department*') ? 'active':''}}"
                        href="{{ route('admin.employee.department.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Employee Department')}}</a></li>
                @endcan

                @can('employee_document_type.view')
                {{-- Employee Document Type --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee-document-type*') ? 'active':''}}"
                        href="{{ route('admin.employee-document-type.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Employee Document Type')}}</a></li>
                @endcan

                @can('employee_id_card.view')
                {{-- Employee Id Card --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee-id-card*') ? 'active':''}}"
                        href="{{ route('admin.employee-id-card.id_card') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Employee Id Card')}}</a></li>
                @endcan

                @can('employee_leave_type.view')
                {{-- Employee Leave Type --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee-leave-type') ? 'active':''}}"
                        href="{{ route('admin.employee-leave-type.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Employee Leave Type')}}</a></li>
                @endcan

                @can('employee_leave.view')
                {{-- Employee Leave Type --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee-leave') ? 'active':''}}"
                        href="{{ route('admin.employee-leave.view') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Employee Leave')}}</a></li>
                @endcan

                @can('employee_attendance_type.view')
                {{-- Employee Attendance Type --}}
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/employee-attendance-type*') ? 'active':''}}"
                        href="{{ route('admin.employee-attendance-type.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Employee Attendance Type')}}</a></li>
                @endcan

                @can('employee_attendance.view')
                {{-- Employee Attendance --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee-attendance*') ? 'active':''}}"
                        href="{{ route('admin.employee-attendance.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Employee Attendance')}}</a></li>
                @endcan

                @can('employee_payhead.view')
                {{-- Employee Payhead Type --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee-pay-head*') ? 'active':''}}"
                        href="{{ route('admin.employee-pay-head.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Employee Payhead')}}</a></li>
                @endcan

                @can('employee_list.view')
                {{-- Employee list --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee-list*') ? 'active':''}}"
                        href="{{ route('admin.employee-list.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Employee List')}}</a></li>
                @endcan

            </ul>
        </li>
        @endcan


        @can('calender.view')
        {{-- Calender --}}
        <li class="treeview {{ Request::is('admin/calender*') ? ' is-expanded' : '' }}"><a class="app-menu__item"
                href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-calendar"></i><span
                    class="app-menu__label">{{_lang('Calender')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('holiday.view')
                {{-- Holiday --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/calender/holiday*') ? 'active':''}}"
                        href="{{ route('admin.holiday.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Holiday')}}</a></li>
                @endcan
            </ul>
        </li>
        @endcan



            {{-- Employee Payroll --}}
        @can('employee_payroll.view')
                <li data-placement="bottom" title="Employee PayRoll System"><a class="app-menu__item {{ Request::is('admin/payroll*') ? ' active' : '' }}" href="{{ route('admin.payroll.view') }}"><i class="app-menu__icon fa fa-calculator" aria-hidden="true"></i><span class="app-menu__label">{{_lang('Payroll')}}</span></a></li>
        @endcan


        {{-- following section is for service type --}}
        @can('service_type.view')
        {{-- service-type --}}
        <li class="treeview {{ Request::is('admin/service-type*') ? ' is-expanded' : '' }}"><a class="app-menu__item"
                href="#" data-toggle="treeview"><i class="app-menu__icon fa fa fa-cog"></i><span
                    class="app-menu__label">{{_lang('Service Type Settings')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">

                @can('loan_type.view')
                {{-- Loan type --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/service-type/loan-type') ? 'active':''}}"
                        href="{{ route('admin.loan-type.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Loan Type')}}</a></li>
                @endcan

                {{-- @can('savings_type.view') --}}
                {{-- Savings type --}}
                {{-- <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/service-type/savings-type') ? 'active':''}}"
                        href="{{ route('admin.savings-type.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Savings Type')}}</a></li>
                @endcan --}}

                @can('dps_type.view')
                {{-- dps type --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/service-type/dps-type') ? 'active':''}}"
                        href="{{ route('admin.dps-type.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('DPS Type')}}</a></li>
                @endcan

                @can('loan_from_memebr_type.view')
                {{-- FDR type --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/service-type/fdr-type') ? 'active':''}}"
                        href="{{ route('admin.fdr-type.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Loan From Member Type')}}</a></li>
                @endcan

                @can('double_benifit_type.view')
                {{-- Double Benifit --}}
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/service-type/double-benifit-type') ? 'active':''}}"
                        href="{{ route('admin.double-benifit-type.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Double Benifit Type')}}</a></li>
                @endcan

                {{-- @can('share_type.view') --}}
                {{-- Share type --}}
                {{-- <li class="mt-1"><a class="treeview-item {{Request::is('admin/service-type/share-type') ? 'active':''}}"
                        href="{{ route('admin.share-type.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Share Type')}}</a></li>
                @endcan --}}

            </ul>
        </li>
        @endcan

        @can('member_&_share.view')
        {{-- Member --}}
        <li class="treeview {{ Request::is('admin/member*') ? ' is-expanded' : '' }}"><a class="app-menu__item" href="#"
                data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span
                    class="app-menu__label">{{_lang('Member & Share')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('member_list.view')
                {{-- Member List --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/member-list*') ? 'active':''}}"
                        href="{{ route('admin.member-list.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Member List')}}</a></li>
                @endcan
            </ul>
            <ul class="treeview-menu">
                @can('share_deposit.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/member/share-deposit*') ? 'active':''}}"
                        href="{{ route('admin.share-deposit.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Share Deposit')}}</a></li>
                @endcan
                @can('share_withdraw.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/member/share-withdraw*') ? 'active':''}}"
                        href="{{ route('admin.share-withdraw.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Share Withdraw')}}</a></li>
                @endcan
            </ul>
            <ul class="treeview-menu">
                    
                {{-- @can('share_withdraw.view') --}}
                {{-- Member List --}}
                {{-- <li class="mt-1"><a class="treeview-item {{Request::is('admin/share-withdraw*') ? 'active':''}}"
                        href="{{ route('admin.share-withdraw.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Share Withdraw')}}</a></li> --}}
                {{-- @endcan --}}
            </ul>
        </li>
        @endcan



        {{-- following section is for Savings Accounts --}}
        @can('savings_account.view')
        {{-- accounts --}}
        <li class="treeview {{ Request::is('admin/accounts*') ? ' is-expanded' : '' }}"><a class="app-menu__item"
                href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-usd"></i><span
                    class="app-menu__label">{{_lang('Savings Account')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">

                {{-- Savings Account List --}}
                @can('savings_account_list.view')
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/accounts/savings-account*') ? 'active':''}}"
                        href="{{ route('admin.savings-account.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Savings Account List')}}</a></li>
                @endcan

                {{-- Savings deposit List --}}
                @can('savings_deposit.view')
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/accounts/savings-deposit*') ? 'active':''}}"
                        href="{{ route('admin.savings-deposit.create') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Savings Deposit')}}</a></li>
                @endcan

                {{-- Savings withdraw List --}}
                @can('savings_withdraw.view')
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/accounts/savings-withdraw*') ? 'active':''}}"
                        href="{{ route('admin.savings-withdraw.create') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Savings Withdraw')}}</a></li>
                @endcan


            </ul>
        </li>
        @endcan





        {{-- following section is for loan accounts --}}
        @can('loan.view')
        {{-- Loan --}}
        <li class="treeview {{ Request::is('admin/loan*') ? ' is-expanded' : '' }}"><a class="app-menu__item" href="#"
                data-toggle="treeview"><i class="app-menu__icon fa fa-bar-chart"></i><span
                    class="app-menu__label">{{_lang('Loan')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">


                {{-- Loan Application  --}}
                @can('loan_application.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/loan/loan-account*') ? 'active':''}}"
                        href="{{ route('admin.loan-account.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Loan Application')}}</a></li>
                @endcan

                {{--Verified Loan Account  --}}
                @can('verified_loan.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/loan/verified-loan*') ? 'active':''}}"
                        href="{{ route('admin.verified-loan.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Verified Loan')}}</a></li>
                @endcan

                {{--Approved Loan Account  --}}
                @can('approved_loan.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/loan/approved-loan*') ? 'active':''}}"
                        href="{{ route('admin.approved-loan.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Approved Loan')}}</a></li>
                @endcan


                {{--Rejected Loan Account  --}}
                @can('rejected_loan.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/loan/rejected-loan*') ? 'active':''}}"
                        href="{{ route('admin.rejected-loan.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Rejected Loan')}}</a></li>
                @endcan

                {{--Loan Repay  --}}
                @can('loan_repay.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/loan/loan-repay') ? 'active':''}}"
                        href="{{ route('admin.loan-repay.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Loan Repay')}}</a></li>
                @endcan


            </ul>
        </li>
        @endcan




        {{-- following section is for DPS --}}
        @can('dps.view')
        {{-- DPS --}}
        <li class="treeview {{ Request::is('admin/dps*') ? ' is-expanded' : '' }}"><a class="app-menu__item" href="#"
                data-toggle="treeview"><i class="app-menu__icon fa fa-handshake-o"></i><span
                    class="app-menu__label">{{_lang('DPS')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">

                {{-- DPS Application --}}
                @can('dps_application.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/dps/dps-application*') ? 'active':''}}"
                        href="{{ route('admin.dps-application.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('DPS Application')}}</a></li>
                @endcan

                {{-- DPS Application --}}
                @can('dps_pending_application.view')
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/dps/dps-pending-application*') ? 'active':''}}"
                        href="{{ route('admin.dps-pending-application.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Pending Applications')}}</a></li>
                @endcan

                {{--Approved DPS Application --}}
                @can('approved_dps.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/dps/approved-dps*') ? 'active':''}}"
                        href="{{ route('admin.approved-dps.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Approved DPS')}}</a></li>
                @endcan

                {{--Rejected DPS Application --}}
                @can('rejected_dps.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/dps/rejected-dps*') ? 'active':''}}"
                        href="{{ route('admin.rejected-dps.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Rejected DPS')}}</a></li>
                @endcan


                {{-- Savings deposit List --}}
                @can('dps_deposit.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/dps/dps-deposit*') ? 'active':''}}"
                        href="{{ route('admin.dps-deposit.create') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('DPS Deposit')}}</a></li>
                @endcan

                {{-- Savings deposit List --}}
                @can('dps_withdraw.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/dps/dps-withdraw*') ? 'active':''}}"
                        href="{{ route('admin.dps-withdraw.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('DPS Withdraw')}}</a></li>
                @endcan


                {{-- Savings Withdraw List --}}
                {{-- @can('dps_withdraw.view')
               <li class="mt-1"><a class="treeview-item {{Request::is('admin/dps/dps-withdraw*') ? 'active':''}}"
                href="{{ route('admin.dps-withdraw.index') }}"><i class="icon fa fa-circle-o"></i>
                {{_lang('DPS Withdraw')}}</a>
        </li>
        @endcan --}}

        </ul>
        </li>
        @endcan



        {{-- following section is for Double Benifit --}}
        @can('double_benifit.view')
        {{-- Double Benifit --}}
        <li class="treeview {{ Request::is('admin/double-benifit*') ? ' is-expanded' : '' }}"><a class="app-menu__item"
                href="#" data-toggle="treeview"><i class="app-menu__icon fa fa fa-line-chart"></i><span
                    class="app-menu__label">{{_lang('Double Benifit')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">

                {{-- double-benifit Application --}}
                @can('double_benifit_application.view')
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/double-benifit/double-benifit-application*') ? 'active':''}}"
                        href="{{ route('admin.double-benifit-application.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Double Benifit Application')}}</a></li>
                @endcan

                {{-- double-benifit Pending Application --}}
                @can('double_benifit_pending_application.view')
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/double-benifit/pending-application*') ? 'active':''}}"
                        href="{{ route('admin.pending-application.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Pending Applications')}}</a></li>
                @endcan

                {{--Approved double-benifit Application --}}
                @can('approved_double_benifit.view')
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/double-benifit/approved*') ? 'active':''}}"
                        href="{{ route('admin.approved-double-benifit.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Approved Double Benifit')}}</a></li>
                @endcan

                {{--Rejected double-benifit Application --}}
                @can('rejected_double_benifit.view')
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/double-benifit/rejected*') ? 'active':''}}"
                        href="{{ route('admin.rejected-double-benifit.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Rejected Double Benifit')}}</a></li>
                @endcan

                {{-- double-benifit withdraw --}}
                @can('double_benifit_withdraw.view')
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/double-benifit/double-benifit-withdraw*') ? 'active':''}}"
                        href="{{ route('admin.double-benifit-withdraw.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Withdraw')}}</a></li>
                @endcan


            </ul>
        </li>
        @endcan


        {{-- following section is for Loan From Member --}}
        @can('loan_from_member.view')
        {{-- Loan From Member --}}
        <li class="treeview {{ Request::is('admin/from-member-loan*') ? ' is-expanded' : '' }}"><a
                class="app-menu__item" href="#" data-toggle="treeview"><i
                    class="app-menu__icon fa fa fa-cc-mastercard"></i><span
                    class="app-menu__label">{{_lang('Loan From Member')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">

                {{-- Loan From Member Application --}}
                @can('loan_from_member_application.view')
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/from-member-loan/loan-from-member-application*') ? 'active':''}}"
                        href="{{ route('admin.loan-from-member-application.index') }}"><i
                            class="icon fa fa-circle-o"></i> {{_lang('Application')}}</a></li>
                @endcan

                {{-- Loan From Member Pending Application --}}
                @can('loan_from_member_pending_application.view')
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/from-member-loan/loan-member-pending-application*') ? 'active':''}}"
                        href="{{ route('admin.loan-member-pending-application.index') }}"><i
                            class="icon fa fa-circle-o"></i> {{_lang('Pending Applications')}}</a></li>
                @endcan

                {{-- Loan From Member approved Application --}}
                @can('loan_from_member_approved_application.view')
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/from-member-loan/loan-member-approved-application*') ? 'active':''}}"
                        href="{{ route('admin.loan-member-approved-application.index') }}"><i
                            class="icon fa fa-circle-o"></i> {{_lang('Approved Applications')}}</a></li>
                @endcan


                {{-- Loan From Member Rejected Application --}}
                @can('loan_from_member_rejected_application.view')
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/from-member-loan/loan-member-rejected-application*') ? 'active':''}}"
                        href="{{ route('admin.loan-member-rejected-application.index') }}"><i
                            class="icon fa fa-circle-o"></i> {{_lang('Rejected Applications')}}</a></li>
                @endcan


                {{-- Loan From Member withdraw --}}
                @can('loan_from_member_withdraw.view')
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/from-member-loan/fdr-withdraw*') ? 'active':''}}"
                        href="{{ route('admin.fdr-withdraw.index') }}"><i
                            class="icon fa fa-circle-o"></i> {{_lang('Withdraw')}}</a></li>
                @endcan


            </ul>
        </li>
        @endcan



        @can('expense.view')
        {{-- expense --}}
        <li class="treeview {{ Request::is('admin/expense*') ? ' is-expanded' : '' }}"><a class="app-menu__item"
                href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-usd"></i><span
                    class="app-menu__label">{{_lang('Expense')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('expense_type.view')
                {{-- Expense type --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/expense/expense-type*') ? 'active':''}}"
                        href="{{ route('admin.expense-type.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Expense Type')}}</a></li>
                @endcan
                @can('expense.view')
                {{-- Expense list --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/expense/expense-list*') ? 'active':''}}"
                        href="{{ route('admin.expense-list.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Expense List')}}</a></li>
                @endcan
            </ul>
        </li>
        @endcan

        @can('income.view')
        {{-- income --}}
        <li class="treeview {{ Request::is('admin/income*') ? ' is-expanded' : '' }}"><a class="app-menu__item" href="#"
                data-toggle="treeview"><i class="app-menu__icon fa fa-money"></i><span
                    class="app-menu__label">{{_lang('Income')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('income-type.view')
                {{-- income type --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/income/income-type*') ? 'active':''}}"
                        href="{{ route('admin.income-type.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Income Type')}}</a></li>
                @endcan
                @can('income.view')
                {{-- income list --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/income/income-list*') ? 'active':''}}"
                        href="{{ route('admin.income-list.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Income List')}}</a></li>
                @endcan
            </ul>
        </li>
        @endcan



        @can('bank_transactions.view')
        {{-- bank_transactions --}}
        <li class="treeview {{ Request::is('admin/bank-transactions*') ? ' is-expanded' : '' }}"><a
                class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-area-chart"></i><span
                    class="app-menu__label">{{_lang('Bank Transactions')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('bank_accounts.view')
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/bank-transactions/bank-accounts*') ? 'active':''}}"
                        href="{{ route('admin.bank-accounts.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Bank Accounts')}}</a></li>
                @endcan
                @can('bank_deposit.view')
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/bank-transactions/bank-deposits*') ? 'active':''}}"
                        href="{{ route('admin.bank-deposits.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Bank Deposits')}}</a></li>
                @endcan
                @can('bank_withdraw.view')
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/bank-transactions/bank-withdraws*') ? 'active':''}}"
                        href="{{ route('admin.bank-withdraws.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Bank Withdraws')}}</a></li>
                @endcan

            </ul>
        </li>
        @endcan


        @can('sundry.view')
        {{-- sundry --}}
        <li class="treeview {{ Request::is('admin/sundry*') ? ' is-expanded' : '' }}"><a class="app-menu__item"
                href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-eur"></i><span
                    class="app-menu__label">{{_lang('Sundry')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('sundry_calculation.view')
                {{-- Sundry Calculation --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/sundry/sundry-calculation*') ? 'active':''}}"
                        href="{{ route('admin.sundry-calculation.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Sundry Calculation')}}</a></li>
                @endcan
        
                @can('sundry_withdraw.view')
                {{-- Sundry withdraw --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/sundry/sundry-withdraw*') ? 'active':''}}"
                        href="{{ route('admin.sundry-withdraw.index') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Sundry Withdraw')}}</a></li>
                @endcan
        
            </ul>
        </li>
        @endcan



        {{-- following section is for Reports --}}
        @can('report.view')
        <li class="treeview {{ Request::is('admin/reports*') ? ' is-expanded' : '' }}"><a class="app-menu__item"
                href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-bar-chart"></i><span class="app-menu__label">{{_lang('Reports')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">

                {{-- Daily Report --}}
                @can('daily_report.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/reports/daily-report') ? 'active':''}}"  href="{{ route('admin.daily-report.index') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Daily Report')}} </a></li>
                @endcan

                {{-- voucher Report --}}
                @can('voucher_report.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/reports/voucher-report') ? 'active':''}}" href="{{ route('admin.voucher-report.index') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Voucher Report')}} </a></li>
                @endcan

                {{-- voucher Report --}}
                @can('financial_year_report.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/reports/financial-year-report') ? 'active':''}}" href="{{ route('admin.financial-year-report.index') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Financial Year Report')}} </a></li>
                @endcan

                {{-- Service Report --}}
                @can('service_report.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/reports/service-report') ? 'active':''}}" href="{{ route('admin.service-report.index') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Service Report')}} </a></li>
                @endcan

                {{-- Member Report --}}
                @can('member_report.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/reports/member-report') ? 'active':''}}" href="{{ route('admin.member-report.index') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Member\'s Account Report')}} </a></li>
                @endcan

                {{-- Income Expense Report --}}
                @can('income_expense_report.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/reports/income-expense-report') ? 'active':''}}" href="{{ route('admin.income-expense-report.index') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Income & Expense Report')}} </a></li>
                @endcan

                {{-- Bank Transactio Report --}}
                @can('bank_tx_report.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/reports/bank-tx-report') ? 'active':''}}" href="{{ route('admin.bank-tx-report.index') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Bank Transaction Report')}} </a></li>
                @endcan

                {{-- Bank Transactio Report --}}
                @can('all_transactions_report.view')
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/reports/all-tx-report') ? 'active':''}}" href="{{ route('admin.all-tx-report.index') }}"><i class="icon fa fa-circle-o"></i> {{_lang('All Transactions')}} </a></li>
                @endcan


            </ul>
        </li>
        @endcan

        @can('setting.view')
        {{-- Settings --}}
        <li class="treeview {{ Request::is('admin/setting*') ? ' is-expanded' : '' }}"><a class="app-menu__item"
                href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cogs"></i><span
                    class="app-menu__label">{{_lang('Settings')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('setting.view')
                {{-- General Settings --}}
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/setting/general-setting*') ? 'active':''}}"
                        href="{{ route('admin.setting') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('General Settings')}}</a></li>
                @endcan

                @can('system_configuration.view')
                {{-- System Configuration --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/setting/system-setting*') ? 'active':''}}"
                        href="{{ route('admin.system.setting') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('System Configuration ')}}</a></li>
                @endcan

                @can('mail_configuration.view')
                {{-- Mail Configuration --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/setting/mail-setting*') ? 'active':''}}"
                        href="{{ route('admin.mail.setting') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Mail Configuration ')}}</a></li>
                @endcan

                @can('sms_configuration.view')
                {{-- SMS Configuration --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/setting/sms-setting*') ? 'active':''}}"
                        href="{{ route('admin.sms.setting') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('SMS Configuration ')}}</a></li>
                @endcan

                @can('module_configuration.view')
                {{-- Module Configuration --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/setting/module-setting*') ? 'active':''}}"
                        href="{{ route('admin.module.setting') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Module Configuration ')}}</a></li>
                @endcan

                @can('id_card_template.view')
                {{-- Module Configuration --}}
                <li class="mt-1"><a
                        class="treeview-item {{Request::is('admin/setting/id-card-template*') ? 'active':''}}"
                        href="{{ route('admin.id-card-template') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Id Card Template ')}}</a></li>
                @endcan

                @can('member_setting.view')
                {{-- Member Settings Configuration --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/setting/member*') ? 'active':''}}"
                        href="{{ route('admin.member-setting') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('Member')}}</a></li>
                @endcan


                @can('area.view')
                {{--Area Setting --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/settings/area*') ? 'active':''}}"
                        href="{{ route('admin.area.index') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Area')}}</a>
                </li>
                @endcan

                @can('zone.view')
                {{--Zone Setting --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/settings/zone*') ? 'active':''}}"
                        href="{{ route('admin.zone.index') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Zone')}}</a>
                </li>
                @endcan
                 @can('language.view')
                <li class="mt-1"><a class="treeview-item {{ Request::is('admin/settings/language*') ? ' active' : '' }}"
                href="{{ route('admin.language') }}"><i class="icon fa fa-circle-o"></i>{{_lang('language')}}</a></li>
                @endcan

            </ul>
        </li>
        @endcan

        @can('language.view')
        {{-- Language --}}
        
        @endcan

        @can('user_&_permission.view')
        {{-- User Section--}}
        <li class="treeview {{ Request::is('admin/user*') ? ' is-expanded' : '' }}"><a class="app-menu__item" href="#"
                data-toggle="treeview"><i class="app-menu__icon fa fa-user-times"></i><span
                    class="app-menu__label">{{_lang('User & Permission')}}</span><i
                    class="treeview-indicator fa fa-angle-right"></i></a>
            <ul class="treeview-menu">
                @can('role.view')
                {{-- Role & Permission --}}
                <li class="mt-1"><a class="treeview-item {{Request::is('admin/user/role*') ? 'active':''}}"
                        href="{{ route('admin.user.role') }}"><i class="icon fa fa-circle-o"></i>
                        {{_lang('role_permission')}}</a></li>
                @endcan

                @can('user.view')
                {{-- User --}}
                <li class="mt-1"><a
                        class="treeview-item {{(Request::is('admin/user*') And !Request::is('admin/user/role*'))  ?'active':''}}"
                        href="{{ route('admin.user.index') }}"><i class="icon fa fa-circle-o"></i>{{_lang('user')}}</a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan

        @can('backup.view')
        {{-- Database Backup --}}
        <li><a class="app-menu__item {{ Request::is('admin/backup') ? ' active' : '' }}"
                href="{{ route('admin.backup') }}"><i class="app-menu__icon fa fa-database"></i><span
                    class="app-menu__label">{{_lang('backup')}}</span></a></li>
        @endcan

        {{-- @can('trash.view') --}}
        {{-- Recycle Bin --}}
        {{-- <li><a class="app-menu__item {{ Request::is('admin/trash') ? ' active' : '' }}"
                href="{{ route('admin.trash.index') }}"><i class="app-menu__icon fa fa-trash"></i><span
                    class="app-menu__label">{{_lang('Recycle Bin')}}</span></a></li>
        @endcan --}}
