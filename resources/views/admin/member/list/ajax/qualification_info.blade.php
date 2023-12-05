<div class="row p-4">
    <div class="col-md-12">
        <div align="right">
            @can('member_qualification.create')
                <a class="btn btn-info btn-sm" data-placement="bottom" title="Create New Qualification File" type="button" href="{{ route('admin.member-qualification.m-create',$id)}}"> <i class="fa fa-plus mr-2" aria-hidden="true"></i>{{_lang('Add New Qualification')}}</a>
            @endcan
        </div>
        <br>
        <div class="row">
            @if (!count($models))
                <div class="col-md-12 text-center">
                    <i class="fa fa-th-list fa-4x" aria-hidden="true"></i><br>
                    <h2>{{_lang('Listing all Qualification here!')}}</h2>
                    <h4>{{_lang('Upload and manage various Qualification of your Members to specific Qualification type')}}</h4>
                    @can('member_qualification.create')
                        <a class="btn btn-info btn-sm" data-placement="bottom" title="Create New Qualification File" type="button" href="{{ route('admin.member-qualification.m-create',$id)}}"> <i class="fa fa-plus mr-2" aria-hidden="true"></i>{{_lang('Add New Qualification')}}</a>
                    @endcan
                </div>
                @else 
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="text-center thead-dark">
                            <tr>
                                <th>{{_lang('Exam Name')}}</th>
                                <th>{{_lang('Institute Name')}}</th>
                                <th>{{_lang('Board')}}</th>
                                <th>{{_lang('Year')}}</th>
                                <th>{{_lang('Result')}}</th>
                                <th>{{_lang('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach ($models as $model)
                            <tr>
                                <td>{{$model->exam_name}} </td>
                                <td>{{$model->institute_name}} </td>
                                <td>{{$model->board}} </td>
                                <td>{{$model->year}} </td>
                                <td>{{$model->result}} </td>
                                <td align="center">
                                    <div class="btn-group">
                                        @can('member_qualification.delete')
                                            <button id="delete_item" data-id ="{{$model->id}}" data-url="{{route('admin.member-qualification.destroy',$model->id) }}" class="btn btn-danger btn-sm has-tooltip" data-original-title="null"data-placement="bottom"><i class="fa fa-trash"></i></button>
                                        @endcan
                                        
                                        @can('member_qualification.update')
                                            <button class="btn btn-info btn-sm has-tooltip" data-original-title="null" id="content_managment" data-url="{{ route('admin.member-qualification.edit',$model->id) }}" ><i class="fa fa-edit"></i></button>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>