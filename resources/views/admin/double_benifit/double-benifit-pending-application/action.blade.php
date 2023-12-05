<div class="btn-group mt-5" role="group">
    @can('double_benifit_pending_application.update')
    <a data-placement="bottom" title="Edit Double Benifit" href="{{ route('admin.pending-application.edit',$model->uuid) }}"
        id="" class="btn btn-info btn-sm text-light" title="{{ _lang('Edit') }}" data-popup="tooltip"
        data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
    @endcan

    @can('double_benifit_pending_application.delete')
    <a data-placement="bottom" title="Delete Double Benifit." href="" id="delete_item" data-id="{{$model->id}}"
        data-url="{{route('admin.pending-application.destroy',$model->id) }}" class="btn btn-danger btn-sm ml-1"
        title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
    @endcan
</div>

<br>

<div class="btn-group mt-1" role="group">
    @can('double_benifit_pending_application.view')
    <a data-placement="bottom" title="View Details" href="{{ route('admin.pending-application.show',$model->uuid) }}"
        class="btn btn-primary text-light btn-sm" title="{{ _lang('show') }}" data-popup="tooltip"
        data-placement="bottom"><i class="fa fa-eye"></i></a>
    @endcan

    @can('double_benifit_pending_application.approval')
    <a data-placement="bottom" title="Approve Account" href="{{ route('admin.double-benifit-pending-application.approval',$model->uuid) }}"
        class="btn btn-warning text-light btn-sm ml-1" title="{{ _lang('Approve') }}" data-popup="tooltip"
        data-placement="bottom">
        <i class="fa fa-check-circle"></i>
    </a>
    @endcan
</div>