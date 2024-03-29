@extends('layouts.app', ['title' => _lang('Employee Leave'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Employee Leave.">{{--<i class="fa fa-universal-access mr-4"></i>--}}
            {{_lang('Employee Leave')}}</h1>
        <p>{{_lang('Create Employee Leave. Here you can Add, Edit & Delete The Employee Leave')}}</p>
    </div>
    {{--<ul class="app-breadcrumb breadcrumb">
        {{ Breadcrumbs::render('employee-leave') }}
    </ul>--}}
</div>
@stop

{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="row">
    <div class="col-md-5 mx-auto mt-5">
        <div class="card card-box">
            <div class="card-body">
                <h4 class="card-title">{{_lang('Leave Allocation')}} </h4>
                <p class="card-text font-80pc">{{_lang('Allocate leaves to your employee for selected duration, check leave
                    credit &amp; utilized report')}} </p>
                    @can('employee_leave_allocation.view')
                        <a href="{{ route('admin.employee-leave-allocation.index') }}" class="btn btn-info btn-sm">{{_lang('Goto Leave Allocation')}} </a>
                    @endcan
            </div>
        </div>
    </div>
    <div class="col-md-5 mx-auto">
        <div class="card card-box mt-5">
            <div class="card-body">
                <h4 class="card-title">{{_lang('Leave Request')}} </h4>
                <p class="card-text font-80pc">{{_lang('Request leave for your employee, take action on leave request')}} </p>
                @can('employee_leave_request.view')
                    <a href="{{ route('admin.employee-leave-request.index') }}" class="btn btn-info btn-sm">{{_lang('Go to Leave Request')}}</a>
                @endcan
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
<script src="{{ asset('js/employee/leave_type.js') }}"></script>
@endpush
