<div class="btn-group" role="group">

    @can('savings_withdraw.update')
    <div class="btn-group" role="group">
        <a data-placement="bottom" title="Edit savings Withdraw." href="{{ route('admin.savings-withdraw.edit',$model->id) }}"
           
            class="btn btn-info btn-sm text-light btn-sm ml-1" title="{{ _lang('Edit') }}" data-popup="tooltip"
            data-placement="bottom">
            <i class="fa fa-pencil-square-o"></i>
        </a>
        @endcan

        @can('savings_withdraw.delete')
        <a data-placement="bottom" title="Delete savings Withdraw." href="" id="delete_item" data-id="{{$model->id}}"
            data-url="{{route('admin.savings-withdraw.destroy',$model->id) }}" class="btn btn-danger btn-sm ml-1"
            title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom">
            <i class="fa fa-trash"></i>
        </a>
        @endcan

    </div>
</div>
