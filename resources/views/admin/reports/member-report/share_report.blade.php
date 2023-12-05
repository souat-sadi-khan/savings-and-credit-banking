@extends('layouts.app', ['title' => _lang('Member\'s Share Report'), 'modal' => 'lg'])


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
        <h1 data-placement="bottom" title="Member\'s Share Report."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Member\'s Share Report')}}</h1>
        <p>{{_lang('Member\'s Share Report. Here you can See Member\'s Share Report')}}</p>
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
                                        <p style="margin-top:-5px">Share AC : {{ $share_id }}</p>
                                        <p style="margin-top: -15px">Total Deposit  : {{ $current_share_info['total_deposit'] }} Tk</p>
                                        <p style="margin-top: -15px">Interest Withdraw  : {{ $current_share_info['interest_withdraw'] }} Tk</p>
                                        <p style="margin-top: -15px">Savings Withdraw  : {{ $current_share_info['savings_withdraw'] }} Tk</p>
                                        <p style="margin-top: -15px">Total Withdraw : {{ $current_share_info['total_withdraw'] }} Tk</p>
                                        <p style="margin-top: -15px">In Hand : {{ $current_share_info['in_hand'] }} Tk</p>
                                        
                                        
                                    </td>

                                    <td class="text-right">
                                    <p style="margin-top: -5px">Deposit : {{ $current_share_info['deposit_times'] }} Times</p>

                                        <p style="margin-top: -15px">Withdraw: {{ $current_share_info['withdraw_times'] }} Times</p>
                                        <p style="margin-top: -15px">Creation Date: {{carbonDate($member->created_at)}}</p>
                                    </td>

                                           <td class="text-right">
                                        <p style="margin-top: -5px">Member Id : {{get_id_account_no('member',$member->prefix,$member->code)}}</p>
                                        <p style="margin-top: -15px">Name : {{$member->name_in_bangla}} </p>
                                        <p style="margin-top: -15px">Father : {{$member->father_name}} </p>
                                        <p style="margin-top: -15px">Mother : {{$member->mother_name}} </p>
                                        <p style="margin-top: -15px">Contact No : {{$member->contact_number}} </p>
                                        <p style="margin-top: -15px">Address : {{$member->present_address_line_1}},
                        {{$member->present_address_line_1}}, {{$member->present_city}},
                        {{$member->present_zipcode}} </p>
                                       
                                    </td>
                                 
                                    {{-- <td class="text-right">
                                        <p style="margin-top: -5px">Member Id : {{get_id_account_no('member',$member->prefix,$member->code)}}</p>
                                        <p style="margin-top: -15px">Name : {{$member->name_in_bangla}} </p>
                                        <p style="margin-top: -15px">Father : {{$member->father_name}} </p>
                                        <p style="margin-top: -15px">Mother : {{$member->mother_name}} </p>
                                        <p style="margin-top: -15px">Contact No : {{$member->contact_number}} </p>
                                        <p style="margin-top: -15px">Address : {{$member->present_address_line_1}},
                        {{$member->present_address_line_1}}, {{$member->present_city}},
                        {{$member->present_zipcode}} </p>
                                       
                                    </td> --}}
                                </tr>

                            </tbody>
                        </table>
                    </div>
<div class="col-md-12 text-center mb-2"  style="margin-top:-35px">
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
                                @if ($current_share_info['deposit_times']>0 ||  $current_share_info['withdraw_times'])
                 @php
                 $i = 0 ;
                 @endphp
              
                 @for ($i = 0; $i < $current_share_info['max_row']; $i++)
                    <tr>
                        <td>{{ $i+1 }}</td>
                    @if ($i<$current_share_info['deposit_times'])
                        <td>{{carbonDate($current_share_info['deposit_info'][$i]->tx_date)}}</td>
                        <td>{{$current_share_info['deposit_info'][$i]->grand_total_amt}}</td>
                    @else
                        <td colspan="2"></td>
                    @endif
                    @if ($i<$current_share_info['withdraw_times'])
                        <td>{{carbonDate($current_share_info['withdraw_info'][$i]->tx_date)}}</td>
                        <td>{{$current_share_info['withdraw_info'][$i]->total_interest_amt}}</td>
                        <td>{{$current_share_info['withdraw_info'][$i]->total_amt}}</td>
                        <td>{{$current_share_info['withdraw_info'][$i]->grand_total_amt}}</td>
                    @else
                        <td colspan="4"></td>
                    @endif
                    </tr>
                     
                 @endfor
                    <tr class="text-weight-bold">
                        <td colspan="2" class="text-right">Total Deposit</td>
                        <td>{{$current_share_info['total_deposit']}}</td>
                        <td colspan="3" class="text-right">Total Withdraw</td>
                        <td>{{$current_share_info['total_withdraw']}}</td>
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
