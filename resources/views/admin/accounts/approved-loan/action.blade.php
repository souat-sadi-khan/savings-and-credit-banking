<div class="btn-group mt-5" role="group">
  
    @can('approved_loan.view')
    <a data-placement="bottom" title="Loan Info In detail" href="{{ route('admin.approved-loan.show',$model->uuid) }}" class="btn btn-success text-light btn-sm ml-1" title="{{ _lang('Loan Info In detail') }}" data-popup="tooltip"
        data-placement="bottom">
        <i class="fa fa-eye"></i>
    </a>
    @endcan

    {{-- Edit button --}}
       @can('approved_loan.update_last_verification')
        @if ($model->transaction)
                
            @if ($model->transaction->payment_status == 'due')
                <a data-placement="bottom" title="Edit Last Verification." href="{{ route('admin.verified-loan.edit',$model->id) }}" class="btn btn-info btn-sm text-light ml-1" title="{{ _lang('Edit Last Verification') }}" data-popup="tooltip"data-placement="bottom">
                    <i class="fa fa-pencil-square-o"></i>
                </a>
            @endif
        @else
                <a data-placement="bottom" title="Edit Last Verification." href="{{ route('admin.verified-loan.edit',$model->id) }}" class="btn btn-info btn-sm text-light ml-1" title="{{ _lang('Edit Last Verification') }}" data-popup="tooltip"data-placement="bottom">
                    <i class="fa fa-pencil-square-o"></i>
                </a>
        @endif
      @endcan

    {{-- Delete Button --}}
     @can('approved_loan.delete_last_verification')
    <a data-placement="bottom" title="Delete Last Verification." id="delete_item" data-id="{{$model->id}}"
        data-url="{{ route('admin.verified-loan.destroy',$model->id) }}" class="btn btn-danger text-light btn-sm ml-1"
        title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
    @endcan

</div>