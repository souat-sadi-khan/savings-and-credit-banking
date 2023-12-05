@extends('layouts.app', ['title' => _lang('Loan Account'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
    <div class="app-title  text-center bg-danger text-white">
        <div class="text-center w-100">
            <h1 data-placement="bottom" title="Loan Account.">{{--<i class="fa fa-universal-access mr-4"></i> --}}{{_lang('Loan Account')}}</h1>
            <p>{{_lang('Create Loan Account. Here you can Add, Edit & Delete The Loan Accounts')}}</p>
        </div>
        {{--<ul class="app-breadcrumb breadcrumb">
            {{ Breadcrumbs::render('loan-account') }}
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
                    @can('loan_account.create')
                    <a data-placement="bottom" title="Create New Loan Account" href="{{ route('admin.loan-account.create') }}"  class="btn btn-info" title="{{ _lang('view') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i>{{_lang('create')}}</a>
                    @endcan
                </h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.loan-account.datatable') }}">
                    {{-- <table class="table table-hover table-bordered"> --}}
                        <thead>
                            <tr>
                                <th>{{_lang('Id')}}</th>
                                <th>{{_lang('Image')}}</th>
                                <th>{{_lang('Member')}}</th>
                                <th>{{_lang('Business')}}</th>
                                <th>{{_lang('Loan')}}</th>
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
    <script src="{{ asset('js/pages/loan_account.js') }}"></script>
@endpush

