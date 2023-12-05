@extends('layouts.app', ['title' => _lang('Daily Report'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
    <div class="app-title text-center bg-danger text-white">
        <div class="text-center w-100">
            <h1 data-placement="bottom" title="Daily Report.">{{--<i class="fa fa-universal-access mr-4"></i>--}} {{_lang('Daily Report')}}</h1>
            <p>{{_lang('Daily Report. Here you can See Daily Transaction Reports')}}</p>
        </div>
        {{--<ul class="app-breadcrumb breadcrumb">
            {{ Breadcrumbs::render('daily-report') }}
        </ul>--}}
    </div>
@stop

{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                
                <div class="tile-body">
                    <div class="row">
                     {{-- :::::::::  NEW CARD    :::::::::::: --}}
                    <div class="col-md-4 mt-3">
                        <div class="tile-box tile-box-alt bg-purple">
                            <div class="tile-content-wrapper">
                                <i class="glyph-icon fa fa-bar-chart"></i>
                                <div class="tile-content">
                                    <p class="mb-0"> DAILY STATEMENT  </p>
                                    <p> OF AFFAIRS</p>
                                </div>
                            </div>
                            <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title=""
                                data-toggle="modal" data-target="#purchaseModal"
                                data-original-title="View Credit Voucher" data-url="{{ route('admin.daily-report.edit','DAILY STATEMENT OF AFFAIRS') }}" id="content_managment">
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
                                    <p class="mb-0">DAILY COLLECTION  </p>
<p> SHEET OF LOAN  </p>
                                </div>
                            </div>

                            <a href="#" class="tile-footer tooltip-button" data-placement="bottom" title=""
                                data-toggle="modal" data-target="#sellsModal" data-original-title="View Sales Report"  data-url="{{ route('admin.daily-report.edit','DAILY COLLECTION SHEET OF LOAN') }}" id="content_managment">
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
    <script src="{{ asset('js/pages/daily_report.js') }}"></script>
@endpush

