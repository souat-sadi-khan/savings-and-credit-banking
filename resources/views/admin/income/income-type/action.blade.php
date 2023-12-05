<div class="btn-group" role="group">
@can('income_type.update')
<a data-placement="bottom" title="Edit Income Type." data-url="{{ route('admin.income-type.edit',$model->id) }}" id="content_managment" class="btn btn-info text-light btn-sm mr-1" title="{{ _lang('Edit') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
@endcan
@can('income_type.delete')
<a data-placement="bottom" title="Delete Income Type." href="" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.income-type.destroy',$model->id) }}" class="btn btn-danger btn-sm" title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
@endcan
</div>