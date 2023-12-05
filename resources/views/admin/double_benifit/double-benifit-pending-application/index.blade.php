@extends('layouts.app', ['title' => _lang('Pending Double Benifit Applications'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
    <div class="app-title text-center bg-danger text-white">
        <div class="text-center w-100">
            <h1 data-placement="bottom" title="Pending Double Benifit Applications.">{{--<i class="fa fa-universal-access mr-4"></i>--}} {{_lang('Pending Double Benifit Applications')}}</h1>
            <p>{{_lang('Create Pending Double Benifit Applications. Here you can Add, Edit & Delete The Pending Double Benifit Applications')}}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            {{-- {{ Breadcrumbs::render('pending-application') }} --}}
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
                    @can('new_double-benifit_application.create')
                    <a data-placement="bottom" title="New double-benifit Application" href="{{ route('admin.double-benifit-application.index') }}"  class="btn btn-info" title="{{ _lang('view') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i>{{_lang('New Application')}}</a>
                    @endcan
                </h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.double-benifit-pending-application.datatable') }}">
                    {{-- <table class="table table-hover table-bordered"> --}}
                        <thead>
                            <tr>
                                <th>{{_lang('Id')}}</th>
                                <th>{{_lang('Image')}}</th>
                                <th>{{_lang('Member')}}</th>
                                <th>{{_lang('Double Benifit')}}</th>
                                <th>{{_lang('Nomenee')}}</th>
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
    <script src="{{ asset('js/pages/double_benifit_account.js') }}"></script>
@endpush

