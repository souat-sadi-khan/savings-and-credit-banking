<div class="btn-group mt-5" role="group">

    @can('verified_loan.approve')
    <a data-placement="bottom" title="Approve loan" href="{{ route('admin.verified-loan.approve',$model->uuid) }}"
        class="btn btn-warning text-light btn-sm ml-1" title="{{ _lang('Approve loan') }}" data-popup="tooltip"
        data-placement="bottom">
        <i class="fa fa-check-circle"></i>
    </a>
    @endcan

    @can('verified_loan.update')
    <a data-placement="bottom" title="Edit Last Verification." href="{{ route('admin.verified-loan.edit',$model->id) }}" class="btn btn-info btn-sm text-light ml-1" title="{{ _lang('Edit Last Verification') }}" data-popup="tooltip"data-placement="bottom">
        <i class="fa fa-pencil-square-o"></i>
    </a>
    @endcan

    @can('verified_loan.delete_last_verification')
    <a data-placement="bottom" title="Delete Last Verification." id="delete_item" data-id="{{$model->id}}"
        data-url="{{ route('admin.verified-loan.destroy',$model->id) }}" class="btn btn-danger text-light btn-sm ml-1"
        title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
    @endcan
</div>
