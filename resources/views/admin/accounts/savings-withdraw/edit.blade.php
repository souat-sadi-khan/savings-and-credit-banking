@extends('layouts.app', ['title' => _lang('Edit Savings Deposit'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')

<style>
    .table th,
    .table td {
        padding: 0.40rem 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

</style>
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Edit Savings Withdraw ">{{--<i class="fa fa-users mr-4"></i>--}}
            {{_lang('Edit Savings Withdraw Of ')}}{{$model->member->name_in_bangla}}</h1>
        <p>{{_lang('Here You Can Update Savings Withdraw')}}</p>
    </div>
    {{--<ul class="app-breadcrumb breadcrumb">
        {{ Breadcrumbs::render('savings-withdraw') }}
    </ul>--}}
</div>
@stop

{{-- Main Section --}}
@section('content')
<div class="tile">
    <div class="tile-body">
        <form action="{{route('admin.savings-withdraw.update', $model->id)}}" method="post" id="content_form">
            @csrf
            @method('PATCH')
            <div class="col-md-12">
                <hr>
                <h4 class="text-center">Update Savings Withdraw Of <span
                        class="badge badge-success ">{{$model->member->name_in_bangla}}
                        ({{ carbonDate($model->tx_date) }})</span></h4>
                <hr>
            </div>



            <div class="row">
                {{-- :::::::::::::::    Right Side Of The Page:::::::::::::::: --}}
                <div class="col-md-6">
                    <div class="col-md-12">
                        <h5 class="text-center text-info">New Withdraw Info</h5>
                        <hr>
                    </div>
                    {{-- select member --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="member_id">{{_lang('Member')}}

                        </label>
                        <div class="col-sm-8">
                            <input type="text" readonly name="member_id" id="member_id"
                                placeholder="" class="form-control" value="{{ $model->member->name_in_bangla }}  ({{$model->member->prefix}} {{numer_padding($model->member->code, get_option('digits_member_code'))}})">

                        </div>
                    </div>

                    {{-- select Savings Account --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="savings_acc_id">{{_lang('Select Savings AC')}}

                        </label>
                        <div class="col-sm-8">
                            <input type="text" readonly name="savings_acc_id" id="savings_acc_id"
                                placeholder="" class="form-control" value="{{ $model->savings_ac->prefix . numer_padding($model->savings_ac->code, get_option('digits_savings_account_code'))}}">
                        </div>
                    </div>

                    <h6 class="text-danger ">Withdraw Information</h6>
                    <hr>
                    {{--  new_withdraw --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="new_withdraw">{{_lang('New Withdraw Amt')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="number" min="0" step="1" required name="new_withdraw" id="new_withdraw"
                        placeholder="Enter New Withdraw Amount" class="form-control" value="{{$model->grand_total_amt}}">
                        </div>
                    </div>


                    {{--  total_savings --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="total_savings">{{_lang('Total Savings (Till Now)')}}

                        </label>
                        <div class="col-sm-8">
                            <input type="number" min="0" readonly name="total_savings" id="total_savings"
                        placeholder="Total Savings Till Now" class="form-control" value="{{$payment_status['currntly_in_hand']}}">
                        </div>
                    </div>

                    {{--  grand_total_savings --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label"
                            for="grand_total_savings">{{_lang('Grand Total Savings')}}

                        </label>
                        <div class="col-sm-8">
                            <input type="number" min="0" readonly name="grand_total_savings" id="grand_total_savings"
                                placeholder="Total Savings - New Withdraw Amt" class="form-control"  value="{{$payment_status['currntly_in_hand'] }}">
                        </div>
                    </div>


                    {{--  The following hiddens section is for calculation --}}
                    <div style="display:none">
                        <div class="col-md-12">
                            <h5>
                                Hidden section for calculation
                            </h5>
                            <hr>
                        </div>
                        {{-- main TOtal --}}
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="savings_in_hand">{{_lang('Savings In hand')}}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-8">
                                <input type="hidden" readonly name="savings_in_hand" id="savings_in_hand" placeholder=""
                                    class="form-control" value="{{$payment_status['currntly_in_hand'] + $model->grand_total_amt}}">
                            </div>
                        </div>


                        <div class="col-md-12">
                            <hr>
                            <h5>
                                Hidden section ends here
                            </h5>
                        </div>

                    </div>



                    {{--  pay_type --}}

                    <div class=" form-group row">
                        <label class="col-sm-4 col-form-label" for="payment_method"
                            class="col-sm-4 col-form-label">{{_lang('Payment Method')}}
                            <span class="text-danger">*</span>
                        </label>

                        <div class="col-sm-8">
                            <select name="payment_method" id="payment_method" class="form-control select"
                                data-placeholder="Please Select One .." required required
                                data-parsley-errors-container="#payment_method_error">
                                <option value="">Please Select One ..</option>
                                <option value="Cash" {{ $model->payment_method == 'Cash'?'selected':'' }}>Cash</option>
                                <option value="Bank Check" {{ $model->payment_method == 'Bank Check'?'selected':'' }}>Bank Check</option>
                                <option value="Mobile Banking" {{ $model->payment_method == 'Mobile Banking'?'selected':'' }}>Mobile Banking</option>
                            </select>
                            <span id="payment_method_error"></span>

                        </div>
                    </div>

                    {{-- ::::::::::::::::   Payment method information     ::::::::::::::::::::: --}}

                    {{-- ::::::::::::::::::    Mobile Banking Payment Information     :::::::::::::::::::: --}}
                    <div class="mobile_banking" style="display:{{ $model->payment_method == 'Mobile Banking'?'':'none' }}">
                        <h6 class="text-danger mobile_banking">Payment With Mobile Banking</h6>
                        <hr>
                        <div class="form-group row mobile_banking">
                            <label class="col-sm-4 col-form-label"
                                for="mob_banking_name">{{_lang('Mobile Banking Name')}}

                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="mob_banking_name" id="mob_banking_name"
                                    placeholder="Enter Mobile Banking Name " {{ $model->payment_method == 'Mobile Banking'?'required':'' }}
                            class="form-control mobile_banking mobile_banking_required" value="{{$model->mob_banking_name}}">
                            </div>
                        </div>

                        <div class="form-group row mobile_banking">
                            <label class="col-sm-4 col-form-label"
                                for="mob_account_holder">{{_lang('Account Holder Name')}}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="mob_account_holder" id="mob_account_holder"
                                    placeholder="Enter Account Holder Name" class="form-control mobile_banking" value="{{$model->mob_account_holder}}">
                            </div>
                        </div>

                        <div class="form-group row mobile_banking">
                            <label class="col-sm-4 col-form-label"  {{ $model->payment_method == 'Mobile Banking'?'required':'' }} for="sending_mob_no">{{_lang('Sending Mobile No')}}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="sending_mob_no" id="sending_mob_no"
                                    placeholder="Enter Sending Mobile No"
                                    class="form-control mobile_banking mobile_banking_required" value="{{$model->sending_mob_no}}">
                            </div>
                        </div>

                        <div class="form-group row mobile_banking">
                            <label class="col-sm-4 col-form-label"  for="receiving_mob_no">{{_lang('Receiving Mob No')}}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="receiving_mob_no" id="receiving_mob_no"
                                    placeholder="Enter Receiving Mob No"  {{ $model->payment_method == 'Mobile Banking'?'required':'' }}
                                    class="form-control mobile_banking mobile_banking_required" value="{{$model->receiving_mob_no}}">
                            </div>
                        </div>

                        <div class="form-group row mobile_banking">
                            <label class="col-sm-4 col-form-label" for="mob_tx_id">{{_lang('Transaction ID')}}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="mob_tx_id" id="mob_tx_id" placeholder="Enter Transaction ID"  {{ $model->payment_method == 'Mobile Banking'?'required':'' }}
                                    class="form-control mobile_banking mobile_banking_required" value="{{$model->mob_tx_id}}">
                            </div>
                        </div>

                            <div class="form-group row mobile_banking">
                            <label class="col-sm-4 col-form-label" for="mob_payment_date">{{_lang('Payment Date')}}
                            </label>

                            <div class="col-sm-8">
                                <input type="text" readonly name="mob_payment_date" id="mob_payment_date"
                                    placeholder="Enter Payment Date"
                            class="form-control mobile_banking date mobile_banking_required" value="{{ $model->mob_payment_date ? (Carbon\Carbon::createFromFormat('Y-m-d', $model->mob_payment_date)->format('d/m/Y')) :null }}">
                            </div>
                        </div>


                    </div>
                    {{-- ::::::::::::::::::    Bank Check Payment Information     :::::::::::::::::::: --}}
                    <div class="bank_check" style="display:{{ $model->payment_method == 'Bank Check'?'':'none' }}">
                        <h6 class="text-danger">Payment With Bank Check</h6>
                        <hr>
                        <div class="form-group row bank_check">
                            <label class="col-sm-4 col-form-label" for="bank_name">{{_lang('Bank Name')}}

                            </label>
                            <div class="col-sm-8">
                                <input type="text" {{ $model->payment_method == 'Bank Check'?'required':'' }} name="bank_name" id="bank_name" placeholder="Enter Bank Name "
                            class="form-control bank_check bank_check_required" value="{{$model->bank_name}}">
                            </div>
                        </div>

                        <div class="form-group row bank_check">
                            <label class="col-sm-4 col-form-label" for="account_holder">{{_lang('Account Holder Name')}}
                            </label>
                            <div class="col-sm-8">
                                <input type="text"  name="account_holder" id="account_holder"
                                    placeholder="Enter Account Holder Name"
                                    class="form-control bank_check bank_check_required" value="{{$model->account_holder}}">
                            </div>
                        </div>

                        <div class="form-group row bank_check">
                            <label class="col-sm-4 col-form-label"  for="account_no">{{_lang('Account Number')}}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="account_no" id="account_no"
                                    placeholder="Enter Bank Account Number" {{ $model->payment_method == 'Bank Check'?'required':'' }}
                                    class="form-control bank_check bank_check_required" value="{{$model->account_no}}">
                            </div>
                        </div>

                        <div class="form-group row bank_check">
                            <label class="col-sm-4 col-form-label" for="check_no">{{_lang('Check No')}}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="check_no" id="check_no" placeholder="Enter Check No" {{ $model->payment_method == 'Bank Check'?'required':'' }}
                                    class="form-control bank_check bank_check_required" value="{{$model->check_no}}">
                            </div>
                        </div>

                           <div class="form-group row bank_check">
                            <label class="col-sm-4 col-form-label"
                                for="check_active_date">{{_lang('Check Active Date')}}
                            </label>
                            <div class="col-sm-8">
                                <input type="text" readonly name="check_active_date" id="check_active_date"
                                    placeholder="Enter Check Active Date"
                                    class="form-control bank_check date bank_check_required" value="{{ $model->check_active_date ? (Carbon\Carbon::createFromFormat('Y-m-d', $model->check_active_date)->format('d/m/Y')) :null }}">
                            </div>
                        </div>


                    </div>
                    <h6 class="text-danger ">Additional Information</h6>
                    <hr>

                         <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="tx_date">{{_lang('Transaction Date')}}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-8">
                            <input type="text" required readonly name="tx_date" id="tx_date" placeholder="Enter Transaction Date"  class="form-control date" value="{{date("d/m/Y", strtotime($model->tx_date))}}">

                            </div>
                        </div>

                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="additional_note">{{_lang('Comment')}}
                        </label>
                        <div class="col-sm-8">
                            <textarea name="additional_note" id="additional_note" placeholder="Enter Comment"
                                class="form-control "></textarea>
                        </div>
                    </div>
                </div>


                {{-- :::::::::::::::    Right Side Of The Page:::::::::::::::: --}}
                <div class="col-md-6">
                    <div class="col-md-12">
                        <h5 class="text-center text-info">Previous Deposit Informaiton</h5>
                        <hr>
                    </div>
                    <div id="previous_payment_records">

                        {{-- :::::::::::::::::::::::::::::::::::: --}}
                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                             <li class="nav-item">
                                <a class="nav-link active" id="withdraw-tab" data-toggle="tab" href="#withdraw" role="tab"
                                    aria-controls="withdraw" aria-selected="false">withdraw Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                    aria-controls="profile" aria-selected="false">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " id="deposit-info-tab" data-toggle="tab" href="#deposit-info"
                                    role="tab" aria-controls="deposit-info" aria-selected="true">Deposit Info</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">


                            {{-- ::::::::::    Loan Info Tab Content    ::::::::: --}}
                            <div class="tab-pane fade show active" id="withdraw" role="tabpanel"
                                aria-labelledby="withdraw-tab">

{{-- ;;;;;;;;;;;;;;;;;;;;;;;;;;;;;; --}}
<table class="table table-striped table-bordered  mt-3" style="width:100%;">
                                    <thead>
                                        <tr class="text-center" class="bg-success text-light" style="">
                                            <th colspan="2" class="text-light" style="background:#099286;padding:7px">
                                                Withdraw Information
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="row" style="margin-bottom:25px">
                                    <div class="col-md-12 text-center">
                                        <h6>Summery</h6>
                                        <hr class="my-1">
                                    </div>
                                    <div class="col-md-6">
                                        <span>Total Deposit : {{ $payment_status['total_deposit'] }} (Taka)</span><br>
                                        <span>Total Withdraw : {{ $payment_status['total_withdraw'] }} (Taka)</span><br>
                                        <span>Total Savings: {{ $payment_status['currntly_in_hand'] }} (Taka)</span><br>
                                    </div>

                                    <div class="col-md-6" align="right">
                                        <span>Deposit : {{ $payment_status['deposit_times'] }} (Times)</span><br>
                                        <span>Withdraw : {{ $payment_status['withdraw_times'] }} (Times)</span><br>
                                    </div>

                                </div>
                                <div class="col-md-12 text-center">
                                    <h6>Withdraw In Detail</h6>
                                    <hr class="my-1">
                                </div>
                                <table id="withdraw_data_table" class="table table-striped table-bordered"
                                    style="width:100%;">

                                    <thead>
                                        <tr class="bg-success text-light">
                                            <th>Sl No</th>
                                            <th>Invoice No</th>
                                            <th>Date</th>
                                            <th>Withdraw Amt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($payment_status['withdraw_times']>0)
                                        @php
                                        $i = 0 ;
                                        @endphp
                                        @foreach ($withdraw_info as $withdraw)
                                        @php
                                        $i++;
                                        @endphp
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$withdraw->invoice_no}}</td>
                                            <td>{{carbonDate($withdraw->tx_date)}}</td>
                                            <td>{{$withdraw->grand_total_amt}}</td>
                                        </tr>
                                        @endforeach

                                        @else
                                        <tr>
                                            <td colspan="5" align="center" class="text-danger">No Withdraw Of Savings
                                                Found</td>
                                        </tr>
                                        @endif

                                    </tbody>

                                </table>

                            </div>


                            {{-- ::::::::::    Loan Info Tab Content    ::::::::: --}}
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <table class="table table-bordered mt-3">
                                    <thead>
                                        <tr class="text-center" class="bg-success text-light" style="">
                                            <th colspan="2" class="text-light" style="background:#099286;padding:7px">
                                                Member Profile
                                            </th>
                                        </tr>

                                        <tr class="text-center" class="bg-success text-light" style="">
                                            <th colspan="2" class="text-light"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            <td>{{$model->member->name_in_bangla}}</td>
                                        </tr>

                                        <tr>
                                            <td>ID</td>
                                            <td>
                                                {{$model->member->prefix}}
                                                {{numer_padding($model->member->code, get_option('digits_member_code'))}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Father</td>
                                            <td>{{$model->member->father_name}}</td>
                                        </tr>

                                        @if ($model->member->husband_name)
                                        <tr>
                                            <td>Mother</td>
                                            <td>{{$model->member->mother_name}}</td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <td>Mobile</td>
                                            <td>{{$model->member->contact_number}}</td>
                                        </tr>

                                        <tr>
                                            <td>Address</td>
                                            <td>
                                                {{$model->member->present_address_line_1}},
                                                {{$model->member->present_address_line_1}}, {{$model->member->present_city}},
                                                {{$model->member->present_zipcode}}
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>Image</td>
                                            <td>
                                                <a href="{{asset('storage/member/'.$model->member->photo)}}" target="_blank">
                                                    <img src="{{asset('storage/member/'.$model->member->photo)}}" width="30%"
                                                        alt="Image Not Uploaded." class="rounded img-thumbnail">
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Signature</td>
                                            <td>
                                                <a href="{{asset('storage/member/'.$model->member->signature)}}"
                                                    target="_blank">
                                                    <img src="{{asset('storage/member/'.$model->member->signature)}}"
                                                        width="30%" alt="Image Not Uploaded."
                                                        class="rounded img-thumbnail">
                                                </a>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>

                            {{-- ::::::::::    Loan Info Tab Content    ::::::::: --}}
                            <div class="tab-pane fade" id="deposit-info" role="tabpanel" aria-labelledby="deposit-info-tab">
                                  <table class="table table-striped table-bordered  mt-3" style="width:100%;">
                                    <thead>
                                        <tr class="text-center" class="bg-success text-light" style="">
                                            <th colspan="2" class="text-light" style="background:#099286;padding:7px">
                                                Deposit Information
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                                <div class="row" style="margin-bottom:25px">
                                    <div class="col-md-12 text-center">
                                        <h6>Summery</h6>
                                        <hr class="my-1">
                                    </div>

                                    <div class="col-md-6">
                                        <span>Total Deposit : {{ $payment_status['total_deposit'] }} (Taka)</span><br>
                                        <span>Total Withdraw : {{ $payment_status['total_withdraw'] }} (Taka)</span><br>
                                        <span>Total Savings: {{ $payment_status['currntly_in_hand'] }} (Taka)</span><br>
                                    </div>

                                    <div class="col-md-6" align="right">
                                        <span>Deposit : {{ $payment_status['deposit_times'] }} (Times)</span><br>
                                        <span>Withdraw : {{ $payment_status['withdraw_times'] }} (Times)</span><br>
                                    </div>

                                </div>
                                <div class="col-md-12 text-center">
                                    <h6>Deposit In Detail</h6>
                                    <hr class="my-1">
                                </div>
                                <table id="deposit_data_table" class="table table-striped table-bordered"
                                    style="width:100%;">
                                    <thead>
                                        <tr class="bg-success text-light">
                                            <th>Sl No</th>
                                            <th>Invoice No</th>
                                            <th>Date</th>
                                            <th>Deposit Amt</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($payment_status['deposit_times']>0)
                                        @php
                                        $i = 0 ;
                                        @endphp
                                        @foreach ($deposit_info as $deposit)
                                        @php
                                        $i++;
                                        @endphp
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$deposit->invoice_no}}</td>
                                            <td>{{carbonDate($deposit->tx_date)}}</td>
                                            <td>{{$deposit->grand_total_amt}}</td>
                                        </tr>
                                        @endforeach

                                        @else
                                        <tr>
                                            <td colspan="5" align="center" class="text-danger">No Deposit Of Savings
                                                Found</td>
                                        </tr>
                                        @endif

                                    </tbody>

                                </table>

                            </div>
                        </div>

                    </div>
                </div>


                <div class="form-group col-md-12" align="right">
                    {{-- <input type="hidden" name="type[]" value=" "> --}}
                    <button type="submit" class="btn btn-primary" id="submit">{{_lang('Save')}}<i
                            class="icon-arrow-right14 position-right"></i></button>
                    <button type="button" class="btn btn-link" id="submiting"
                        style="display: none;">{{_lang('Processing')}}
                        <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                </div>
            </div>
        </form>

    </div>
</div>
</div>
<!-- /basic initialization -->
@stop

{{-- Script Section --}}
@push('scripts')
<script type="text/javascript" src="{{asset('backend/js/plugins/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('backend/js/plugins/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('backend/js/plugins/select.min.js') }}"></script>
{{-- <script src="{{ asset('backend/js/plugins/buttons.min.js') }}"></script> --}}
<script src="{{ asset('backend/js/plugins/responsive.min.js') }}"></script>
<script src="{{ asset('js/pages/savings_withdraw.js') }}"></script>

<script>
    $('.select').select2({
        width: '100%'
    });

    $(document).ready(function () {
        // $('#example').DataTable();

        $('#withdraw_data_table').DataTable({
            "searching": false,
            "lengthChange": false,
            "pageLength": 15
        });

        $('#deposit_data_table').DataTable({
            "searching": false,
            "lengthChange": false,
            "pageLength": 15
        });

    });

</script>


@endpush
