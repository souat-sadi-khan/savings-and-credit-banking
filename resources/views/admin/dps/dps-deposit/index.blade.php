@extends('layouts.app', ['title' => _lang('Deposit Of DPS'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
    <div class="app-title text-center bg-danger text-white">
        <div class="text-center w-100">
            <h1 data-placement="bottom" title="Deposit Of DPS.">{{--<i class="fa fa-universal-access mr-4"></i> --}}{{_lang('Deposit Of DPS')}}</h1>
            <p>{{_lang('Create Deposit Of DPS. Here you can Add, Edit & Delete The Deposit Of DPS')}}</p>
        </div>
        {{--<ul class="app-breadcrumb breadcrumb">
            {{ Breadcrumbs::render('dps-deposit') }}
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
                    @can('dps_deposit.create')
                    <a data-placement="bottom" title="New DPS Deposit" href="{{ route('admin.dps-deposit.create') }}"  class="btn btn-info" title="{{ _lang('view') }}" data-popup="tooltip" data-placement="bottom"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i>{{_lang('New Deposit')}}</a>
                    @endcan
                </h3>
                <div class="tile-body">
                    <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.dps-deposit.datatable') }}">
                        <thead>
                            <tr>
                                <th>{{_lang('id')}}</th>
                                <th>{{_lang('Member')}}</th>
                                <th>{{_lang('Dps AC No')}}</th>
                                <th>{{_lang('Deposit Amt (Tk)')}}</th>
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
    <script src="{{ asset('js/pages/savings_deposit.js') }}"></script>
@endpush

