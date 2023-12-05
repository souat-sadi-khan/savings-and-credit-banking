@extends('layouts.app', ['title' => _lang('setting'), 'modal' => false])

{{-- Header Section --}}
@section('page.header')
    <div class="app-title text-center bg-danger text-white">
        <div class="text-center w-100">
            <h1 data-toggle="tooltip" data-placement="bottom" title="Change Your Software Module Configuration from here.">{{--<i class="fa fa-wrench mr-4"></i>--}} {{_lang('Module Configuration')}}</h1>
            <p>{{_lang('Change Your Software Module Configuration from here.')}} </p>
        </div>
       {{-- <ul class="app-breadcrumb breadcrumb">
            {{ Breadcrumbs::render('module-settings') }}
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
                    <div class="bs-component">

                    <!-- Tab panes -->
                    {!! Form::open(['route' => 'admin.setting', 'id' => 'content_form','files' => true, 'method' => 'POST']) !!}
                        <div class="tab-content">
                            {{-- This is for Home Section --}}
                            <h3 class="text-center">Employee Configaration</h3><hr>
                                <div class="row">
                                    {{-- Employee Code Prefix --}}
                                    <div class="col-md-6">
                                        {{ Form::label('employee_code_prefix', _lang('Employee Code Prefix') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('employee_code_prefix', get_option('employee_code_prefix'), ['class' => 'form-control', 'placeholder' => _lang('Type Employee Code Prefix')]) }}
                                    </div>
                                    {{-- Digits Employee Code --}}
                                    <div class="col-md-6">
                                        {{ Form::label('digits_employee_code', _lang('Digits Employee Code') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('digits_employee_code', get_option('digits_employee_code'), ['class' => 'form-control', 'placeholder' => _lang('Type Digits Employee Code')]) }}
                                    </div>
                                </div>


                            {{-- This is for Member Configaration --}}
                            <hr><h3 class="text-center">Member Configaration</h3><hr>
                                <div class="row">
                                    {{-- Member Code Prefix --}}
                                    <div class="col-md-6">
                                        {{ Form::label('member_code_prefix', _lang('Member Code Prefix') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('member_code_prefix', get_option('member_code_prefix'), ['class' => 'form-control', 'placeholder' => _lang('Type Member Code Prefix')]) }}
                                    </div>
                                    {{-- Digits Member Code --}}
                                    <div class="col-md-6">
                                        {{ Form::label('digits_member_code', _lang('Digits Member Code') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('digits_member_code', get_option('digits_member_code'), ['class' => 'form-control', 'placeholder' => _lang('Type Digits Member Code')]) }}
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- User Defined Days --}}
                                    <div class="col-md-6" style="display:none;" id="defined-days">
                                        {{ Form::label('user_defined_days', _lang('User Defined Days') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('user_defined_days', get_option('user_defined_days'), ['class' => 'form-control', 'placeholder' => _lang('Type User Defined Days')]) }}
                                    </div>
                                </div>


                                 {{-- This is for Share Configuration --}}
                            <hr><h3 class="text-center">Share Configuration</h3><hr>
                                <div class="row">
                                    {{-- Share Code Prefix --}}
                                    <div class="col-md-6">
                                        {{ Form::label('share_code_prefix', _lang('Share Code Prefix') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('share_code_prefix', get_option('share_code_prefix'), ['class' => 'form-control', 'placeholder' => _lang('Type Share Code Prefix')]) }}
                                    </div>
                                    {{-- Digits Share Code --}}
                                    <div class="col-md-6">
                                        {{ Form::label('digits_share_code', _lang('Digits Share Code') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('digits_share_code', get_option('digits_share_code'), ['class' => 'form-control', 'placeholder' => _lang('Type Digits Share Code')]) }}
                                    </div>
                                </div>


                                 {{-- This is for Savings Account Configuration --}}
                            <hr><h3 class="text-center">Savings Account Configuration</h3><hr>
                                <div class="row">
                                    {{-- Savings Account Code Prefix --}}
                                    <div class="col-md-6">
                                        {{ Form::label('savings_account_code_prefix', _lang('Savings Account Code Prefix') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('savings_account_code_prefix', get_option('savings_account_code_prefix'), ['class' => 'form-control', 'placeholder' => _lang('Type Savings Account Code Prefix')]) }}
                                    </div>
                                    {{-- Digits Savings Account Code --}}
                                    <div class="col-md-6">
                                        {{ Form::label('digits_savings_account_code', _lang('Digits Savings Account Code') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('digits_savings_account_code', get_option('digits_savings_account_code'), ['class' => 'form-control', 'placeholder' => _lang('Type Digits Savings Account Code')]) }}
                                    </div>
                                </div>

                                 {{-- This is for Loan Account Configuration --}}
                            <hr><h3 class="text-center">Loan Account Configuration</h3><hr>
                                <div class="row">
                                    {{-- Loan Account Code Prefix --}}
                                    <div class="col-md-6">
                                        {{ Form::label('loan_account_code_prefix', _lang('Loan Account Code Prefix') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('loan_account_code_prefix', get_option('loan_account_code_prefix'), ['class' => 'form-control', 'placeholder' => _lang('Type Loan Account Code Prefix')]) }}
                                    </div>
                                    {{-- Digits Loan Account Code --}}
                                    <div class="col-md-6">
                                        {{ Form::label('digits_loan_account_code', _lang('Digits Loan Account Code') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('digits_loan_account_code', get_option('digits_loan_account_code'), ['class' => 'form-control', 'placeholder' => _lang('Type Digits Loan Account Code')]) }}
                                    </div>
                                </div>

                                 {{-- This is for DPS Configuration --}}
                            <hr><h3 class="text-center">DPS Configuration</h3><hr>
                                <div class="row">
                                    {{-- DPS Code Prefix --}}
                                    <div class="col-md-6">
                                        {{ Form::label('dps_code_prefix', _lang('DPS Code Prefix') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('dps_code_prefix', get_option('dps_code_prefix'), ['class' => 'form-control', 'placeholder' => _lang('Type DPS Code Prefix')]) }}
                                    </div>
                                    {{-- Digits DPS Code --}}
                                    <div class="col-md-6">
                                        {{ Form::label('digits_dps_code', _lang('Digits DPS Code') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('digits_dps_code', get_option('digits_dps_code'), ['class' => 'form-control', 'placeholder' => _lang('Type Digits DPS Code')]) }}
                                    </div>
                                </div>

                                 {{-- This is for Double Benifit Configuration --}}
                            <hr><h3 class="text-center">Double Benifit Configuration</h3><hr>
                                <div class="row">
                                    {{-- double_benifit Code Prefix --}}
                                    <div class="col-md-6">
                                        {{ Form::label('double_benifit_code_prefix', _lang('Double Benifit Code Prefix') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('double_benifit_code_prefix', get_option('double_benifit_code_prefix'), ['class' => 'form-control', 'placeholder' => _lang('Type Double Benifit Code Prefix')]) }}
                                    </div>
                                    {{-- Digits double_benifit Code --}}
                                    <div class="col-md-6">
                                        {{ Form::label('digits_double_benifit_code', _lang('Digits double_benifit Code') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('digits_double_benifit_code', get_option('digits_double_benifit_code'), ['class' => 'form-control', 'placeholder' => _lang('Type Digits Double Benifit Code')]) }}
                                    </div>
                                </div>

                                 {{-- This is for Loan From Member Configuration --}}
                            <hr><h3 class="text-center">Loan From Member Configuration</h3><hr>
                                <div class="row">
                                    {{-- loan_from_member Code Prefix --}}
                                    <div class="col-md-6">
                                        {{ Form::label('loan_from_member_code_prefix', _lang('Loan From Member Code Prefix') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('loan_from_member_code_prefix', get_option('loan_from_member_code_prefix'), ['class' => 'form-control', 'placeholder' => _lang('Type Loan From Member Code Prefix')]) }}
                                    </div>
                                    {{-- Digits loan_from_member Code --}}
                                    <div class="col-md-6">
                                        {{ Form::label('digits_loan_from_member_code', _lang('Digits loan_from_member Code') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('digits_loan_from_member_code', get_option('digits_loan_from_member_code'), ['class' => 'form-control', 'placeholder' => _lang('Type Digits Loan From Member Code')]) }}
                                    </div>
                                </div>

                                 {{-- This is for Invoice Configuration --}}
                            <hr><h3 class="text-center">Invoice Configuration</h3><hr>
                                <div class="row">
                                    {{-- loan_from_member Code Prefix --}}
                                    <div class="col-md-6">
                                        {{ Form::label('invoice_code_prefix', _lang('Invoice Code Prefix') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('invoice_code_prefix', get_option('invoice_code_prefix'), ['class' => 'form-control', 'placeholder' => _lang('Type Invoice Code Prefix')]) }}
                                    </div>
                                    {{-- Digits invoice Code --}}
                                    <div class="col-md-6">
                                        {{ Form::label('digits_invoice_code', _lang('Digits invoice Code') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('digits_invoice_code', get_option('digits_invoice_code'), ['class' => 'form-control', 'placeholder' => _lang('Type Digits Invoice Code')]) }}
                                    </div>
                                </div>
                        </div>
                        @can('module_configuration.update')
                            {{-- This is for submit Button --}}
                            <div class="text-right mr-2 mt-4">
                                <button data-placement="bottom" title="Update The Change"  type="submit" class="btn btn-primary"  id="submit">{{_lang('update_setting')}}</button>
                                <button type="button" class="btn btn-link" id="submiting" style="display: none;">{{ _lang('processing') }} <img src="{{ asset('ajaxloader.gif') }}" width="80px"></button>
                            </div>
                        @endcan
                    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /basic initialization -->
@stop

{{-- Script Section --}}
@push('scripts')
    <script src="{{ asset('js/pages/setting.js') }}"></script>
@endpush
