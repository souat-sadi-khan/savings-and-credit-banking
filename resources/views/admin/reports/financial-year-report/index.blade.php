@extends('layouts.app', ['title' => _lang('Financial Year Report'), 'modal' => 'lg'])


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
        <h1 data-placement="bottom" title="Financial Year Report"><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Financial Year Report')}}</h1>
        <p>{{_lang('Financial Year Report. Here you can See Financial Year Reports')}}</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        {{-- {{ Breadcrumbs::render('financial-year-report') }} --}}
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

                <h4 class="text-center"> To Generate Report Just Click On <i> <span class="text-danger"> View Report</span></i></h4>
                <hr class="border-dark">
            </h3>
            <div class="tile-body">
                <div class="row">

                   

                         {{-- :::::::::  NEW CARD    :::::::::::: --}}
                    <div class="col-md-4 ">
                        <div class="tile-box tile-box-alt bg-black">
                            
                            <div class="tile-content-wrapper">
                                <i class="glyph-icon fa fa-money"></i>
                                <div class="tile-content">
                                    <p class="mb-0"> PROFIT </p>
                                    <p>AND LOSS</p>

                                </div>
                            </div>
                            <a href="{{ route('admin.financial-year-report.edit','PROFIT AND LOSS CALCULATION') }}" class="tile-footer tooltip-button" data-placement="bottom" title="VIEW PROFIT AND LOSS REPORT"data-original-title="View Profit & Loass Report"  >
                                View Report
                                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>


                    {{-- :::::::::  NEW CARD    :::::::::::: --}}
                    <div class="col-md-4">
                        <div class="tile-box tile-box-alt bg-olive">
                        
                            <div class="tile-content-wrapper">
                                <i class="glyph-icon fa fa-credit-card"></i>
                                <div class="tile-content">
                                    <p class="mb-0"> TRIAL  </p>
                                    <p>BALANCE</p>

                                </div>
                            </div>
                            <a href="{{ route('admin.financial-year-report.edit','TRIAL BALANCE') }}" class="tile-footer tooltip-button" data-placement="bottom" title="VIEW TRIAL BALANCE" data-original-title="View Trial Balance" >
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
<script src="{{ asset('js/pages/financial_year_report.js') }}"></script>
@endpush
