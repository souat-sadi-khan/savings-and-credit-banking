@extends('layouts.app', ['title' => _lang('Double Benifit Report'), 'modal' => 'lg'])


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
        <h1 data-placement="bottom" title="Double Benifit Report."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Double Benifit Report')}}</h1>
        <p>{{_lang('Double Benifit Report. Here you can See Double Benifit Report')}}</p>
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
                            class="{{ ($double_benifit_withdraw_confirmation == false && $double_benifit_deposit_confirmation == true) ?'bg-danger':'bg-success'}} text-light">
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
                                @if ($report_type == 'DOUBLE BENEFIT DEPOSIT & WITHDRAW')
                                <tr>
                                    <th scope="col" colspan="5" class="text-center bg-white text-dark">Deposit</th>
                                    <th scope="col" colspan="5"  class="text-center bg-white text-dark">Withdraw</th>
                                </tr>
                                <tr>

                                    <th scope="col">Double Benefit AC</th>
                                    <th scope="col">Member ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Amount</th>

                                    <th scope="col">Double Benefit AC</th>
                                    <th scope="col">Member ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Amount</th>
                                </tr>
                                @else
                                <tr>
                                    <th>Sl No</th>
                                    <th scope="col">Double Benefit AC</th>
                                    <th scope="col">Member ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Amount</th>
                                </tr>
                                @endif
                            </thead>
                            <tbody>
                                @if ($report_type != 'DOUBLE BENEFIT DEPOSIT & WITHDRAW' )
                                @php
                                $i = 0 ;
                                @endphp
                                @if ($total > 0)
                                @foreach ($info as $inf)
                                @if ($total > 0)
                                <tr>
                                    <td>{{++$i}}</td>
                                    {{-- {{ dd($inf->double_benifit_acc) }} --}}
                                    <td>{{get_id_account_no('double_benifit',  $inf->double_benifit_acc?$inf->double_benifit_acc->prefix:'',  $inf->double_benifit_acc?$inf->double_benifit_acc->code:'')}}
                                    </td>
                                    <td>{{get_id_account_no('member', $inf->member?$inf->member->prefix:'', $inf->member?$inf->member->code:'')}}
                                    </td>
                                    <td>{{ $inf->member?$inf->member->name_in_bangla:''}}  </td>
                                    <td>{{carbonDate($inf->tx_date)}}</td>
                                    <td>{{number_format ( $inf->grand_total_amt,2)}}</td>
                                </tr>
                                @endif

                                @endforeach
                                <tr>

                                    <td colspan="5" align="right">Total</td>
                                    <td style="text-align:left">{{number_format ($total,2)}}</td>

                                </tr>
                                @else
                                <tr>
                                    <td colspan="6" align="center" style="color:red">No Record Found</td>
                                </tr>
                                @endif

                                @else
                                {{-- this section is for collection and provide --}}
                                @for ($i = 0; $i < $max_row; $i++) <tr>
                                    @if($i<$no_of_deposit) <td>
                                        {{get_id_account_no('double_benifit',  $double_benifit_deposited[$i]->double_benifit_acc?$double_benifit_deposited[$i]->double_benifit_acc->prefix:'',  $double_benifit_deposited[$i]->double_benifit_acc?$double_benifit_deposited[$i]->double_benifit_acc->code:'')}}
                                        </td>

                                        <td>{{get_id_account_no('member', $double_benifit_deposited[$i]->member?$double_benifit_deposited[$i]->member->prefix:'', $double_benifit_deposited[$i]->member?$double_benifit_deposited[$i]->member->code:'')}}
                                        </td>
                                    <td>{{ $double_benifit_deposited[$i]->member?$double_benifit_deposited[$i]->member->name_in_bangla:''}}  </td>

                                        <td>{{carbonDate($double_benifit_deposited[$i]->tx_date)}}</td>
                                        <td>{{number_format ( $double_benifit_deposited[$i]->grand_total_amt,2)}}</td>
                                        @else
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        @endif
                                        @if($i<$no_of_withdraw) <td>
                                            {{get_id_account_no('double_benifit',  $double_benifit_withdrawed[$i]->double_benifit_acc?$double_benifit_withdrawed[$i]->double_benifit_acc->prefix:'',  $double_benifit_withdrawed[$i]->double_benifit_acc?$double_benifit_withdrawed[$i]->double_benifit_acc->code:'')}}
                                            </td>
                                            <td>{{get_id_account_no('member', $double_benifit_withdrawed[$i]->member?$double_benifit_withdrawed[$i]->member->prefix:'', $double_benifit_withdrawed[$i]->member?$double_benifit_withdrawed[$i]->member->code:'')}}
                                            </td>
                                                 <td>{{ $double_benifit_withdrawed[$i]->member?$double_benifit_withdrawed[$i]->member->name_in_bangla:''}}  </td>
                                            
                                            <td>{{carbonDate($double_benifit_withdrawed[$i]->tx_date)}}</td>
                                            <td>{{number_format ( $double_benifit_withdrawed[$i]->grand_total_amt,2)}}</td>
                                            @else
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
    
                                                    <td colspan="4" class="text-right tex-bold">Total Withdraw</td>
                                                    <td>{{ $total_withdraw  }}</td>
                                                </tr>
                                                @else 
                                                <tr>
                                                    <td colspan="10" align="center" style="color:red">No Record Found</td>
                                                </tr>
                                             @endif
                                            @endif
                                               



                            </tbody>
                        </table>

                    </div>
                    <br><br>
                    @if ($report_type != 'DOUBLE BENEFIT DEPOSIT & WITHDRAW')

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