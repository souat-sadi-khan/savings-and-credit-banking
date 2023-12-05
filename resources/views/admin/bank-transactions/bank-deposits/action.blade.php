<div class="btn-group" role="group">
@can('bank_deposit.update')
<a data-placement="bottom" title="Edit Bank Deposit." data-url="{{ route('admin.bank-deposits.edit',$model->id) }}" id="content_managment" class="btn btn-info text-light btn-sm ml-1" title="{{ _lang('Edit') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
@endcan
@can('bank_deposit.delete')
<a data-placement="bottom" title="Delete Bank Deposit." href="" id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.bank-deposits.destroy',$model->id) }}" class="btn btn-danger btn-sm  ml-1" title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>
@endcan
</div>
