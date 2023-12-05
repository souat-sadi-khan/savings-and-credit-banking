<form action="{{route('admin.savings-type.update', $model->id)}}" method="post" id="content_form">
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

        {{-- Duration --}}
        <div class="col-md-6 form-group">
            <label for="duration">{{_lang('Savings Duration')}}
            </label>
            <div class="row">
                <div class="input-group col-md-6 d-flex">
                <input  type="text" required name="duration" placeholder="Savings Duration" class="form-control" value="{{$model->duration}}">
            </div>
            <div class="col-md-6">
                <select name="duration_type" id="duration_type" data-placeholder="Please Select One.." class="form-control select">
                    <option value="">Please Select One .. </option>
                    <option value="Day" {{ $model->duration_type == 'Day'?"selected":"" }}>Day</option>
                    <option value="Week" {{ $model->duration_type == 'Week'?"selected":"" }}>Week</option>
                    <option value="Month" {{ $model->duration_type == 'Month'?"selected":"" }}>Month</option>
                    <option value="Year" {{ $model->duration_type == 'Year'?"selected":"" }}>Year</option>
                </select>
            </div>
            </div>
        </div>

        {{-- Installment Period --}}
        <div class="col-md-6 form-group">
            <label for="installment_period">{{_lang('Installment Period')}}
            </label>
            <div class="input-group">
            <select name="installment_period" id="installment_period" data-placeholder="Please Select One.." class="form-control select">
                    <option value="">Please Select One .. </option>
                    <option value="Day" {{ $model->installment_period == 'Day'?"selected":"" }}>Day</option>
                    <option value="Week" {{ $model->installment_period == 'Week'?"selected":"" }}>Week</option>
                    <option value="Month" {{ $model->installment_period == 'Month'?"selected":"" }}>Month</option>
                    <option value="Year" {{ $model->installment_period == 'Year'?"selected":"" }}>Year</option>
                </select>
                </div>
        </div>

        {{-- Active Status --}}
        <div class="col-md-12 form-group">
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