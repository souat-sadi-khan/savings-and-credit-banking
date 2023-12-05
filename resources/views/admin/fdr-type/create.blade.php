<form action="{{route('admin.fdr-type.store')}}" method="post" id="content_form">
    @csrf
    <div class="row">

        {{-- Service Name --}}
        <div class="col-md-6 form-group">
            <label for="service_name">{{_lang('Service Name')}} <span class="text-danger">*</span>
            </label>
            <input type="text" name="service_name" id="service_name" class="form-control"
                placeholder="Enter Service Name" required>
        </div>

        {{-- Rate --}}
        <div class="col-md-6 form-group">
            <label for="rate">{{_lang('Rate')}}
            </label>
            <input type="text" required name="rate" placeholder="Rate (%)" class="form-control">
        </div>

        {{-- Duration --}}
        <div class="col-md-6 form-group">
            <div class="row">
                <div class="col-12">
            <label for="duration">{{_lang('Loan Duration')}}
            </label>
            </div>
                <div class="col-md-6">
                    <input type="text" required name="duration" placeholder="Loan Duration" class="form-control">
                </div>
                <div class="col-md-6">
                    <select name="duration_type" id="duration_type" data-placeholder="Please Select One.."
                        class="form-control select" data-parsley-errors-container="#duration_type_error" required>
                        <option value="">Please Select One .. </option>
                        <option value="Month">Month</option>
                        <option value="Year">Year</option>
                    </select>
                    <span id="duration_type_error"></span>
                </div>
            </div>
        </div>



        {{-- Active Status --}}
        <div class="col-md-6 form-group">
            <label for="status">{{_lang('Active Status')}}
            </label>
            <div class="input-group">
                <select name="status" id="status" data-placeholder="Please Select One.." class="form-control select" data-parsley-errors-container="#status_error" required>
                    <option value="">Please Select One .. </option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
                 <span id="status_error"></span>
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
    $('.select').select2({
        width: '100%'
    });

</script>
