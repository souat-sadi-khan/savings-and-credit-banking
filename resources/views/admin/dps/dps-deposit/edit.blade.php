@extends('layouts.app', ['title' => _lang('Edie DPS Deposit From Member'), 'modal' => 'lg'])
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
        <h1 data-placement="bottom" title="Edie DPS Deposit From Member ">{{--<i class="fa fa-users mr-4"></i>--}}
            {{_lang('Edie DPS Deposit From Member ')}}</h1>
        <p>{{_lang('Here You Can Edit DPS Deposit From Members')}}</p>
    </div>
   {{-- <ul class="app-breadcrumb breadcrumb">
        {{ Breadcrumbs::render('dps-deposit') }}
    </ul>--}}
</div>
@stop

{{-- Main Section --}}
@section('content')
<div class="tile">
    <div class="tile-body">
          <form action="{{route('admin.dps-deposit.update', $model->id)}}" method="post" id="content_form">
            @csrf
            @method('PATCH')
            <div class="col-md-12">
                <hr>
                <h4 class="text-center">Edit New DPS Deposit</h4>
                <hr>
            </div>



            <div class="row">
                {{-- :::::::::::::::    Right Side Of The Page:::::::::::::::: --}}
                <div class="col-md-6">
                    <div class="col-md-12">
                        <h5 class="text-center text-info">Deposit Info To Be Edited</h5>
                        <hr>
                    </div>
                    {{-- select member --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="member_id">{{_lang(' Member')}}

                        </label>
                       <div class="col-sm-8">
                            <input type="text"  readonly name="member_id" id="member_id"
                                class="form-control" value='{{$member->name_in_bangla.' ('. $member->prefix . numer_padding($member->code, get_option('digits_member_code')) .') '.$member->contact_number}}'>
                        </div>
                    </div>

                    {{-- select Savings Account --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="dps_account_id">{{_lang(' DPS AC No')}}

                        </label>
                        <div class="col-sm-8">
                            <input type="text"  readonly name="dps_account_id" id="dps_account_id"
                                class="form-control" value='{{$dps_acc_info->prefix . numer_padding($dps_acc_info->code, get_option('digits_dps_code'))}}'>
                        </div>
                    </div>

                    <h6 class="text-danger ">Deposit Information</h6>
                    <hr>
                    {{--  new_deposit --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="new_deposit">{{_lang('New Deposit Amt')}}
                            <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="number" min="0" step="1" readonly required name="new_deposit" id="new_deposit"
                        placeholder="Enter New Deposit Amount" class="form-control" value="{{$model->grand_total_amt}}">
                        </div>
                    </div>



                    {{--  grand_total_dps --}}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label" for="grand_total_dps">{{_lang('Grand Total DPS')}}

                        </label>
                        <div class="col-sm-8">
                            <input type="number" min="0" readonly name="grand_total_dps" id="grand_total_dps"
                                placeholder="Total DPS + New Deposit Amt" class="form-control" value="{{$payment_status['total_deposit']}}">
                        </div>
                    </div>


                    <h6 class="text-danger ">DPS No Payment Information</h6>
                    <hr>
                              @php
                 $duration = $dps_acc_info->dps_duration;
                 $duration_type = $dps_acc_info->dps_duration_type;
                 if ($duration_type == 'Year') {
                 $total_dps = $duration * 12 ;
                 }else {
                 $total_dps = $duration;
                 }
                 $paid_dps = $payment_status['deposit_times'];
                 $due_dps = $total_dps - $paid_dps ;

                 @endphp
                    <div class="row">
                        {{-- Total No Of DPS --}}
                        <div class="col-md-4 form-group">
                            <label for="no_of_dps">{{_lang('Total DPS')}}
                            </label>
                            <div class="input-group">
                                <input type="number" min="0" readonly name="no_of_dps" id="no_of_dps"
                            class="form-control" value="{{$total_dps}}">
                            </div>
                        </div>
                        {{-- Total No Of Paid DPS --}}
                        <div class="col-md-4 form-group">
                            <label for="paid_dps">{{_lang('Paid DPS')}}
                            </label>
                            <div class="input-group">
                                <input type="number" min="0" readonly name="paid_dps" id="paid_dps"
                                    class="form-control" value="{{$paid_dps}}">
                            </div>
                        </div>
                        {{-- Total No Of Due DPS --}}
                        <div class="col-md-4 form-group">
                            <label for="due_dps">{{_lang('Due DPS')}}
                            </label>
                            <div class="input-group">
                                <input type="number" min="0" readonly name="due_dps" id="due_dps" class="form-control" value="{{$due_dps}}">
                            </div>
                        </div>


                    </div>



                    {{--  pay_type --}}

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
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="deposit-info-tab" data-toggle="tab" href="#deposit-info"
                                    role="tab" aria-controls="deposit-info" aria-selected="true">Deposit Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="withdraw-tab" data-toggle="tab" href="#withdraw" role="tab"
                                    aria-controls="withdraw" aria-selected="false">withdraw Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="dps-tab" data-toggle="tab" href="#dps" role="tab"
                                    aria-controls="dps" aria-selected="false">DPS Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                    aria-controls="profile" aria-selected="false">Profile</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">


                            {{-- ::::::::::    Deposit Info Tab Content    ::::::::: --}}
                            <div class="tab-pane fade show active" id="deposit-info" role="tabpanel"
                                aria-labelledby="deposit-info-tab">
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
                                        <span>Total Deposit Amt: {{ $payment_status['total_deposit'] }}
                                            (Taka)</span><br>
                                        <span>Total Withdraw : {{ $payment_status['total_withdraw'] }} (Taka)</span><br>
                                        {{-- <span>Total Savings:
                                            {{ $dps_acc_info->grand_total_dps - $payment_status['total_deposit'] }}
                                            (Taka)</span><br> --}}
                                    </div>

                                    <div class="col-md-6" align="right">
                                        @php
                                        $duration = $dps_acc_info->dps_duration;
                                        $duration_type = $dps_acc_info->dps_duration_type;
                                        if ($duration_type == 'Year') {
                                        $total_dps = $duration * 12 ;
                                        }else {
                                        $total_dps = $duration;
                                        }
                                        $paid_dps = $payment_status['deposit_times'];
                                        $due_dps = $total_dps - $paid_dps ;

                                        @endphp
                                        <span>Total DPS No: {{ $total_dps }}</span><br>
                                        <span>Paid DPS : {{ $paid_dps }}</span><br>
                                        <span>Due DPS : {{ $due_dps }}</span><br>
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
                                            <td colspan="5" align="center" class="text-danger">No Deposit Of DPS Found
                                            </td>
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
                                            <td>{{$member->name_in_bangla}}</td>
                                        </tr>

                                        <tr>
                                            <td>ID</td>
                                            <td>
                                                {{$member->prefix}}
                                                {{numer_padding($member->code, get_option('digits_member_code'))}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Father</td>
                                            <td>{{$member->father_name}}</td>
                                        </tr>

                                        @if ($member->husband_name)
                                        <tr>
                                            <td>Mother</td>
                                            <td>{{$member->mother_name}}</td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <td>Mobile</td>
                                            <td>{{$member->contact_number}}</td>
                                        </tr>

                                        <tr>
                                            <td>Address</td>
                                            <td>
                                                {{$member->present_address_line_1}},
                                                {{$member->present_address_line_1}}, {{$member->present_city}},
                                                {{$member->present_zipcode}}
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>Image</td>
                                            <td>
                                                <a href="{{asset('storage/member/'.$member->photo)}}" target="_blank">
                                                    <img src="{{asset('storage/member/'.$member->photo)}}" width="30%"
                                                        alt="Image Not Uploaded." class="rounded img-thumbnail">
                                                </a>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Signature</td>
                                            <td>
                                                <a href="{{asset('storage/member/'.$member->signature)}}"
                                                    target="_blank">
                                                    <img src="{{asset('storage/member/'.$member->signature)}}"
                                                        width="30%" alt="Image Not Uploaded."
                                                        class="rounded img-thumbnail">
                                                </a>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>

                            {{-- ::::::::::    Loan Info Tab Content    ::::::::: --}}
                            <div class="tab-pane fade" id="withdraw" role="tabpanel" aria-labelledby="withdraw-tab">
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
                                            <td colspan="5" align="center" class="text-danger">No Withdraw Of DPS Found
                                            </td>
                                        </tr>
                                        @endif

                                    </tbody>

                                </table>


                            </div>
                            {{-- :::::::::::: DPS Infromation :::::::::::::: --}}
                            <div class="tab-pane fade  " id="dps" role="tabpanel" aria-labelledby="dps-tab">
                                <table class="table table-bordered mt-3">
                                    <thead>
                                        <tr class="text-center" class="bg-success text-light" style="">
                                            <th colspan="4" class="text-light" style="background:#099286;padding:15px">
                                                Dps Information In Detail
                                            </th>
                                        </tr>
                                        <tr class="text-center" class="bg-success text-light" style="">
                                            <th colspan="4" class="text-light"></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>DPS Per Month Amt</td>
                                            <td>{{$dps_acc_info->per_month_dps_amt}} Taka</td>
                                            <td>Interest Rate</td>
                                            <td>{{$dps_acc_info->interest_rate}} %</td>
                                        </tr>

                                        <tr>
                                            <td>Interest Amt</td>
                                            <td>{{$dps_acc_info->total_interest_amt}} Taka</td>
                                            <td> Duration</td>
                                            <td>{{$dps_acc_info->dps_duration}} {{$dps_acc_info->dps_duration_type}}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Total DPS</td>
                                            <td>{{$dps_acc_info->total_dps_amt}} Taka</td>
                                            <td>Total DPS No</td>
                                            <td>{{$total_dps}}
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>Grand Total</td>
                                            <td>{{$dps_acc_info->grand_total_dps}} Taka</td>
                                            <td>Paid DPS No</td>
                                            <td>{{$paid_dps}}</td>


                                        </tr>

                                        <tr>
                                            <td>Paid DPS</td>
                                            <td>{{$payment_status['total_deposit']}} Taka</td>
                                            <td>Due DPS No</td>
                                            <td>{{$due_dps}}</td>

                                        </tr>

                                        <tr>
                                            <td>Due DPS</td>
                                            <td>{{$dps_acc_info->grand_total_dps - $payment_status['total_deposit']}}
                                                Taka</td>




                                        </tr>


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
<script src="{{ asset('js/pages/dps_deposit.js') }}"></script>

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
