@extends('layouts.app', ['title' => _lang('Voucher Report'), 'modal' => 'lg'])


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
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Cash Position Memo.">{{--<i class="fa fa-universal-access mr-4"></i>--}}
            {{_lang('Cash Position Memo')}}</h1>
        <p>{{_lang('Cash Position Memo. Here you can See Cash Position Memo')}}</p>
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
                    class="{{ $head_amt['Cash In Hand'] < 0 ?'bg-danger':'bg-success'}} text-light">
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

                            </thead>
                            <tbody>
                                @if ($head_amt['found'])

                                    <tr>
                                        <td>Opening Balance</td>
                                        <td> {{number_format ( $head_amt['Opening Balance'],2)}}</td>
                                    </tr>

                                    <tr>
                                        <td>Total Credit Amount</td>
                                        <td> {{number_format ( $head_amt['Total Credit'],2)}}</td>
                                    </tr>

                                    <tr>
                                        <td>Total Debit Amount</td>
                                        <td> {{number_format ( $head_amt['Total Debit'],2)}}</td>
                                    </tr>

                                    <tr>
                                        <td>Cash In Hand</td>
                                        <td> {{number_format ( $head_amt['Cash In Hand'],2)}}</td>
                                    </tr>

                                @else
                                <tr>
                                    <td colspan="2" align="center" style="color:red">No Record Found</td>
                                </tr>
                                @endif



                            </tbody>
                        </table>

                    </div>
                    <br><br>
                <h5>In Words: {{ucwords($head_amt['In Word'])}} Taka Only.</h5>
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
                    @if ($head_amt['Cash In Hand'])


                    @php
                    $print_table = 'print_table';

                    @endphp

                    <a class="text-light btn-primary btn" onclick="printContent('{{ $print_table }}')" name="print"
                        id="print_receipt">
                        <i class="fa fa-print" aria-hidden="true"></i>
                        {{_lang('Print Voucher')}}

                    </a>
                    @endif
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
