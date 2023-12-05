@extends('layouts.app', ['title' => _lang('Loan Report'), 'modal' => 'lg'])


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
        <h1 data-placement="bottom" title="Loan Report."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Loan Report')}}</h1>
        <p>{{_lang('Loan Report. Here you can See Loan Report')}}</p>
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
                                        <p style="margin-top:-5px">Loan AC : {{ get_id_account_no('loan', $loan_information->prefix, $loan_information->code)
                    }}</p>
                                        <p style="margin-top: -15px">Loan Amt : {{$due_and_payment_status['main_total']}} Taka</p>
                                        <p style="margin-top: -15px">Interest Amt : {{$due_and_payment_status['main_interest']}} Taka</p>
                                        <p style="margin-top: -15px">Total Loan : {{$due_and_payment_status['main_grand_total']}} Taka</p>
                                        <p style="margin-top: -15px">Per Install: {{$loan_information->installment_total}} Taka</p>
                                        <p style="margin-top: -15px">Interest Rate : {{$loan_information->interest_rate}} %</p>

                                        <p style="margin-top: -15px">Install Start: {{carbonDate($loan_information->issue_date)}}</p>
                                        
                                    </td>
                                    <td class="text-center">

                                        <p style="margin-top: -5px">Loan Duration : {{$loan_information->loan_duration}} {{$loan_information->loan_duration_type}}</p>

                                        <p style="margin-top: -15px">Install interval : {{$loan_information->installment_duration}} {{$loan_information->installment_duration_type}}</p>
                                        <p style="margin-top: -15px">Total Install No : {{$loan_information->installment_no}}</p>
                                        <p style="margin-top: -15px">Paid Install No : {{$due_and_payment_status['paid_installment_no']}}</p>
                                        <p style="margin-top: -15px">Due Install No : {{$due_and_payment_status['due_installment_no']}}</p>
                                    </td>
                                    <td class="text-center">
                                        <p style="margin-top: -5px">Paid Loan : {{$due_and_payment_status['paid_total']}} Taka</p>
                                        <p style="margin-top: -15px">Paid Interest : {{$due_and_payment_status['paid_interest']}} Taka</p>
                                        <p style="margin-top: -15px">Total Paid Amt : {{$due_and_payment_status['paid_grand_total']}} Taka</p>
                                        <p style="margin-top: -15px">Total Due Amt : {{$due_and_payment_status['due_grand_total']}} Taka</p>
                                    </td>
                                    <td class="text-right">
                                        <p style="margin-top: -5px">Member Id : {{get_id_account_no('member',$member_information->prefix,$member_information->code)}}</p>
                                        <p style="margin-top: -15px">Name : {{$member_information->name_in_bangla}} </p>
                                        <p style="margin-top: -15px">Father : {{$member_information->father_name}} </p>
                                        <p style="margin-top: -15px">Mother : {{$member_information->mother_name}} </p>
                                        <p style="margin-top: -15px">Contact No : {{$member_information->contact_number}} </p>
                                        <p style="margin-top: -15px">Address : {{$member_information->present_address_line_1}},
                        {{$member_information->present_address_line_1}}, {{$member_information->present_city}},
                        {{$member_information->present_zipcode}} </p>
                                       
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
<div class="col-md-12 text-center mb-2"  style="margin-top:-35px">
                        <h5>Paid Installments</h5>
                    </div>
                    <div class="table-responsive border-dark ">
                        <table class="table table-bordered ">
                            <thead class="table-head-bg">
                               
                                <tr>
                                    <th>Sl No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Install No</th>
                                    <th scope="col">Loan</th>
                                    <th scope="col">Interest</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($due_and_payment_status['total_installment_times']>0)
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
                        <td>{{$transaction->no_of_paying_installment}}</td>
                        <td>{{$transaction->total_amt}}</td>
                        <td>{{$transaction->total_interest_amt}}</td>
                        <td>{{$transaction->grand_total_amt}}</td>
                    </tr>
                 @endforeach
                    <tr class="text-weight-bold">
                        <td colspan="2" class="text-center">Total Paid</td>
                        <td>{{$due_and_payment_status['total_installment_times']}}</td>
                        <td>{{$due_and_payment_status['paid_total']}}</td>
                        <td>{{$due_and_payment_status['paid_interest']}}</td>
                        <td>{{$due_and_payment_status['paid_grand_total']}}</td>
                    </tr>
                 @else
                 <tr>
                     <td colspan="6" align="center" class="text-danger">No Previous Installment Payment Found</td>
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
