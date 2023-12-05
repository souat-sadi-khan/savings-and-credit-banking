@extends('layouts.app', ['title' => _lang('Savings Report'), 'modal' => 'lg'])


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
        <h1 data-placement="bottom" title="DPD Report."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Savings Report')}}</h1>
        <p>{{_lang('Savings Report. Here you can See Savings Report')}}</p>
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



                <br>
                <hr>

                <div id="print_table" style="color:black">
                    <span class="text-center">
                        <h3><b class="text-uppercase">{{$organization['name']}}</b></h3>
                        <h5>{{$organization['address']}}</h5>
                        <h6>{{$organization['phone']}},{{$organization['email']}}</h6>

                    </span>
                    <div class="text-center col-md-12">
                        <h4 style="margin:0px ; margin-top: 7px; border:solid 1px #000; border-radius:50px; display:inline-block; padding:10px;"
                            class="{{ ($savings_withdraw_confirmation == false && $savings_deposit_confirmation == true) ?'bg-danger':'bg-success'}} text-light">
                            <b>{{$report_type}}</b></h4>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>

                                        <p style="margin:0px ; margin-top: -8px;">

                                            Report Of Date : <span class="ml-1">{{$dates['start_date']}}</span>

                                            @if ($dates['both'])
                                            <span class="badge badge-danger mx-2"> TO </span>
                                            {{ $dates['end_date'] }}
                                            @endif

                                        </p>

                                    </td>
                                    <td class="text-center">

                                    </td>
                                    <td class="text-right">
                                        <p style="margin:0px ; margin-top: -8px;">Printing Date :
                                            <span></span> {{ date('d F, Y') }} </span></p>
                                        <p style="margin:0px ; margin-top: -4px;">Time :
                                            <span></span>{{date('h:i:s A')}}</span></p>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>


                    <div class="table-responsive border-dark">
                        <table class="table table-bordered ">
                            <thead class="table-head-bg">
                                @if ($report_type == 'SAVINGS DEPOSIT & WITHDRAW')
                                <tr>
                                    <th scope="col" colspan="5" class="text-center bg-white text-dark">Deposit</th>
                                    <th scope="col" colspan="7"  class="text-center bg-white text-dark">Withdraw</th>
                                </tr>
                                <tr>

                                    <th scope="col">Savings AC</th>
                                    <th scope="col">Member ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Amount</th>

                                    <th scope="col">Savings AC</th>
                                    <th scope="col">Member ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Interest</th>
                                    <th scope="col">Savings</th>
                                    <th scope="col">Total Amt</th>
                                </tr>
                                @else
                                <tr>
                                    <th>Sl No</th>
                                    <th scope="col">Savings AC</th>
                                    <th scope="col">Member ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    @if ($report_type == 'SAVINGS WITHDRAW')
                                        
                                    <th scope="col">Interest</th>
                                   <th scope="col">Savings</th>
                                    @endif
                                    <th scope="col">Total Amt</th>
                                </tr>
                                @endif
                            </thead>
                            <tbody>
                                @if ($report_type != 'SAVINGS DEPOSIT & WITHDRAW' )
                                @php
                                $i = 0 ;
                                @endphp
                                @if ($total > 0)
                                @foreach ($info as $inf)
                                @if ($total > 0)
                                <tr>
                                    <td>{{++$i}}</td>
                                    {{-- {{ dd($inf->member) }} --}}
                                    <td>{{get_id_account_no('savings',  $inf->savings_ac?$inf->savings_ac->prefix:'',  $inf->savings_ac?$inf->savings_ac->code:'')}}
                                    </td>
                                    <td>{{get_id_account_no('member', $inf->member?$inf->member->prefix:'', $inf->member?$inf->member->code:'')}}
                                    </td>
                                    <td>{{  $inf->member?$inf->member->name_in_bangla:'' }} </td>
                                    <td>{{carbonDate($inf->tx_date)}}</td>
                                    @if ($report_type == 'SAVINGS WITHDRAW' )
                                    <td>{{number_format ( $inf->total_interest_amt,2)}}</td>
                                    <td>{{number_format ( $inf->total_amt,2)}}</td>
                                    @endif
                                    <td>{{number_format ( $inf->grand_total_amt,2)}}</td>
                                </tr>
                                {{-- {{ dd($inf->member) }} --}}
                                @endif

                                @endforeach
                                <tr>
        
                                    <td colspan="{{ $report_type == 'SAVINGS WITHDRAW'?7:5 }}" align="right">Total</td>
                                    <td style="text-align:left">{{number_format ($total,2)}}</td>

                                </tr>
                                @else
                                <tr>
                                    <td colspan="{{ $report_type == 'SAVINGS WITHDRAW'?8:6 }}" align="center" style="color:red">No Record Found</td>
                                </tr>
                                @endif

                                @else
                                {{-- this section is for collection and provide --}}
                                @for ($i = 0; $i < $max_row; $i++) <tr>
                                    @if($i<$no_of_deposit) <td>
                                        {{get_id_account_no('savings',  $savings_deposited[$i]->savings_ac?$savings_deposited[$i]->savings_ac->prefix:'',  $savings_deposited[$i]->savings_ac?$savings_deposited[$i]->savings_ac->code:'')}}
                                        </td>

                                        <td>{{get_id_account_no('member', $savings_deposited[$i]->member?$savings_deposited[$i]->member->prefix:'', $savings_deposited[$i]->member?$savings_deposited[$i]->member->code:'')}}
                                        </td>
                                         <td>{{  $savings_deposited[$i]->member?$savings_deposited[$i]->member->name_in_bangla:'' }} </td>
                                        <td>{{carbonDate($savings_deposited[$i]->tx_date)}}</td>
                                        <td>{{number_format ( $savings_deposited[$i]->grand_total_amt,2)}}</td>
                                        @else
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        @endif
                                        @if($i<$no_of_withdraw) <td>
                                            {{get_id_account_no('savings',  $savings_withdrawed[$i]->savings_ac?$savings_withdrawed[$i]->savings_ac->prefix:'',  $savings_withdrawed[$i]->savings_ac?$savings_withdrawed[$i]->savings_ac->code:'')}}
                                            </td>
                                            <td>{{get_id_account_no('member', $savings_withdrawed[$i]->member?$savings_withdrawed[$i]->member->prefix:'', $savings_withdrawed[$i]->member?$savings_withdrawed[$i]->member->code:'')}}
                                            </td>
                                            <td>{{  $savings_withdrawed[$i]->member? $savings_withdrawed[$i]->member->name_in_bangla:'' }} </td>
                                            <td>{{carbonDate($savings_withdrawed[$i]->tx_date)}}</td>
                                         
                                            <td>{{number_format ( $savings_withdrawed[$i]->total_interest_amt,2)}}</td>
                                            <td>{{number_format ( $savings_withdrawed[$i]->total_amt,2)}}</td>
                                            <td>{{number_format ( $savings_withdrawed[$i]->grand_total_amt,2)}}</td>
                                            @else
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            @endif

                                            </tr>
                                            @endfor
                                             @if ($total_deposit || $total_withdraw)
                                                 <tr>
                                                    <td colspan="4" class="text-right tex-bold">Total Collected</td>
                                                    <td>{{ $total_deposit   }}</td>
    
                                                    <td colspan="6" class="text-right tex-bold">Total Withdraw</td>
                                                    <td>{{ $total_withdraw  }}</td>
                                                </tr>
                                                @else 
                                                <tr>
                                                    <td colspan="12" align="center" style="color:red">No Record Found</td>
                                                </tr>
                                             @endif
                                            @endif
                                               



                            </tbody>
                        </table>

                    </div>
                    <br><br>
                    @if ($report_type != 'SAVINGS DEPOSIT & WITHDRAW')

                    <h5>In Words: {{ucwords($in_word)}} Taka Only.</h5>
                    @endif
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
