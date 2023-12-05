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
                            class="{{ ($loan_collect_confirmation == false && $loan_provid_confirmation == true) ?'bg-danger':'bg-success'}} text-light">
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
                                @if ($report_type == 'LOAN PROVIDED & COLLECTED')
                                <tr>
                                    <th scope="col" colspan="5" class="text-center bg-white text-dark">Loan Collected</th>
                                    <th scope="col" colspan="5"  class="text-center bg-white text-dark">Loan Provided</th>
                                </tr>
                                <tr>

                                    <th scope="col">Loan AC</th>
                                    <th scope="col">Member ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Amount</th>

                                    <th scope="col">Loan AC</th>
                                    <th scope="col">Member ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Amount</th>
                                </tr>
                                @else
                                <tr>
                                    <th>Sl No</th>
                                    <th scope="col">Loan AC</th>
                                    <th scope="col">Member ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Amount</th>
                                </tr>
                                @endif
                            </thead>
                            <tbody>
                                @if ($report_type != 'LOAN PROVIDED & COLLECTED' )
                                @php
                                $i = 0 ;
                                @endphp
                                @if ($total > 0)
                                @foreach ($info as $inf)
                                @if ($total > 0)
                                <tr>
                                    <td>{{++$i}}</td>
                                    {{-- {{ dd($inf->loan_acc) }} --}}
                                    <td>{{get_id_account_no('loan',  $inf->loan_acc?$inf->loan_acc->prefix:'',  $inf->loan_acc?$inf->loan_acc->code:'')}}
                                    </td>
                                    <td>{{get_id_account_no('member', $inf->member?$inf->member->prefix:'', $inf->member?$inf->member->code:'')}}
                                    </td>
                                    <td>{{$inf->member?$inf->member->name_in_bangla:''}}  </td>
                                    <td>{{carbonDate($inf->tx_date)}}</td>
                                    @if ($report_type == 'LOAN PROVIDED')
                                    <td>{{number_format ( $inf->total_amt,2)}}</td>
                                    @else
                                    <td>{{number_format ( $inf->grand_total_amt,2)}}</td>
                                    @endif
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
                                    @if($i<$no_of_collection) <td>
                                        {{get_id_account_no('loan',  $loan_collected[$i]->loan_acc?$loan_collected[$i]->loan_acc->prefix:'',  $loan_collected[$i]->loan_acc?$loan_collected[$i]->loan_acc->code:'')}}
                                        </td>

                                        <td>{{get_id_account_no('member', $loan_collected[$i]->member?$loan_collected[$i]->member->prefix:'', $loan_collected[$i]->member?$loan_collected[$i]->member->code:'')}}
                                        </td>
                                        <td>{{$loan_collected[$i]->member?$loan_collected[$i]->member->name_in_bangla:''}}  </td>
                                        <td>{{carbonDate($loan_collected[$i]->tx_date)}}</td>
                                        <td>{{number_format ( $loan_collected[$i]->grand_total_amt,2)}}</td>
                                        @else
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        @endif
                                        @if($i<$no_of_provided) <td>
                                            {{get_id_account_no('loan',  $loan_provided[$i]->loan_acc?$loan_provided[$i]->loan_acc->prefix:'',  $loan_provided[$i]->loan_acc?$loan_provided[$i]->loan_acc->code:'')}}
                                            </td>
                                            <td>{{get_id_account_no('member', $loan_provided[$i]->member?$loan_provided[$i]->member->prefix:'', $loan_provided[$i]->member?$loan_provided[$i]->member->code:'')}}
                                            </td>
                                            <td>{{$loan_provided[$i]->member?$loan_provided[$i]->member->name_in_bangla:''}}  </td>
                                            <td>{{carbonDate($loan_provided[$i]->tx_date)}}</td>
                                            <td>{{number_format ( $loan_provided[$i]->total_amt,2)}}</td>
                                            @else
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            @endif

                                            </tr>
                                            @endfor
                                             @if ($total_collected || $total_provided)
                                                 <tr>
                                                    <td colspan="4" class="text-right tex-bold">Total Collected</td>
                                                    <td>{{ $total_collected   }}</td>
    
                                                    <td colspan="4" class="text-right tex-bold">Total Provided</td>
                                                    <td>{{ $total_provided  }}</td>
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
                    @if ($report_type != 'LOAN PROVIDED & COLLECTED')

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
