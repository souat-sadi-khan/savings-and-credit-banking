<div class="card">
    <div class="card-header">
        <h6>{{_lang('Update Qualification for the Member')}} </h6>
    </div>
    <div class="card-body">
        <form action="{{route('admin.member-qualification.update', $model->id)}}" method="post" id="content_form">
            @csrf
            @method('PATCH')
            <div class="row">
                {{-- Exam Name --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Exam Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" required name='exam_name' placeholder='Enter Exam Name'
                value="{{$model->exam_name}}"      class="form-control" /></td>
                </div>

                {{-- Institute Name --}}
                <div class="col-md-6 form-group">
                    <label for="name">{{_lang('Institute Name')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" required name='institute_name' placeholder='Enter Institute Name'
                                 value="{{$model->institute_name}}"       class="form-control" /></td>
                </div>

                {{-- Board --}}
                <div class="col-md-4 form-group">
                    <label for="name">{{_lang('Board')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" required name='board' placeholder='Enter Board'
                                 value="{{$model->board}}"       class="form-control" /></td>
                </div>

                {{-- Year --}}
                <div class="col-md-4 form-group">
                    <label for="name">{{_lang('Year')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" required name='year' placeholder='Enter Year'
                                 value="{{$model->year}}"       class="form-control" /></td>
                </div>
                {{-- Result --}}
                <div class="col-md-4 form-group">
                    <label for="name">{{_lang('Result')}} <span class="text-danger">*</span>
                    </label>
                    <input type="text" required name='result' placeholder='Enter Result'
                                 value="{{$model->result}}"       class="form-control" /></td>
                </div>
        
                @can('member_qualification.update')
                    <div class="form-group col-md-12" align="right">
                        <button type="submit" class="btn btn-primary" id="submit">{{_lang('Update')}}<i class="icon-arrow-right14 position-right"></i></button>
                        <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                    </div>
                @endcan
            </div>
        </form>
    </div>
</div>
<script>
    $('.select').select2();
</script>