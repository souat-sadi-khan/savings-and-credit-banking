<form action="{{route('admin.bank-tx-report.store')}}" method="post" id="report_form">
    @csrf
    <div class="row">

        <div class="col-md-3"></div>
        <div class="col-md-6 form-group">
            <label for="start_date">{{_lang('Start Date')}}
                <span class="text-danger">*</span>
            </label>
            <input type="text" required readonly name="start_date" placeholder="Enter Start Date "
                class="form-control date" value="{{date('d/m/Y')}}">
        </div>
        <div class="col-md-3"></div>
    </div>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 form-group">
            <label for="end_date">{{_lang('End Date')}}
                <span class="text-danger">*</span>
            </label>
            <input type="text" required readonly name="end_date" placeholder="Enter End Date " class="form-control date"
                value="{{date('d/m/Y')}}">
        </div>
        <div class="col-md-3"></div>
    </div>

    @if ($report_type == 'BANK ACCOUNT WISE DEPOSIT REPORT' ||$report_type == 'BANK ACCOUNT WISE WITHDRAW REPORT')
        
    <div class="row" >
        <div class="col-md-3"></div>
        <div class="col-md-6 form-group">
            <label for="report_type">{{_lang('Select Bank Account')}}
                <span class="text-danger">*</span>
            </label>
              <select name="account_id" id="account_id" data-placeholder="Please Select One.." class="form-control select" required data-parsley-errors-container="#account_error">
                <option value="">Please Select One .. </option>
                  @foreach ($bank_accounts as $account)
                      <option value="{{ $account->id }}">{{ $account->account_no.', '.$account->bank_name.', '.$account->account_holder_name }}</option>
                  @endforeach
            </select>
            
        </div>
        <div class="col-md-3"></div>
    </div>
    @endif

    
    <div class="row" style="display: none">
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
            {{_lang('View Repoet')}}
        </button>

        <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}
            <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
    </div>

</form>
<script>
     _componentDatePicker();
</script>