@extends('layouts.app', ['title' => _lang('Income & Expense Report'), 'modal' => 'lg'])


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
        <h1 data-placement="bottom" title="Member\'s Report."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Income & Expense Report')}}</h1>
        <p>{{_lang('Income & Expense Report. Here you can See Income & Expense Reports')}}</p>
    </div>
    {{-- <ul class="app-breadcrumb breadcrumb">
        {{ Breadcrumbs::render('voucher-report') }}
    </ul> --}}
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
                                    <p class="mb-0"> INCOME GENERAL
                                    </p>
                                    <p>
                                        REPORT

                                    </p>
                                </div>
                            </div>
                            <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title=""
                                data-toggle="modal" data-target="#productModal"
                                data-original-title="View Income General Report" data-url="{{ route('admin.income-expense-report.edit','INCOME GENERAL REPORT') }}" id="content_managment">
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
                                   <p class="mb-0">
                                        HEAD WISE 
                                    </p>
                                    <p>
                                        INCOME REPORT

                                   </p>
                                </div>
                            </div>
                            <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title=""
                                data-toggle="modal" data-target="#productModal"
                                data-original-title="View Head Wise Income Report" data-url="{{ route('admin.income-expense-report.edit','HEAD WISE INCOME REPORT') }}" id="content_managment">
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
                                   <p class="mb-0">
                                       EXPENSE GENERAL 
                                   </P>
                                   <P> REPORT</P>

                                </div>
                            </div>
                            <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title=""
                                data-toggle="modal" data-target="#sellsModal" data-original-title="View Expense General Report" data-url="{{ route('admin.income-expense-report.edit','EXPENSE GENERAL REPORT') }}" id="content_managment">
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
                                       HEAD WISE  
                                    </P>
                                    <P>EXPENSE REPORT</P>

                                </div>
                            </div>
                            <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title=""
                                data-toggle="modal" data-target="#sellsModal" data-original-title="View Head Wise Expense Report Report"  data-url="{{ route('admin.income-expense-report.edit','HEAD WISE EXPENSE REPORT') }}" id="content_managment">
                                View Report
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

                    {{-- :::::::::  NEW CARD    :::::::::::: --}}
                    <div class="col-md-4 mt-3">
                        <div class="tile-box tile-box-alt bg-khoyri rounded">
                            <div class="tile-content-wrapper">
                                <i class="glyph-icon fa fa-cubes"></i>
                                <div class="tile-content">
                                     <p class="mb-0"> INCOME VS
                                     </P>
                                     <P> EXPENSE</P>
                                </div>
                            </div>
                            <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title=""
                                data-toggle="modal" data-target="#productModal"
                                data-original-title="View Income Vs Expense Report" data-url="{{ route('admin.income-expense-report.edit','INCOME VS EXPENSE REPORT') }}" id="content_managment">
                                View Report
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>

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
<script src="{{ asset('js/pages/member_report.js') }}"></script>
@endpush