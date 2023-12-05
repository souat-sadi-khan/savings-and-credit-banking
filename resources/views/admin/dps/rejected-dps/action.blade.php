<div class="btn-group mt-5" role="group">
    @can('rejected_dps.update')
    <a data-placement="bottom" title="Edit Loan Account" href="{{ route('admin.rejected-dps.edit',$model->uuid) }}"
        id="" class="btn btn-info btn-sm text-light" title="{{ _lang('Edit') }}" data-popup="tooltip"
        data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
    @endcan

    @can('rejected_dps.delete')
    <a data-placement="bottom" title="Delete Loan Account." href="" id="delete_item" data-id="{{$model->id}}"
        data-url="{{route('admin.rejected-dps.destroy',$model->id) }}" class="btn btn-danger btn-sm ml-1"
        title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
    @endcan
</div>

<br>

<div class="btn-group mt-1" role="group">
    @can('rejected_dps.view')
    <a data-placement="bottom" title="View Details" href="{{ route('admin.rejected-dps.show',$model->uuid) }}"
        class="btn btn-primary text-light btn-sm" title="{{ _lang('show') }}" data-popup="tooltip"
        data-placement="bottom"><i class="fa fa-eye"></i></a>
    @endcan

    @can('rejected_dps.approval')
    <a data-placement="bottom" title="Update Approval" href="{{ route('admin.rejected-dps.approval',$model->uuid) }}"
        class="btn btn-warning text-light btn-sm ml-1" title="{{ _lang('Update Approval') }}" data-popup="tooltip"
        data-placement="bottom">
        <i class="fa fa-check-circle"></i>
    </a>
    @endcan
</div>