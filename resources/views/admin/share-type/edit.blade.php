<form action="{{route('admin.share-type.update', $model->id)}}" method="post" id="content_form">
    @csrf
     @method('PATCH')
     <div class="row">
       
        {{-- Service Name --}}
        <div class="col-md-6 form-group">
            <label for="service_name">{{_lang('Service Name')}} <span class="text-danger">*</span>
            </label>
            <input  type="text" name="service_name" id="service_name" class="form-control"
        placeholder="Enter Service Name" required value="{{$model->service_name}}">
        </div>

        {{-- Rate --}}
        <div class="col-md-6 form-group">
            <label for="rate">{{_lang('Rate')}}
            </label>
            <div class="input-group">
                <input  type="text" required name="rate" placeholder="Rate (%)" class="form-control" value="{{$model->rate}}">
            </div>
        </div>

        {{-- interest_period --}}
        <div class="col-md-6 form-group">
            <label for="interest_period">{{_lang('Interest Per')}}
            </label>
            
                <select name="interest_period" id="interest_period" data-placeholder="Please Select One.." class="form-control select">
                    <option value="">Please Select One .. </option>
                    <option value="Month" {{ $model->interest_period == 'Month'?"selected":"" }}>Month</option>
                    <option value="Year" {{ $model->interest_period == 'Year'?"selected":"" }}>Year</option>
                </select>
            </div>

       

        {{-- Active Status --}}
        <div class="col-md-6 form-group">
            <label for="status">{{_lang('Active Status')}}
            </label>
            <div class="">
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