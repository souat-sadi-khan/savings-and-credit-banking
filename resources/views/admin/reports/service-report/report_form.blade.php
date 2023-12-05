<form action="{{route('admin.service-report.store')}}" method="post" id="report_form">
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

    
    <div class="row" style="display:none">
        <div class="col-md-3"></div>
        <div class="col-md-6 form-group">
            <label for="report_head">{{_lang('Report Head')}}
                <span class="text-danger">*</span>
            </label>
            @if ($report_type == 'LOAN REPORT')
            <input type="text" required readonly name="report_head" class="form-control" value="Loan">
            @endif
            @if ($report_type == 'DPS REPORT')
            <input type="text" required readonly name="report_head" class="form-control" value="DPS">
            @endif
            @if ($report_type == 'DOUBLE BENEFIT REPORT')
            <input type="text" required readonly name="report_head" class="form-control" value="double_benifit">
            @endif
            @if ($report_type == 'LOAN FROM MEMBER REPORT')
            <input type="text" required readonly name="report_head" class="form-control" value="loan_from_member">
            @endif
            @if ($report_type == 'SHARE REPORT')
            <input type="text" required readonly name="report_head" class="form-control" value="share">
            @endif
            @if ($report_type == 'SAVINGS REPORT')
            <input type="text" required readonly name="report_head" class="form-control" value="savings">
                @endif
        </div>
        <div class="col-md-3"></div>
    </div>

    

   
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 form-group">
            <label for="report_type">{{_lang('Report Type')}}
                <span class="text-danger">*</span>
            </label>
           
                    <select name="report_type" id="report_type" required class="form-control select"
                        data-placeholder="Please Select One..">
                        <option value="">Please Select One ..</option>
                         @if ($report_type == 'LOAN REPORT')
                            <option value="LOAN PROVIDED">Loan Provided</option>
                            <option value="LOAN COLLECTED">Loan Collected</option>
                            <option value="LOAN PROVIDED & COLLECTED">Loan Provided & Collected</option>
                         @endif
                         @if ($report_type == 'DPS REPORT')
                            <option value="DPS DEPOSIT">DPS Deposit</option>
                            <option value="DPS WITHDRAW">DPS Withdraw</option>
                            <option value="DPS DEPOSIT & WITHDRAW">DPS Deposit & Withdraw</option>
                         @endif
                         @if ($report_type == 'DOUBLE BENEFIT REPORT')
                            <option value="DOUBLE BENEFIT DEPOSIT">Double Benefit Deposit</option>
                            <option value="DOUBLE BENEFIT WITHDRAW">Double Benefit Withdraw</option>
                            <option value="DOUBLE BENEFIT DEPOSIT & WITHDRAW">Double Benefit Deposit & Withdraw</option>
                         @endif
                         @if ($report_type == 'LOAN FROM MEMBER REPORT')
                            <option value="LOAN FROM MEMBER DEPOSIT">Loan From Member Deposit</option>
                            <option value="LOAN FROM MEMBER WITHDRAW">Loan From Member Withdraw</option>
                            <option value="LOAN FROM MEMBER DEPOSIT & WITHDRAW">Loan From Member Deposit & Withdraw</option>
                         @endif
                         @if ($report_type == 'SHARE REPORT')
                            <option value="SHARE DEPOSIT">Share Deposit</option>
                            <option value="SHARE WITHDRAW">Share Withdraw</option>
                            <option value="SHARE DEPOSIT & WITHDRAW">Share Deposit & Withdraw</option>
                         @endif
                         @if ($report_type == 'SAVINGS REPORT')
                            <option value="SAVINGS DEPOSIT">Savings Deposit</option>
                            <option value="SAVINGS WITHDRAW">Savings Withdraw</option>
                            <option value="SAVINGS DEPOSIT & WITHDRAW">Savings Deposit & Withdraw</option>
                         @endif
                    </select>
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