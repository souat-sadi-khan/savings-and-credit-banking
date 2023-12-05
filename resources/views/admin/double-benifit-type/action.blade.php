<div class="btn-group" role="group">
@can('double_benifit_type.update')
<a data-placement="bottom" title="Edit Double Benifit Type." data-url="{{ route('admin.double-benifit-type.edit',$model->id) }}" id="content_managment" class="btn btn-info text-light btn-sm" title="{{ _lang('Edit') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
@endcan
@can('double_benifit_type.delete')
<a data-placement="bottom" title="Delete Double Benifit Type." href="" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.double-benifit-type.destroy',$model->id) }}" class="btn btn-danger btn-sm" title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
@endcan
</div>