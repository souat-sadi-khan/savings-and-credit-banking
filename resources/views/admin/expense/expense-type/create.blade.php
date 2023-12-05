<form action="{{route('admin.expense-type.store')}}" method="post" id="content_form">
    @csrf
    <div class="row">

        {{-- Expense Name --}}
        <div class="col-md-6 form-group">
            <label for="name">{{_lang('Expense Name')}} <span class="text-danger">*</span>
            </label>
            <input type="text" name="name" id="name" class="form-control"
                placeholder="Enter Expense Name" required>
        </div>

        {{-- code --}}
        <div class="col-md-6 form-group">
            <label for="code">{{_lang('Code')}}
            </label>
            <input type="text" required name="code" placeholder="Enter Code" class="form-control">
        </div>


        {{-- Description --}}
        <div class="col-md-6 form-group">
            <label for="description">{{_lang('Description')}}
            </label>
            <textarea name="description" id="description" placeholder="Enter Code" class="form-control"></textarea>
        </div>


        {{-- Active Status --}}
        <div class="col-md-6 form-group">
            <label for="status">{{_lang('Active Status')}}
            </label>
            <div class="input-group">
                <select name="status" id="status" data-placeholder="Please Select One.." class="form-control select" required> 
                    <option value="">Please Select One .. </option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
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
    $('.select').select2({
        width: '100%'
    });

</script>
