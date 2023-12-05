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
        {{ Breadcrumbs::render('voucher-report') }}
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

                <h4 class="text-center"> To Generate Report Just Click On <i> <span class="text-danger"> View Report</span></i></h4>
                <hr class="border-dark">
            </h3>
            <div class="tile-body">
                <div class="row">

                     {{-- :::::::::  NEW CARD    :::::::::::: --}}
                    <div class="col-md-4">
                        <div class="tile-box tile-box-alt bg-primary rounded">
                            <div class="tile-content-wrapper">
                                <i class="glyph-icon fa fa-cubes"></i>
                                <div class="tile-content">
                                    <p class="mb-0"> CASH POSITION </p>
                                    <p>  MEMO </p>
                                </div>
                            </div>
                            <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title=""
                                data-toggle="modal" data-target="#productModal"
                                data-original-title="View Cash Position Memo" data-url="{{ route('admin.voucher-report.edit','CASH POSITION MEMO') }}" id="content_managment">
                                View Report
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                     {{-- :::::::::  NEW CARD    :::::::::::: --}}
                    <div class="col-md-4">
                        <div class="tile-box tile-box-alt bg-purple">
                            <div class="tile-content-wrapper">
                                <i class="glyph-icon fa fa-bar-chart"></i>
                                <div class="tile-content">
                                    <p class="mb-0"> CREDIT  </p>
                                    <p>  VOUCHER </p>
                                </div>
                            </div>
                            <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title=""
                                data-toggle="modal" data-target="#purchaseModal"
                                data-original-title="View Credit Voucher" data-url="{{ route('admin.voucher-report.edit','CREDIT VOUCHER') }}" id="content_managment">
                                View Report
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                     {{-- :::::::::  NEW CARD    :::::::::::: --}}
                    <div class="col-md-4">
                        <div class="tile-box tile-box-alt bg-blue">
                            <div class="tile-content-wrapper">
                                <i class="glyph-icon fa fa-telegram"></i>
                                <div class="tile-content">
                                    <p class="mb-0"> DEBIT </p>
<p> VOUCHER </p>
                                </div>
                            </div>
                            <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title=""
                                data-toggle="modal" data-target="#sellsModal" data-original-title="View Sales Report" data-url="{{ route('admin.voucher-report.edit','DEBIT VOUCHER') }}" id="content_managment">
                                View Report
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                     {{-- :::::::::  NEW CARD    :::::::::::: --}}
                    <div class="col-md-4 mt-3">
                        <div class="tile-box tile-box-alt bg-black">
                            <div class="tile-content-wrapper">
                                <i class="glyph-icon fa fa-money"></i>
                                <div class="tile-content">
                                    <p class="mb-0">
                                       SUPPLIMENTARY  
                                    </p>
                                    <p>  CREDIT </p>

                                </div>
                            </div>
                            <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title=""
                                data-toggle="modal" data-target="#sellsModal" data-original-title="View Sales Report"  data-url="{{ route('admin.voucher-report.edit','SUPPLIMENTARY CREDIT VOUCHER') }}" id="content_managment">
                                View Report
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                    {{-- :::::::::  NEW CARD    :::::::::::: --}}
                    <div class="col-md-4 mt-3">
                        <div class="tile-box tile-box-alt bg-olive">
                            <div class="tile-content-wrapper">
                                <i class="glyph-icon fa fa-credit-card"></i>
                                <div class="tile-content">
                                    <p class="mb-0">
                                        SUPPLIMENTARY
                                    </p>

                                    <p>  DEBIT </p>

                                </div>
                            </div>
                            <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title=""
                                data-toggle="modal" data-target="#sellsModal" data-original-title="View Sales Report" data-url="{{ route('admin.voucher-report.edit','SUPPLIMENTARY DEBIT VOUCHER') }}" id="content_managment">
                                View Report
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                    {{-- <div class="col-md-4 mt-3">
                        <div class="tile-box tile-box-alt bg-khoyri">
                            <div class="tile-header">

                            </div>
                            <div class="tile-content-wrapper">
                                <i class="glyph-icon fa fa-balance-scale"></i>
                                <div class="tile-content">
                                    <span>
                                        Sales
                                        <small>Report</small>
                                    </span>

                                </div>
                            </div>
                            <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title=""
                                data-toggle="modal" data-target="#sellsModal" data-original-title="View Sales Report">
                                View Report
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div> --}}

                </div>

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
