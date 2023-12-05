        {{-- Dashboard --}}
        <li><a class="app-menu__item {{ Request::is('admin/trash') ? ' active' : '' }}" href="{{ route('home') }}"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">{{_lang('dashboard')}}</span></a></li>

        @can('employee.view')
            {{-- Employee --}}
            <li class="treeview {{ Request::is('admin/trash/employee*') ? ' is-expanded' : '' }}"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-circle"></i><span class="app-menu__label">{{_lang('Employee')}}</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    @can('employee_category.view')
                        {{-- Employee Document Type --}}
                        <li class="mt-1"><a class="treeview-item {{Request::is('admin/trash/employee-category*') ? 'active':''}}" href="{{ route('admin.trash.employee-category') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Employee Category')}}</a></li>
                    @endcan

                    @can('employee_designation.view')
                        {{-- Employee Designation Type --}}
                        <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee-designation*') ? 'active':''}}" href="{{ route('admin.employee-designation.index') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Employee Designation')}}</a></li>
                    @endcan

                    @can('employee_departmeent.view')
                        {{-- Employee Department --}}
                        <li class="mt-1"><a class="treeview-item {{Request::is('admin/trash/employee/department*') ? 'active':''}}" href="{{ route('admin.trash.employee.department') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Employee Department')}}</a></li>
                    @endcan 

                    @can('employee_document.view')
                        {{-- Employee Document Type --}}
                        <li class="mt-1"><a class="treeview-item {{Request::is('admin/trash/employee/document/type*') ? 'active':''}}" href="{{ route('admin.trash.employee.document.type') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Employee Document Type')}}</a></li>
                    @endcan

                    @can('employee_leave_type.view')
                        {{-- Employee Leave Type --}}
                        <li class="mt-1"><a class="treeview-item {{Request::is('admin/trash/employee/leave/type*') ? 'active':''}}" href="{{ route('admin.trash.employee.leave.type') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Employee Leave Type')}}</a></li>
                    @endcan

                     @can('employee_attendance_type.view')
                        {{-- Employee Attendance Type --}}
                        <li class="mt-1"><a class="treeview-item {{Request::is('admin/employee-attendance-type*') ? 'active':''}}" href="{{ route('admin.employee-attendance-type.index') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Employee Attendance Type')}}</a></li>
                    @endcan

                    @can('employee_payhead.view')
                        {{-- Employee Payhead Type --}}
                        <li class="mt-1"><a class="treeview-item {{Request::is('admin/trash/employee/payhead*') ? 'active':''}}" href="{{ route('admin.trash.employee.pay.head') }}"><i class="icon fa fa-circle-o"></i> {{_lang('Employee Payhead')}}</a></li>
                    @endcan
                </ul>
            </li>
        @endcan

