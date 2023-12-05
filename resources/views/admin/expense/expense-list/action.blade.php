<div class="btn-group" role="group">
@can('expense.update')
<a data-placement="bottom" title="Edit Expense List." data-url="{{ route('admin.expense-list.edit',$model->id) }}" id="content_managment" class="btn btn-info text-light btn-sm ml-1" title="{{ _lang('Edit') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
@endcan
@can('expense.delete')
<a data-placement="bottom" title="Delete Expense List." href="" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.expense-list.destroy',$model->id) }}" class="btn btn-danger btn-sm  ml-1" title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
@endcan


@if ($model->due_amt > 0)
    @can('expense.pay')
    <a data-placement="bottom" title="Pay Due Of Expense ." data-url="{{ route('admin.expense-list.pay',$model->id) }}" id="content_managment" class="btn btn-success text-light btn-sm  ml-1" title="{{ _lang('Pay') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-money"></i></a>
    @endcan
@endif
</div>