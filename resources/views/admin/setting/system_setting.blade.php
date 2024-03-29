@extends('layouts.app', ['title' => _lang('setting'), 'modal' => false])

{{-- Header Section --}}
@section('page.header')
    <div class="app-title text-center bg-danger text-white">
        <div class="text-center w-100">
            <h1 data-toggle="tooltip" data-placement="bottom" title="Change Your Software System Configuration from here.">{{--<i class="fa fa-cogs mr-4"></i>--}} {{_lang('System Configuration')}}</h1>
            <p>{{_lang('Change Your Software System Configuration from here.')}} </p>
        </div>
        {{--<ul class="app-breadcrumb breadcrumb">
            {{ Breadcrumbs::render('system-settings') }}
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
                                    {{-- Default Sidebar --}}
                                    <div class="col-md-6">
                                        {{ Form::label('default_sidebar', _lang('Default Sidebar') , ['class' => 'col-form-label ']) }}
                                        <select name="default_sidebar" id="default_sidebar" class="form-control select" data-placeholder="Select Default Sidebar">
                                            <option value="">{{_lang('Select Default Sidebar')}}</option>
                                            <option {{get_option('default_sidebar') == '0' ? 'selected' : ''}} value="0">{{_lang('Mini')}}</option>
                                            <option {{get_option('default_sidebar') == '1' ? 'selected' : ''}} value="1">{{_lang('Normal')}}</option>
                                        </select>
                                    </div>
                                    {{-- TimeZone --}}
                                    <div class="col-md-6">
                                        {{ Form::label('timezone', _lang('TimeZone') , ['class' => 'col-form-label ']) }}
                                        <select name="timezone" class="form-control select">
                                            @foreach (tz_list() as $key=> $time)
                                                <option {{$time['zone'] == get_option('timezone') ? 'selected' : ''}}  value="{{$time['zone']}}">{{ $time['diff_from_GMT'] . ' - ' . $time['zone']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- Date Foramt --}}
                                    <div class="col-md-6">
                                        {{ Form::label('date_format', _lang('Date Format') , ['class' => 'col-form-label ']) }}
                                        <select name="date_format" id="date_format" class="form-control select" data-placeholder="Select Default Date Format">
                                            <option value="">{{_lang('Select Default Date Format')}}</option>
                                            <option {{get_option('date_format') == 'd-m-Y' ? 'selected' : ''}} value="d-m-Y">{{_lang('DD-MM-YYYY')}}</option>
                                            <option {{get_option('date_format') == 'm-d-Y' ? 'selected' : ''}} value="m-d-Y">{{_lang('MM-DD-YYYY')}}</option>
                                            <option {{get_option('date_format') == 'D-F-Y' ? 'selected' : ''}} value="d-F-Y">{{_lang('DD-MMM-YYYY')}}</option>
                                            <option {{get_option('date_format') == 'F-d-Y' ? 'selected' : ''}} value="F-d-Y">{{_lang('MMM-DD-YYYY')}}</option>
                                        </select>
                                    </div>
                                    {{-- Time Format --}}
                                    <div class="col-md-6">
                                        {{ Form::label('time_format', _lang('Time Format') , ['class' => 'col-form-label ']) }}
                                        <select name="time_format" id="time_format" class="form-control select" data-placeholder="Select Default Time Format">
                                            <option value="">{{_lang('Select Default Time Format')}}</option>
                                            <option {{get_option('time_format') == 'H::i' ? 'selected' : ''}} value="H::i">{{_lang('24 Hour')}}</option>
                                            <option {{get_option('time_format') == 'h:i' ? 'selected' : ''}}  value="h:i">{{_lang('12 Hour')}}</option>
                                            <option {{get_option('time_format') == 'h:i A' ? 'selected' : ''}} value="h:i A">{{_lang('12 Hour Meridiem')}}</option>
                                        </select>
                                    </div>
                                    {{-- Notification Position --}}
                                    <div class="col-md-6">
                                        {{ Form::label('notification_format', _lang('Notification Position') , ['class' => 'col-form-label ']) }}
                                        <select name="notification_format" id="notification_format" class="form-control select" data-placeholder="Select Default Notification Position ">
                                            <option value="">{{_lang('Select Default Notification Position')}}</option>
                                            <option selected {{get_option('notification_format') == 'toast-top-right' ? 'selected' : ''}} value="toast-top-right">{{_lang('Top Right')}}</option>
                                            <option {{get_option('notification_format') == 'toast-top-left' ? 'selected' : ''}} value="toast-top-left">{{_lang('Top Left')}}</option>
                                            <option {{get_option('notification_format') == 'toast-top-full-width' ? 'selected' : ''}} value="toast-top-full-width">{{_lang('Top Full Width')}}</option>
                                            <option {{get_option('notification_format') == 'toast-top-center' ? 'selected' : ''}} value="toast-top-cente">{{_lang('Top Center')}}</option>
                                            <option {{get_option('notification_format') == 'toast-bottom-right' ? 'selected' : ''}} value="toast-bottom-right">{{_lang('Bottom Right')}}</option>
                                            <option {{get_option('notification_format') == 'toast-bottom-left' ? 'selected' : ''}} value="toast-bottom-left">{{_lang('Bottom Left')}}</option>
                                            <option {{get_option('notification_format') == 'toast-bottom-full-width' ? 'selected' : ''}} value="toast-bottom-full-width">{{_lang('Bottom Full Width')}}</option>
                                            <option {{get_option('notification_format') == 'toast-bottom-center' ? 'selected' : ''}} value="toast-bottom-center">{{_lang('Bottom Center')}}</option>
                                        </select>
                                    </div>

                                    {{-- Language --}}
                                    <div class="col-md-6">
                                        {{ Form::label('language', _lang('language') , ['class' => 'col-form-label', 'data-placeholder' => 'Select System Language']) }}
                                        <select name="language" class="form-control select">
                                            <option value="default">{{_lang('Default')}}</option>
                                        {!! load_language( get_option('language') ) !!}
                                        </select>
                                    </div>
                                    {{-- Currency --}}
                                    <div class="col-lg-6">
                                        {{ Form::label('currency', _lang('Currency') , ['class' => 'col-form-label']) }}
                                        <select name="currency" class="form-control select">
                                        @foreach (curency() as $key=> $element)
                                            <option {{(get_option('currency')?get_option('currency') == $key :'') ? 'selected' : ''}} value="{{$key}}">{!!$element!!}({{$key}})</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    {{-- Page Lenghth --}}
                                    <div class="col-md-6">
                                        {{ Form::label('page_lenght', _lang('Page Length') , ['class' => 'col-form-label ']) }}
                                        <select name="page_lenght" id="page_lenght" class="form-control select" data-placeholder="Select Default Page Lenght ">
                                            <option value="">{{_lang('Select Default Page Lenght')}}</option>
                                            <option {{get_option('page_lenght') == '1' ? 'selected' : ''}} value="1">{{_lang('1')}}</option>
                                            <option {{get_option('page_lenght') == '5' ? 'selected' : ''}} value="5">{{_lang('5')}}</option>
                                            <option {{get_option('page_lenght') == '10' ? 'selected' : ''}} value="10">{{_lang('10')}}</option>
                                            <option {{get_option('page_lenght') == '25' ? 'selected' : ''}} value="25">{{_lang('25')}}</option>
                                            <option {{get_option('page_lenght') == '100' ? 'selected' : ''}} value="100">{{_lang('100')}}</option>
                                            <option {{get_option('page_lenght') == '500' ? 'selected' : ''}} value="500">{{_lang('500')}}</option>
                                        </select>
                                    </div>

                                    {{-- Enable Https --}}
                                   <!--  <div class="col-md-3 mt-3">
                                       <label for="enable_https">{{_lang('Enable Https')}}</label>
                                       <div class="toggle lg">
                                           <label>
                                               <input name="enable_https" id="enable_https" {{get_option('enable_https') == '1' ? 'checked' : ''}} type="checkbox" value="1"><span class="button-indecator"></span>
                                           </label>
                                       </div>
                                   </div>

                                   {{-- Show Error Display --}}
                                   <div class="col-md-3 mt-3">
                                       <label for="show_error_display">{{_lang('Show Error Display')}}</label>
                                       <div class="toggle lg">
                                           <label>
                                               <input name="show_error_display" id="show_error_display" {{get_option('show_error_display') == '1' ? 'checked' : ''}} type="checkbox"><span class="button-indecator"></span>
                                           </label>
                                       </div>
                                   </div>

                                   {{-- Enable FrontEnd Website --}}
                                   <div class="col-md-3 mt-3">
                                       <label for="enable_frontend_website">{{_lang('Enable FrontEnd Website')}}</label>
                                       <div class="toggle lg">
                                           <label>
                                               <input name="enable_frontend_website" id="enable_frontend_website" {{get_option('enable_frontend_website') == '1' ? 'checked' : ''}} type="checkbox"><span class="button-indecator"></span>
                                           </label>
                                       </div>
                                   </div>

                                   {{-- IP Filter--}}
                                   <div class="col-md-3 mt-3">
                                       <label for="ip_filter">{{_lang('IP Filter')}}</label>
                                       <div class="toggle lg">
                                           <label>
                                               <input name="ip_filter" id="ip_filter" {{get_option('ip_filter') == '1' ? 'checked' : ''}} type="checkbox"><span class="button-indecator"></span>
                                           </label>
                                       </div>
                                   </div>

                                   {{-- To-Do --}}
                                   <div class="col-md-4 mt-3">
                                       <label for="todo">{{_lang('To-Do ')}}</label>
                                       <div class="toggle lg">
                                           <label>
                                               <input name="todo" id="todo" {{get_option('todo') == '1' ? 'checked' : ''}} type="checkbox"><span class="button-indecator"></span>
                                           </label>
                                       </div>
                                   </div>

                                   {{-- BackUp --}}
                                   <div class="col-md-4 mt-3">
                                       <label for="backup">{{_lang('BackUp ')}}</label>
                                       <div class="toggle lg">
                                           <label>
                                               <input name="backup" id="backup" {{get_option('backup') == '1' ? 'checked' : ''}} type="checkbox"><span class="button-indecator"></span>
                                           </label>
                                       </div>
                                   </div>

                                   {{-- Enable Maintenance Mode --}}
                                   <div class="col-md-4 mt-3">
                                       <label for="maintenance_mode">{{_lang('Enable Maintenance Mode ')}}</label>
                                       <div class="toggle lg">
                                           <label>
                                               <input name="maintenance_mode" id="maintenance_mode" {{get_option('maintenance_mode') == '1' ? 'checked' : ''}} type="checkbox"><span class="button-indecator"></span>
                                           </label>
                                       </div>
                                   </div> -->

                                </div>
                        </div>
                        @can('system_configuration.update')
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
    <script>
        $(document).on('click', '#maintenance_mode', function() {
            var id = $(this).val();
            if(this.checked == true) {
                var status = 1;
            } else {
                var status = 0;
            }
            $('#maintenance_mode').val(status);
        });

    </script>
@endpush

