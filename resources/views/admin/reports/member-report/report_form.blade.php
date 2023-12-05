<form action="{{route('admin.member-report.store')}}" method="post" id="report_form">
    @csrf
  
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 form-group">
            <label for="end_date">{{_lang('Please Select Member')}}
                <span class="text-danger">*</span>
            </label>
             <select name="member_id" id="member_id" data-placeholder="Please Select One.." class="form-control select" data-url="{{ route('admin.member-report.get-account')}}" required data-parsley-errors-container="#member_error">
                <option value="">Please Select One .. </option>
                @if ($report_type == 'SHARE REPORT')

                 @foreach ($accounts as $account)
                        <option value="{{$account->id}}">
                            {{$account->name_in_bangla.', '.get_id_account_no('member', $account->prefix, $account->code).', '.$account->contact_number}}
                        </option>
                    @endforeach
                    
                @else 

                   @foreach ($accounts as $account)
                        <option value="{{$account->id}}">
                            {{$account->member->name_in_bangla.', '.get_id_account_no('member', $account->member->prefix, $account->member->code).', '.$account->member->contact_number}}
                        </option>
                    @endforeach
                @endif
                 
            </select>
            <span id="member_error"></span>
        </div>
        <div class="col-md-3"></div>
    </div>
  
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 form-group">
            <label for="account_id">{{_lang('Select An Account')}}
                <span class="text-danger">*</span>
            </label>
             <select name="account_id" id="account_id" data-placeholder="Please Select One.." class="form-control select" required data-parsley-errors-container="#account_error">
                <option value="">Please Select One .. </option>
                  
            </select>
            <span id="account_error"></span>
        </div>
        <div class="col-md-3"></div>
    </div>

    
    <div class="row" style="display:none">
        <div class="col-md-3"></div>
        <div class="col-md-6 form-group">
            <label for="report_type">{{_lang('Report Type')}}
                <span class="text-danger">*</span>
            </label>
            <input type="hidden" id="report_type" required readonly name="report_type" class="form-control" value="{{ $report_type }}">
            
        </div>
        <div class="col-md-3"></div>
    </div>


    <div class="form-group col-md-12" align="center">
        {{-- <input type="hidden" name="type[]" value=" "> --}}
        <button type="submit" class="btn btn-primary" id="submit">
            <i class="fa fa-eye" aria-hidden="true"></i>
            {{_lang('View Voucher')}}
        </button>

        <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}
            <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
    </div>

</form>
<script>
     _componentDatePicker();
</script>