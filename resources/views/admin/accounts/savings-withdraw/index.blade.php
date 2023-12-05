@extends('layouts.app', ['title' => _lang('Withdraw Of Savings'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
    <div class="app-title text-center bg-danger text-white">
        <div class="text-center w-100">
            <h1 data-placement="bottom" title="Withdraw Of Savings.">{{--<i class="fa fa-universal-access mr-4"></i>--}} {{_lang('Withdraw Of Savings')}}</h1>
            <p>{{_lang('Create Withdraw Of Savings. Here you can Add, Edit & Delete The Withdraw Of Savingss')}}</p>
        </div>
       {{-- <ul class="app-breadcrumb breadcrumb">
            {{ Breadcrumbs::render('savings-withdraw') }}
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
                    @can('savings_withdraw.create')
                    <a data-placement="bottom" title="New Savings Withdraw" href="{{ route('admin.savings-withdraw.create') }}"  class="btn btn-info" title="{{ _lang('view') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i>{{_lang('New Withdraw')}}</a>
                    @endcan
                </h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.savings-withdraw.datatable') }}">
                        <thead>
                            <tr>
                                <th>{{_lang('id')}}</th>
                                <th>{{_lang('Member')}}</th>
                                <th>{{_lang('Savings AC No')}}</th>
                                <th>{{_lang('Withdraw Amt (Tk)')}}</th>
                                <th>{{_lang('Date')}}</th>
                                <th>{{_lang('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
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
    <script src="{{ asset('js/pages/savings_withdraw.js') }}"></script>
@endpush
