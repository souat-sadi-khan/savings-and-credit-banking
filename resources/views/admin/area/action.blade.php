@can('area.update')
<a data-placement="bottom" title="Edit Area." data-url="{{ route('admin.area.edit',$model->id) }}" id="content_managment" class="btn btn-info text-light" title="{{ _lang('Edit') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
@endcan

@can('area.delete')
<a data-placement="bottom" title="Delete Area." href="" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.area.destroy',$model->id) }}" class="btn btn-danger" title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
@endcan