@can('employee_payroll_template.update')
<a data-placement="bottom" title="Edit Employee Payroll Template." href="{{ route('admin.employee-payroll-template.edit',$model->uuid) }}"  class="btn btn-info text-light" title="{{ _lang('Edit') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
@endcan


@can('employee_payroll_template.view')
<a data-placement="bottom" title="Edit Employee Payroll Template." data-url="{{ route('admin.employee-payroll-template.show',$model->uuid) }}" id="content_managment" class="btn btn-success text-light" title="{{ _lang('View') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-eye"></i></a>
@endcan


@can('employee_payroll_template.delete')
<a data-placement="bottom" title="Delete Employee Payroll Template." href="" id="delete_item" data-id ="{{$model->uuid}}" data-url="{{route('admin.employee-payroll-template.destroy',$model->uuid) }}" class="btn btn-danger" title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
@endcan