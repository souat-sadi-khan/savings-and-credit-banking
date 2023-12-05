<div class="card">
    <div class="card-header">
        <h6>{{_lang('Edit Employee Category - ')}} <span class="badge badge-primary">{{$model->name}}</span></h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.employee-category.update', $model->id)}}" method="post" id="content_form">
            @csrf
            @method('PATCH')
            <div class="row">
                {{-- Employee Category Name --}}
                <div class="col-md-12 form-group">
                    <label for="name">{{_lang('Document Type Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" name="name" value="{{$model->name}}" id="name" class="form-control"
                        placeholder="Enter Employee Category Name" required>
                </div>
                {{-- Employee Category Description --}}
                <div class="col-md-12 form-group">
                    <label for="name">{{_lang('Document Type Description')}}
                    </label>
                    <textarea name="description" class="form-control" id=""
                        placeholder="Enter Employee Category Description">{{$model->description}}</textarea>

                </div>
                @can('employee_category.update')
                    <div class="form-group col-md-12" align="right">
                        {{-- <input type="hidden" name="type[]" value=" "> --}}
                        <button type="submit" class="btn btn-primary" id="submit">{{_lang('Save')}}<i
                                class="icon-arrow-right14 position-right"></i></button>
                        <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}
                            <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                @endcan
            </div>
        </form>
    </div>
</div>
