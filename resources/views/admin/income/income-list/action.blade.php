<div class="btn-group" role="group">
@can('income.update')
<a data-placement="bottom" title="Edit Income ." data-url="{{ route('admin.income-list.edit',$model->id) }}" id="content_managment" class="btn btn-info text-light btn-sm ml-1" title="{{ _lang('Edit') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
@endcan
@can('income.delete')
<a data-placement="bottom" title="Delete Income ." href="" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.income-list.destroy',$model->id) }}" class="btn btn-danger btn-sm  ml-1" title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
@endcan

@if ($model->due_amt > 0)
    @can('income.pay')
    <a data-placement="bottom" title="Pay Due Of Income ." data-url="{{ route('admin.income-list.pay',$model->id) }}" id="content_managment" class="btn btn-success text-light btn-sm  ml-1" title="{{ _lang('Pay') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-money"></i></a>
    @endcan
@endif

</div>