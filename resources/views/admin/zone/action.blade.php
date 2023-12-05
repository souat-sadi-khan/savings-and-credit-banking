@can('zone.update')
<a data-placement="bottom" title="Edit Zone." data-url="{{ route('admin.zone.edit',$model->id) }}" id="content_managment" class="btn btn-info text-light" title="{{ _lang('Edit') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
@endcan

@can('zone.delete')
<a data-placement="bottom" title="Delete Zone." href="" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.zone.destroy',$model->id) }}" class="btn btn-danger" title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
@endcan