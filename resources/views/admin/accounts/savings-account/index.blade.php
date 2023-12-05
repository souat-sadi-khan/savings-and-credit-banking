@extends('layouts.app', ['title' => _lang('Savings Account'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
    <div class="app-title text-center bg-danger text-white">
        <div class="text-center w-100">
            <h1 data-placement="bottom" title="Savings Account.">{{--<i class="fa fa-universal-access mr-4"></i>--}} {{_lang('Savings Account')}}</h1>
            <p>{{_lang('Create Savings Account. Here you can Add, Edit & Delete The Savings Accounts')}}</p>
        </div>
        {{--<ul class="app-breadcrumb breadcrumb">
            {{ Breadcrumbs::render('savings-account') }}
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
                    @can('savings_account_list.create')
                    <button data-placement="bottom" title="Create New Savings Account" type="button" class="btn btn-info" id="content_managment" data-url ="{{ route('admin.savings-account.create') }}"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i></i>{{_lang('create')}}</button>
                    @endcan
                </h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.savings-account.datatable') }}">
                        <thead>
                            <tr>
                                <th>{{_lang('id')}}</th>
                                <th>{{_lang('Member')}}</th>
                                <th>{{_lang('Photo')}}</th>
                                <th>{{_lang('AC No')}}</th>
                                <th>{{_lang('Nomenee')}}</th>
                                <th>{{_lang('Identifier')}}</th>
                                <th>{{_lang('Status')}}</th>
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
    <script src="{{ asset('js/pages/savings_account.js') }}"></script>
@endpush

