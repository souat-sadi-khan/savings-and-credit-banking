@can('loan_type.update')
<a data-placement="bottom" title="Edit Loan Type." data-url="{{ route('admin.loan-type.edit',$model->id) }}" id="content_managment" class="btn btn-info text-light" title="{{ _lang('Edit') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
@endcan
@can('loan_type.delete')
<a data-placement="bottom" title="Delete Loan Type." href="" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.loan-type.destroy',$model->id) }}" class="btn btn-danger" title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
@endcan