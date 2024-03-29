@extends('layouts.app', ['title' => _lang('setting'), 'modal' => false])

{{-- Header Section --}}
@section('page.header')
    <div class="app-title text-center bg-danger text-white">
        <div class="text-center w-100">
            <h1 data-toggle="tooltip" data-placement="bottom" title="Change Your Software SMS Configuration from here.">{{--<i class="fa fa-envelope mr-4"></i>--}} {{_lang('SMS Configuration')}}</h1>
            <p>{{_lang('Change Your Software SMS Configuration from here.')}} </p>
        </div>
       {{-- <ul class="app-breadcrumb breadcrumb">
            {{ Breadcrumbs::render('sms-settings') }}
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
                                <div class="row">
                                    {{--SMS Gateway --}}
                                    <div class="col-md-6">
                                        {{ Form::label('sms_gateway', _lang('SMS Gateway') , ['class' => 'col-form-label ']) }}
                                        <select name="sms_gateway" id="sms_gateway" class="form-control select" data-placeholder="Select SMS Gateway">
                                            <option value="">{{_lang('Select SMS Gateway')}}</option>
                                            <option {{get_option('sms_gateway') == 'Nexmo' ? 'selected' : ''}} value="Nexmo">{{_lang('Nexmo')}}</option>
                                            <option {{get_option('sms_gateway') == 'Twillo' ? 'selected' : ''}} value="Twillo">{{_lang('Twillo')}}</option>
                                            <option {{get_option('sms_gateway') == 'Custom' ? 'selected' : ''}} value="Custom">{{_lang('Custom')}}</option>
                                        </select>
                                    </div>
                                    {{-- Max SMS in single queue --}}
                                    <div class="col-md-6">
                                        {{ Form::label('max_sms', _lang('Max SMS in single queue') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('max_sms', get_option('max_sms'), ['class' => 'form-control', 'placeholder' => _lang('Type Max SMS in single queue')]) }}
                                    </div>
                                </div>
                                <div class="row" id="nexmo_contain" style="display:none">
                                    {{-- Nexmo Api Key --}}
                                    <div class="col-md-6">
                                        {{ Form::label('nexmo_api_key', _lang('Nexmo Api Key') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('nexmo_api_key', get_option('nexmo_api_key'), ['class' => 'form-control', 'placeholder' => _lang('Type Nexmo Api Key')]) }}
                                    </div>
                                    {{-- Nexmo Api Secret --}}
                                    <div class="col-md-6">
                                        {{ Form::label('nexmo_api_secret', _lang('Nexmo Api Secret') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('nexmo_api_secret', get_option('nexmo_api_secret'), ['class' => 'form-control', 'placeholder' => _lang('Type Nexmo Api Secret')]) }}
                                    </div>
                                    {{-- Nexmo Sender Mobile Number --}}
                                    <div class="col-md-6">
                                        {{ Form::label('nexmo_sender_number', _lang('Nexmo Sender Mobile Number') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('nexmo_sender_number', get_option('nexmo_sender_number'), ['class' => 'form-control', 'placeholder' => _lang('Type Nexmo Sender Mobile Number')]) }}
                                    </div>
                                    {{-- Nexmo Mobile Number For Texting --}}
                                    <div class="col-md-6">
                                        {{ Form::label('nexmo_testing_number', _lang('Nexmo Mobile Number For Texting') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('nexmo_testing_number', get_option('nexmo_testing_number'), ['class' => 'form-control', 'placeholder' => _lang('Type Nexmo Mobile Number For Texting')]) }}
                                    </div>
                                </div>
                                <div class="row" id="twillo_contain" style="display:none">
                                    {{-- Twillo SID --}}
                                    <div class="col-md-6">
                                        {{ Form::label('twillo_sid', _lang('Twillo SID') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('twillo_sid', get_option('twillo_sid'), ['class' => 'form-control', 'placeholder' => _lang('Type Twillo SID')]) }}
                                    </div>
                                     {{-- Twillo Token --}}
                                    <div class="col-md-6">
                                        {{ Form::label('twillo_token', _lang('Twillo Token') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('twillo_token', get_option('twillo_token'), ['class' => 'form-control', 'placeholder' => _lang('Type Twillo Token')]) }}
                                    </div>
                                    {{-- Twillo Sender Mobile Number --}}
                                    <div class="col-md-6">
                                        {{ Form::label('twillo_sender_number', _lang('Twillo Sender Mobile Number') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('twillo_sender_number', get_option('twillo_sender_number'), ['class' => 'form-control', 'placeholder' => _lang('Type Twillo Sender Mobile Number')]) }}
                                    </div>
                                    {{-- Twillo Mobile Number For Texting --}}
                                    <div class="col-md-6">
                                        {{ Form::label('twillo_testing_number', _lang('Twillo Mobile Number For Texting') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('twillo_testing_number', get_option('twillo_testing_number'), ['class' => 'form-control', 'placeholder' => _lang('Type Twillo Mobile Number For Texting')]) }}
                                    </div>
                                </div>
                                <div class="row" id="custom_contain" style="display:none">
                                    {{--Custom API Get URL --}}
                                    <div class="col-md-6">
                                        {{ Form::label('custom_api_url', _lang('API Get URL') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('custom_api_url', get_option('custom_api_url'), ['class' => 'form-control', 'placeholder' => _lang('Type API Get URL')]) }}
                                    </div>
                                     {{--Custom API Number Prefix --}}
                                    <div class="col-md-6">
                                        {{ Form::label('custom_api_prefix', _lang('API Number Prefix') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('custom_api_prefix', get_option('custom_api_prefix'), ['class' => 'form-control', 'placeholder' => _lang('Type API Number Prefix')]) }}
                                    </div>
                                     {{--Custom API Sender Id Parameter --}}
                                    <div class="col-md-6">
                                        {{ Form::label('custom_api_sender_parameter', _lang('API Sender Id Parameter') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('custom_api_sender_parameter', get_option('custom_api_sender_parameter'), ['class' => 'form-control', 'placeholder' => _lang('Type API Sender Id Parameter')]) }}
                                    </div>
                                     {{--Custom API Sender Id/Number --}}
                                    <div class="col-md-6">
                                        {{ Form::label('custom_api_sender_id', _lang('API Sender Id/Number') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('custom_api_sender_id', get_option('custom_api_sender_id'), ['class' => 'form-control', 'placeholder' => _lang('Type API Sender Id/Number')]) }}
                                    </div>
                                     {{--Custom API Receiver Parameter --}}
                                    <div class="col-md-4">
                                        {{ Form::label('custom_api_receiver_parameter', _lang('API Receiver Parameter') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('custom_api_receiver_parameter', get_option('custom_api_receiver_parameter'), ['class' => 'form-control', 'placeholder' => _lang('Type API Receiver Parameter')]) }}
                                    </div>
                                     {{--Custom API Message Parameter --}}
                                    <div class="col-md-4">
                                        {{ Form::label('custom_api_message_parameter', _lang('API Message Parameter') , ['class' => 'col-form-label ']) }}
                                        {{ Form::text('custom_api_message_parameter', get_option('custom_api_message_parameter'), ['class' => 'form-control', 'placeholder' => _lang('Type API Message Parameter')]) }}
                                    </div>
                                     {{--Custom API Accepts multiple receiver? --}}
                                    <div class="col-md-4">
                                        {{ Form::label('custom_api_multi_receiver', _lang('API Accepts multiple receiver?') , ['class' => 'col-form-label ']) }}
                                        <select name="custom_api_multi_receiver" id="custom_api_multi_receiver" class="form-control">
                                            <option {{get_option('custom_api_multi_receiver') == '1' ? 'selected' : ''}} value="Yes">{{_lang('Yes')}}</option>
                                            <option {{get_option('custom_api_multi_receiver') == '0' ? 'selected' : ''}} value="No">{{_lang('No')}}</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        @can('sms_configuration.update')
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

