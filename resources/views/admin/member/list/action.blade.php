@can('member_list.action')
<a data-placement="bottom" title="View Details for Member {{$model->id}} ." href="{{ route('admin.member-list.edit',$model->uuid) }}"  class="btn btn-primary text-light" title="{{ _lang('Edit') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-adjust"></i></a>
@endcan
