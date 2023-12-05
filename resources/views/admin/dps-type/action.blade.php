<div class="btn-group" role="group">
@can('dps_type.update')
<a data-placement="bottom" title="Edit DPS Type." data-url="{{ route('admin.dps-type.edit',$model->id) }}" id="content_managment" class="btn btn-sm btn-info text-light" title="{{ _lang('Edit') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
@endcan
@can('dps_type.delete')
<a data-placement="bottom" title="Delete DPS Type." href="" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.dps-type.destroy',$model->id) }}" class="btn btn-sm btn-danger" title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
@endcan
</div>