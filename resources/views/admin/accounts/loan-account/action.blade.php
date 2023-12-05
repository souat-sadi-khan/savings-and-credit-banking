<div class="btn-group mt-5" role="group">
    @can('loan_application.update')
    <a data-placement="bottom" title="Edit Loan Account" href="{{ route('admin.loan-account.edit',$model->uuid) }}"
        id="" class="btn btn-info btn-sm text-light" title="{{ _lang('Edit') }}" data-popup="tooltip"
        data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
    @endcan

    @can('loan_application.delete')
    <a data-placement="bottom" title="Delete Loan Account." href="" id="delete_item" data-id="{{$model->id}}"
        data-url="{{route('admin.loan-account.destroy',$model->id) }}" class="btn btn-danger btn-sm ml-1"
        title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
    @endcan
</div>

<br>

<div class="btn-group mt-1" role="group">
    @can('loan_application.view')
    <a data-placement="bottom" title="View Details" href="{{ route('admin.loan-account.show',$model->uuid) }}"
        class="btn btn-primary text-light btn-sm" title="{{ _lang('show') }}" data-popup="tooltip"
        data-placement="bottom"><i class="fa fa-eye"></i></a>
    @endcan

    @can('loan_application.verification')
    <a data-placement="bottom" title="Verify Account" href="{{ route('admin.loan-account.verification',$model->uuid) }}"
        class="btn btn-warning text-light btn-sm ml-1" title="{{ _lang('verify') }}" data-popup="tooltip"
        data-placement="bottom">
        <i class="fa fa-check-circle"></i>
    </a>
    @endcan
</div>