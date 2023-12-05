@extends('layouts.app', ['title' => _lang('Loan From Member Report'), 'modal' => 'lg'])


{{-- Script Section --}}
@push('css')
<style>
    @media print {

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
            color: #fff;
            background-color: #4caf50 !important;
        }
    }

</style>
@endpush
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Loan From Member Report."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Loan From Member Report')}}</h1>
        <p>{{_lang('Loan From Member Report. Here you can See Loan From Member Report')}}</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        {{-- {{ Breadcrumbs::render('cash-position-memo') }} --}}
    </ul>
</div>
@stop

{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <h3 class="tile-title">

            </h3>
            <div class="tile-body">
                {{-- <div class="row"> --}}



               

                <div id="print_table" style="color:black">
                    <span class="text-center">
                        <h3><b class="text-uppercase">{{$organization['name']}}</b></h3>
                        <h5>{{$organization['address']}}</h5>
                        <h6>{{$organization['phone']}},{{$organization['email']}}</h6>

                    </span>
                    <div class="text-center col-md-12">
                        <h4 style="margin:0px ; margin-top: 7px; border:solid 1px #000; border-radius:50px; display:inline-block; padding:10px;"
                            class="bg-success text-light">
                            <b>{{$report_type}}</b></h4>
                    </div>
                   
  
                    <div class="row">
                        <div class="col-md-6 text-left">
                             <p style="margin:0px ;"> Report Of Date : <span class="ml-1">{{$dates['start_date']}}</span> </p>
                        </div>
                    <div class="col-md-6 text-right" >
                        <p style="margin:0px;">Printing Date : <span></span> {{ date('d F, Y') }} </span></p>
                        <p style="margin:0px ; ">Time : <span></span>{{date('h:i:s A')}}</span></p>
                    </div>
                </div>
                    {{-- <hr class="border-dark "> --}}
                    
                      <div class="table-responsive mt-1">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>
                                        <p style="margin-top:-5px">Loan AC : {{ get_id_account_no('fdr', $fdr_info->prefix, $fdr_info->code)
                    }}</p>
                                        <p style="margin-top: -15px">Total Loan Amt : {{$due_and_payment_status['main_amount']}} Taka</p>
                                        <p style="margin-top: -15px">Interest Amt : {{$due_and_payment_status['interest_amt']}} Taka</p>
                                        <p style="margin-top: -15px">Grand Total Loan Amt: {{$due_and_payment_status['with_interest']}} Taka</p>

                                    </td>
                                    <td class="text-center">

                                        <p style="margin-top: -5px">Loan Duration : {{$fdr_info->loan_duration}} {{$fdr_info->loan_duration_type}}</p>

                                        <p style="margin-top: -15px">Approval : {{carbonDate($fdr_info->approval_date)}}</p>
                                        <p style="margin-top: -15px">Issue : {{carbonDate($fdr_info->issue_date)}}</p>
                                        <p style="margin-top: -15px">Completation : {{carbonDate($fdr_info->completion_date)}}</p>
                                        
                                    </td>
                                    <td class="text-center">
                                        <p style="margin-top: -5px">Per Month Withdrawable : {{$due_and_payment_status['per_month_withdrawable']}} Taka</p>
                                        {{-- <p style="margin-top: -15px">Paid Interest : {{$due_and_payment_status['paid_interest']}} Taka</p> --}}
                                        <p style="margin-top: -15px">Total Withdraw Amt : {{ $due_and_payment_status['total_withdraw_amt'] }} Taka</p>
                                        <p style="margin-top: -15px">Total Withdraw : {{ $due_and_payment_status['total_withdraw_times'] }} Times</p>
                                    </td>
                                    @foreach ($member_informations as $member_information)
                                       <td class="text-center"> 
                                    <p style="margin-top: -5px">Member Id : {{get_id_account_no('member',$member_information->member->prefix,$member_information->member->code)}}</p>
                                    <p style="margin-top: -15px">Name : {{$member_information->member->name_in_bangla}} </p>
                                    <p style="margin-top: -15px">Father : {{$member_information->member->father_name}} </p>
                                    <p style="margin-top: -15px">Mother : {{$member_information->member->mother_name}} </p>
                                    <p style="margin-top: -15px">Contact No : {{$member_information->member->contact_number}} </p>
                                    <p style="margin-top: -15px">Address : {{$member_information->member->present_address_line_1}},
                    {{$member_information->member->present_address_line_1}}, {{$member_information->member->present_city}},
                    {{$member_information->member->present_zipcode}} </p>
                                   
                                </td>
                                    @endforeach
                                    <td class="text-right">
                                </tr>

                            </tbody>
                        </table>
                    </div>
<div class="col-md-12 text-center mb-2" style="margin-top:-35px">
                        <h5>Withdraw History</h5>
                    </div>
                    <div class="table-responsive border-dark ">
                        <table class="table table-bordered ">
                            <thead class="table-head-bg">
                               
                                <tr>
                                    <th style="width:10%">Sl No</th>
                                    <th style="width:40%" scope="col">Date</th>
                                    <th style="width:50%" scope="col">Withdraw Amt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($due_and_payment_status['total_withdraw_times']>0)
                 @php
                 $i = 0 ;
                 @endphp
              
                 @foreach ($transaction_info as $transaction)
                    @php
                    $i++;
                    @endphp
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{carbonDate($transaction->tx_date)}}</td>
                        <td>{{$transaction->grand_total_amt}}</td>
                    </tr>
                 @endforeach
                    <tr class="text-weight-bold">
                        <td colspan="2" class="text-center">Total Withdraw</td>
                        <td>{{$due_and_payment_status['total_withdraw_amt']}}</td>
                    </tr>
                 @else
                 <tr>
                     <td colspan="3" align="center" class="text-danger">No Record Found</td>
                 </tr>
                 @endif
                            </tbody>
                        </table>

                    </div>
                    <br><br>

                    {{-- <h5>In Words:  {{ucwords(convert_number_to_words())}} Taka Only.</h5> --}}
                    <br><br><br>

                   <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-4 text-center">
                            <hr class="border-dark">
                            <p> Chief Cashier </p>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-4 text-center">
                            <hr class="border-dark">
                            <p> Manager </p>
                        </div>
                        <div class="col-md-1"></div>


                    </div>


                </div>
                <div class="text-center">

                    @php
                    $print_table = 'print_table';

                    @endphp

                    <a class="text-light btn-primary btn" onclick="printContent('{{ $print_table }}')" name="print"
                        id="print_receipt">
                        <i class="fa fa-print" aria-hidden="true"></i>
                        {{_lang('Print Report')}}

                    </a>

                </div>


                {{-- </div> --}}

            </div>
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
<script src="{{ asset('js/pages/voucher_report.js') }}"></script>
@endpush
