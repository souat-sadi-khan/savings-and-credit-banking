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
        <h1 data-placement="bottom" title="Voucher Report.">{{--<i class="fa fa-universal-access mr-4"></i>--}}
            {{_lang('Voucher Report')}}</h1>
        <p>{{_lang('Voucher Report. Here you can See Voucher Reports')}}</p>
    </div>
    {{--<ul class="app-breadcrumb breadcrumb">
        {{ Breadcrumbs::render(($report_type == "DEBIT VOUCHER"?"debit":"credit").'-voucher') }}
    </ul>--}}
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
                    class="{{$report_type == "DEBIT VOUCHER"?'bg-danger':'bg-success'}} text-light">
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
                                <tr>
                                    <th scope="col" style="width: 80px;">Sl No</th>
                                    <th scope="col">Credit Head</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($head_amt['found'])
                                @php
                                    $i = 0 ;
                                @endphp

                                @foreach ($head_amt as $key => $value)
                                    @if ($value > 0 && $key != 'total' && $key !='found')
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$key}}</td>
                                            <td>{{number_format ( $value,2)}}</td>
                                        </tr>
                                    @endif

                                @endforeach
                                <tr>
                                <td colspan="2" align="right">Total {{$report_type == 'DEBIT VOUCHER'?'Debit':'Credit'}}</td>
                                    <td style="text-align:left">{{number_format ( $head_amt['total'],2)}}</td>

                                </tr>
                                @else
                                <tr>
                                    <td colspan="3" align="center" style="color:red">No Record Found</td>
                                </tr>
                                @endif



                            </tbody>
                        </table>

                    </div>
                    <br><br>
                    <h5>In Words: {{ucwords($head_amt['In Word'])}} Taka Only.</h5>
                    <br><br><br>

                    <div class="row">
                        <div class="col-md-4 text-center">
                            <hr class="border-dark">
                            <p> Prepered By </p>
                        </div>
                        <div class="col-md-4 text-center">
                            <hr class="border-dark">
                            <p> Officer </p>
                        </div>
                        <div class="col-md-4 text-center">
                            <hr class="border-dark">
                            <p> Officer </p>
                        </div>
                    </div>


                </div>
                <div class="text-center">
                    @if ($head_amt['found'])


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
