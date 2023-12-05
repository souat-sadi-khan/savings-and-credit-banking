@extends('layouts.app', ['title' => _lang('All Transaction Report'), 'modal' => 'lg'])


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
        <h1 data-placement="bottom" title="All Transaction Report."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('All Transaction Report')}}</h1>
        <p>{{_lang('All Transaction Report. Here you can See All Transaction Reports')}}</p>
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
                         <div class="col-md-4"></div>     
                                   <div class="col-md-4 text-center">
                        <div class="tile-box tile-box-alt bg-primary rounded">
                            <div class="tile-header">

                            </div>
                            <div class="tile-content-wrapper">
                                <i class="glyph-icon fa fa-cubes"></i>
                                <div class="tile-content">
                                    <p class="text-uppercase mb-0"> All Transaction
                                    </p>
                                    <p class="text-uppercase mb-0"> Report</p>
                                </div>
                            </div>
                            <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title=""
                                data-toggle="modal" data-target="#productModal"
                                data-original-title="View Bank All Transaction Report" data-url="{{ route('admin.all-tx-report.edit','ALL TRANSACTION REPORT') }}" id="content_managment">
                                View Report
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    <div class="col-md-4"></div>

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