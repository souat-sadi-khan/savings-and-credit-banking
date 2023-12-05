<div class="btn-group mt-5" role="group">
   

    {{-- @can('rejected-loan.delete') --}}
    {{-- <a data-placement="bottom" title="Delete Loan Account." href="" id="delete_item" data-id="{{$model->id}}"
        data-url="{{route('admin.rejected-loan.destroy',$model->id) }}" class="btn btn-danger btn-sm ml-1"
        title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a> --}}
    {{-- @endcan --}}
</div>

<br>

<div class="btn-group mt-1" role="group">
    @can('rejected_loan.view')
    <a data-placement="bottom" title="View Details" href="{{ route('admin.rejected-loan.show',$model->uuid) }}"
        class="btn btn-primary text-light btn-sm" title="{{ _lang('show') }}" data-popup="tooltip"
        data-placement="bottom"><i class="fa fa-eye"></i></a>
    @endcan

    @can('rejected_loan.verification')
    <a data-placement="bottom" title="Verify Account" href="{{ route('admin.rejected-loan.verification',$model->uuid) }}"
        class="btn btn-warning text-light btn-sm ml-1" title="{{ _lang('verify') }}" data-popup="tooltip"
        data-placement="bottom">
        <i class="fa fa-check-circle"></i>
    </a>
    @endcan
</div>