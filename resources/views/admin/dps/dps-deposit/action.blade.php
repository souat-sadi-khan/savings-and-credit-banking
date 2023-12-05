<div class="btn-group" role="group">

    @can('dps_deposit.update')
    <div class="btn-group" role="group">
        <a data-placement="bottom" title="Edit DPS Account." href="{{ route('admin.dps-deposit.edit',$model->id) }}"
           
            class="btn btn-info btn-sm text-light btn-sm ml-1" title="{{ _lang('Edit') }}" data-popup="tooltip"
            data-placement="bottom">
            <i class="fa fa-pencil-square-o"></i>
        </a>
        @endcan

        @can('dps_deposit.delete')
        <a data-placement="bottom" title="Delete DPS Account." href="" id="delete_item" data-id="{{$model->id}}"
            data-url="{{route('admin.dps-deposit.destroy',$model->id) }}" class="btn btn-danger btn-sm ml-1"
            title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom">
            <i class="fa fa-trash"></i>
        </a>
        @endcan

    </div>
</div>
