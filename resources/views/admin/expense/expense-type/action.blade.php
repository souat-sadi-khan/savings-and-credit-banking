<div class="btn-group" role="group">
@can('expense_type.update')
<a data-placement="bottom" title="Edit Expense Type." data-url="{{ route('admin.expense-type.edit',$model->id) }}" id="content_managment" class="btn btn-info text-light btn-sm" title="{{ _lang('Edit') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
@endcan
@can('expense_type.delete')
<a data-placement="bottom" title="Delete Expense Type." href="" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.expense-type.destroy',$model->id) }}" class="btn btn-danger btn-sm" title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
@endcan
</div>