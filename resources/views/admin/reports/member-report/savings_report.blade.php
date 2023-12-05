@extends('layouts.app', ['title' => _lang('Member\'s DPS Report'), 'modal' => 'lg'])


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
        <h1 data-placement="bottom" title="Member\'s DPS Report."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Member\'s DPS Report')}}</h1>
        <p>{{_lang('Member\'s DPS Report. Here you can See Member\'s DPS Report')}}</p>
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
                                        <p style="margin-top:-5px">Savings AC : {{ get_id_account_no('savings', $sav_acc_info->prefix, $sav_acc_info->code) }}</p>
                                      
                                        <p style="margin-top: -15px">Total Deposit : {{$payment_status['total_deposit']}} Tk</p>
                                        <p style="margin-top: -15px">Interest Withdraw : {{$payment_status['interest_withdraw']}} Tk</p>
                                        <p style="margin-top: -15px">Savings Withdraw : {{$payment_status['savings_withdraw']}} Tk</p>
                                        <p style="margin-top: -15px">Total Withdraw : {{$payment_status['total_withdraw']}} Tk</p>
                                        <p style="margin-top: -15px">Total Savings: {{$payment_status['currntly_in_hand']}} Tk</p>
                                        
                                        
                                        
                                    </td>
                                    <td class="text-center">
                                    {{-- <p style="margin-top: -5px">Interest Rate : {{$sav_acc_info->interest_rate}} %</p> --}}

                                        <p style="margin-top: -5px">Deposit : {{ $payment_status['deposit_times']}} Times</p>
                                        <p style="margin-top: -15px">Withdraw : {{$payment_status['withdraw_times']}} Times</p>

                                        <p style="margin-top: -15px">Opening Date : {{carbonDate($sav_acc_info->total_interest_amt)}}</p>
                                       
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
<div class="col-md-12 text-center mb-2" style="margin-top:-25px">
                        <h5>DEPOSIT & WITHDRAW</h5>
                    </div>
                    <div class="table-responsive border-dark ">
                        <table class="table table-bordered ">
                            <thead class="table-head-bg">
                               <tr>
                                    <th scope="col" colspan="3" class="text-center bg-white text-dark">Deposit</th>
                                    <th scope="col" colspan="4"  class="text-center bg-white text-dark">Withdraw</th>
                                </tr>
                                <tr>
                                    <th>Sl No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Deposit Amt</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Interest</th>
                                    <th scope="col">Savings</th>
                                    <th scope="col">Total Withdraw</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($payment_status['deposit_times']>0 ||  $payment_status['withdraw_times'])
                 @php
                 $i = 0 ;
                 @endphp
              
                 @for ($i = 0; $i < $payment_status['max_row']; $i++)
                    <tr>
                        <td>{{ $i+1 }}</td>
                    @if ($i<$payment_status['deposit_times'])
                        <td>{{carbonDate($deposit_info[$i]->tx_date)}}</td>
                        <td>{{$deposit_info[$i]->grand_total_amt}}</td>
                    @else
                        <td colspan="2"></td>
                    @endif
                    @if ($i<$payment_status['withdraw_times'])
                        <td>{{carbonDate($withdraw_info[$i]->tx_date)}}</td>
                        <td>{{$withdraw_info[$i]->total_interest_amt}}</td>
                        <td>{{$withdraw_info[$i]->total_amt}}</td>
                        <td>{{$withdraw_info[$i]->grand_total_amt}}</td>
                    @else
                        <td colspan="4"></td>
                    @endif
                    </tr>
                     
                 @endfor
                    <tr class="text-weight-bold">
                        <td colspan="2" class="text-right">Total Deposit</td>
                        <td>{{$payment_status['total_deposit']}}</td>
                        <td  colspan="3" class="text-right">Total Withdraw</td>
                        <td>{{$payment_status['total_withdraw']}}</td>
                    </tr>
                 @else
                 <tr>
                     <td colspan="7" align="center" class="text-danger">No Previous Transactions Found</td>
                 </tr>
                 @endif
                            </tbody>
                        </table>

                    </div>
                    <br><br>

                    {{-- <h5>In Words:  {{ucwords(convert_number_to_words())}} Tk Only.</h5> --}}
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
