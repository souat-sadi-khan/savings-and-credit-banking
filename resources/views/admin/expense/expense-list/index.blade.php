@extends('layouts.app', ['title' => _lang('Expense List'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
    <div class="app-title text-center bg-danger text-white">
        <div class="text-center w-100">
            <h1 data-placement="bottom" title="Expense List.">{{--<i class="fa fa-universal-access mr-4"></i>--}} {{_lang('Expense List')}}</h1>
            <p>{{_lang('Create Expense. Here you can Add, Edit & Delete The Expense ')}}</p>
        </div>
       {{-- <ul class="app-breadcrumb breadcrumb">
            {{ Breadcrumbs::render('expense-list') }}
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
                    @can('expense.create')
                    <button data-placement="bottom" title="Create New Expense Type" type="button" class="btn btn-info" id="content_managment" data-url ="{{ route('admin.expense-list.create') }}"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i></i>{{_lang('create')}}</button>
                    @endcan
                </h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.expense-list.datatable') }}">
                        <thead>
                            <tr>
                                <th>{{_lang('id')}}</th>
                                <th>{{_lang('Ref No')}}</th>
                                <th>{{_lang('Exp Category')}}</th>
                                <th>{{_lang('Exp For')}}</th>
                                <th>{{_lang('Note')}}</th>
                                <th>{{_lang('Status')}}</th>
                                <th>{{_lang('Exp Amt')}}</th>
                                <th>{{_lang('Due')}}</th>
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
    <script src="{{ asset('js/pages/expense_list.js') }}"></script>
@endpush

