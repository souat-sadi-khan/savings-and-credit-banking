<form action="{{route('admin.income-type.update', $model->id)}}" method="post" id="content_form">
    @csrf
     @method('PATCH')
     <div class="row">
       
        {{-- Income Name --}}
        <div class="col-md-6 form-group">
            <label for="name">{{_lang('Income Name')}} <span class="text-danger">*</span>
            </label>
            <input  type="text" name="name" id="name" class="form-control"
        placeholder="Enter Income Name" required value="{{$model->name}}">
        </div>

        {{-- Code --}}
        <div class="col-md-6 form-group">
            <label for="code">{{_lang('Code')}}
            </label>
            <div class="input-group">
                <input  type="text" required name="code" placeholder="Enter Code" class="form-control" value="{{$model->code}}">
            </div>
        </div>

        {{-- Description --}}
        <div class="col-md-6 form-group">
            <label for="description">{{_lang('Description')}}
            </label>
            <textarea name="description" id="description"    class="form-control" >{{$model->description}}</textarea>
        </div>

       

        {{-- Active Status --}}
        <div class="col-md-6 form-group">
            <label for="status">{{_lang('Active Status')}}
            </label>
            <div class="input-group">
                <select name="status" id="status" data-placeholder="Please Select One.." class="form-control select">
                    <option value="">Please Select One .. </option>
                    <option value="Active" {{ $model->status == 'Active'?"selected":"" }}>Active</option>
                    <option value="Inactive" {{ $model->status == 'Inactive'?"selected":"" }}>Inactive</option>
                </select>
            </div>
        </div>


     
        
        <div class="form-group col-md-12" align="right">
            {{-- <input type="hidden" name="type[]" value=" "> --}}
            <button type="submit" class="btn btn-primary" id="submit">{{_lang('Save')}}<i
                    class="icon-arrow-right14 position-right"></i></button>
            <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}
                <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
        </div>
    </div>
</form>

<script>
    $('.select').select2({  width: '100%' });

</script>