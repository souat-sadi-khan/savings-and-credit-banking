<div class="btn-group" role="group">
@can('bank_accounts.update')
<a data-placement="bottom" title="Edit Bank Account." data-url="{{ route('admin.bank-accounts.edit',$model->id) }}" id="content_managment" class="btn btn-info text-light btn-sm ml-1" title="{{ _lang('Edit') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
@endcan
@can('bank_accounts.delete')
<a data-placement="bottom" title="Delete Bank Account." href="" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.bank-accounts.destroy',$model->id) }}" class="btn btn-danger btn-sm  ml-1" title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
@endcan
</div>

<br>

<div class="btn-group mt-1" role="group" >
@can('bank_accounts.deposit')
<a data-placement="bottom" title="Bank Deposit" data-url="{{ route('admin.bank-accounts.deposit',$model->id) }}" id="content_managment" class="btn btn-success text-light btn-sm ml-1" title="{{ _lang('Deposit') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-arrow-circle-up"></i></a>
@endcan
@can('bank_accounts.withdraw')
<a data-placement="bottom" title="Bank Withdraw"  id="content_managment"  data-url="{{route('admin.bank-accounts.withdraw',$model->id) }}" class="btn btn-primary text-light btn-sm  ml-1" title="{{ _lang('Withdraw') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-arrow-circle-down"></i></a>
@endcan

</div>
