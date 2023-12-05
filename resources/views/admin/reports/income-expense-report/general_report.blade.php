@extends('layouts.app', ['title' => _lang(($report_type =="INCOME GENERAL REPORT"?"Income ":"Expense"). 'General
Report'), 'modal' => 'lg'])


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
        <h1 data-placement="bottom" title='{{ $report_type =="INCOME GENERAL REPORT"?"Income ":"Expense" }} Report.'><i
                class="fa fa-universal-access mr-4"></i>
            {{_lang(' Report')}}</h1>
        <p>{{_lang(($report_type =="INCOME GENERAL REPORT"?"Income ":"Expense").' Report. Here you can See '.($report_type =="INCOME GENERAL REPORT"?"Income ":"Expense").'  Report')}}
        </p>
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
                           class="{{ $report_type =="INCOME GENERAL REPORT"?"bg-success ":"bg-danger" }} text-light">
                            <b>{{$report_type}}</b></h4>
                    </div>


                    <div class="row">
                        <div class="col-md-6 text-left">
                            <p style="margin:0px ;">
                                Report Of Date : <span class="ml-1">{{$dates['start_date']}}</span>

                                @if ($dates['both'])
                                <span class="badge badge-danger mx-2"> TO </span>
                                {{ $dates['end_date'] }}
                                @endif

                            </p>
                        </div>
                        <div class="col-md-6 text-right">
                            <p style="margin:0px;">Printing Date : <span></span> {{ date('d F, Y') }} </span></p>
                            <p style="margin:0px ; ">Time : <span></span>{{date('h:i:s A')}}</span></p>
                        </div>
                    </div>
                    {{-- <hr class="border-dark "> --}}


                    <hr>

                    <div class="table-responsive border-dark ">
                        <table class="table table-bordered ">
                            <thead class="table-head-bg">

                                <tr>
                                    <th>Sl No</th>
                                    <th scope="col">{{ $report_type =="INCOME GENERAL REPORT"?"Income ":"Expense"  }}
                                        Head</th>
                                    <th scope="col">{{ $report_type =="INCOME GENERAL REPORT"?"Income ":"Expense"  }}
                                        Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($total>0)
                                @php
                                $i = 0 ;
                                @endphp

                                @foreach ($head_amt as $key => $value)
                                @php
                                $i++;
                                @endphp
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{ $key }}</td>
                                    <td>{{ $value }}</td>
                                </tr>
                                @endforeach
                                <tr class="text-weight-bold">
                                    <td colspan="2" class="text-right">Total
                                        {{ $report_type =="INCOME GENERAL REPORT"?"Income ":"Expense"  }}</td>
                                    <td>{{$total}}</td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="3" align="center" class="text-danger">No
                                        {{ $report_type =="INCOME GENERAL REPORT"?"Income ":"Expense"  }} Found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                    </div>
                    <br><br>

                    <h5>In Words: {{ucwords(convert_number_to_words($total))}} Taka Only.</h5>
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
