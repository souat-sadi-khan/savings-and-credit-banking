<div class="btn-group" role="group">
@can('loan_from_memebr_type.update')
<a data-placement="bottom" title="Edit Loan From Member Type." data-url="{{ route('admin.fdr-type.edit',$model->id) }}" id="content_managment" class="btn btn-info text-light btn-sm" title="{{ _lang('Edit') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
@endcan
@can('loan_from_memebr_type.delete')
<a data-placement="bottom" title="Delete Loan From Member Type." href="" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.fdr-type.destroy',$model->id) }}" class="btn btn-danger btn-sm" title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
@endcan
</div>