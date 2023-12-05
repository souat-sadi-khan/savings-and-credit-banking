<form action="{{route('admin.daily-report.store')}}" method="post" id="report_form">
    @csrf
    <div class="row">

        <div class="col-md-3"></div>
        <div class="col-md-6 form-group">
            <label for="start_date">{{_lang('Report Date')}}
                <span class="text-danger">*</span>
            </label>
            <input type="text" required readonly name="start_date" placeholder="Enter Report Date "
                class="form-control date" value="{{date('d/m/Y')}}">
        </div>
        <div class="col-md-3"></div>
    </div>

  

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 form-group" style="display:none">
            <label for="report_type">{{_lang('Voucher Type')}}
                <span class="text-danger">*</span>
            </label>
            <input type="hidden" required readonly name="report_type" placeholder="Report Type" class="form-control"
                value="{{$report_type}}">


        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="form-group col-md-12" align="center">
        <button type="submit" class="btn btn-primary" id="submit">
            <i class="fa fa-eye" aria-hidden="true"></i>
            {{_lang('View Report')}}
        </button>

        <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{_lang('Processing')}}
            <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
    </div>

</form>
<script>
     _componentDatePicker();
</script>