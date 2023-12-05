<form action="{{route('admin.bank-accounts.store')}}" method="post" id="content_form">
    @csrf
    <div class="row">

      
        {{-- Bank Name --}}
        <div class="col-md-6 form-group">
            <label for="bank_name">{{_lang('Bank Name')}}
            </label>
            <input type="text" required name="bank_name" placeholder="Enter Bank Name" class="form-control">
        </div>

        {{-- Branch Name --}}
        <div class="col-md-6 form-group">
            <label for="branch_name">{{_lang('Branch Name')}}
                <span class="text-danger">*</span>
            </label>
            <input type="text"   required name="branch_name" id="branch_name" placeholder="Enter Branch Name"
                class="form-control">
        </div>

        {{-- A/C Holder Name --}}
        <div class="col-md-6 form-group">
            <label for="account_holder_name">{{_lang('A/C Holder Name')}}
                <span class="text-danger">*</span>
            </label>
            <input type="text"  required name="account_holder_name" id="account_holder_name" placeholder="A/C Holder Name"
                class="form-control"  >
        </div>



        {{-- A/C Number --}}
        <div class="col-md-6 form-group">
            <label for="account_no">{{_lang('A/C Number')}}
                <span class="text-danger">*</span>
            </label>
            <input type="text" required name="account_no" id="account_no" placeholder="A/C Number"
                class="form-control">
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

    _componentDatePicker();

</script>
