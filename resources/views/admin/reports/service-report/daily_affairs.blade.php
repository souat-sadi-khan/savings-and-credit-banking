@extends('layouts.app', ['title' => _lang('Daily Report'), 'modal' => 'lg'])


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
        <h1 data-placement="bottom" title="Daily Report.">{{--<i class="fa fa-universal-access mr-4"></i>--}}
            {{_lang('Daily Report')}}</h1>
        <p>{{_lang('Daily Report. Here you can See Daily Report')}}</p>
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
                            class="bg-success text-light">
                            <b>{{$report_type}}</b></h4>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>

                                        <p style="margin:0px ; margin-top: -8px;">

                                            Report Of Date : <span class="ml-1">{{$report_date}}</span>

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
                                <tr>
                                    <th scope="col">Liabilities</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Assets</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < $row_no; $i++)
                                    <tr>
                                        {{-- first two data is for liability --}}
                                        @if ($i < $liability_length)
                                            <td>
                                                {{ $liability_keys[$i] }}
                                            </td>
                                            <td>
                                               {{ $liability_head_amt[$liability_keys[$i]] }}
                                            </td>
                                            @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                        {{-- the second two rows for assets --}}
                                          @if ($i < $asset_length)
                                            <td>
                                                {{ $asset_keys[$i] }}
                                            </td>
                                            <td>
                                               {{ $asset_head_amt[$asset_keys[$i]] }}
                                            </td>
                                            @else
                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                    @endfor

                                    <tr class="">
                                        <td class="text-right"><b>Total Amount</b></td>
                                        <td>
                                            {{ $total_liability }}
                                        </td>
                                        <td class="text-right"><b>Total Amount</b></td>
                                        <td>
                                            {{ $total_asset }}
                                        </td>
                                    </tr>



                            </tbody>
                        </table>

                    </div>
                    <br><br>
                    {{-- <h5>In Words: {{ucwords($head_amt['In Word'])}} Taka Only.</h5> --}}
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
<script src="{{ asset('js/pages/daily_report.js') }}"></script>
@endpush
