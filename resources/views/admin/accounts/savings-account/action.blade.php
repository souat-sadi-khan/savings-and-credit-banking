<div class="btn-group mt-4" role="group">
    @can('savings_account_list.update')
    <div class="btn-group" role="group">
        <a data-placement="bottom" title="Edit savings Account."
            data-url="{{ route('admin.savings-account.edit',$model->id) }}" id="content_managment"
            class="btn btn-info btn-sm text-light btn-sm ml-1" title="{{ _lang('Edit') }}" data-popup="tooltip"
            data-placement="bottom"><i class="fa fa-pencil-square-o"></i></a>
        @endcan
        @can('savings_account_list.delete')
        <a data-placement="bottom" title="Delete savings Account." href="" id="delete_item" data-id="{{$model->id}}"
            data-url="{{route('admin.savings-account.destroy',$model->id) }}" class="btn btn-danger btn-sm ml-1"
            title="{{ _lang('Delete') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-trash"></i></a>

        @endcan

        @can('savings_account_list.show')
        <a data-placement="bottom" title="View Details" href="{{ route('admin.savings-account.show',$model->uuid) }}"
            class="btn btn-primary text-light btn-sm ml-1" title="{{ _lang('view') }}" data-popup="tooltip"
            data-placement="bottom"><i class="fa fa-eye"></i></a>
        @endcan
    </div>
</div>
