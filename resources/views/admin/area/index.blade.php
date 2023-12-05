@extends('layouts.app', ['title' => _lang('Area'), 'modal' => 'lg'])
@push('css')
<link rel="stylesheet" href="{{asset('css/bootstrap-tagsinput.css')}}">
@endpush
{{-- Header Section --}}
@section('page.header')
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Area.">{{--<i class="fa fa-universal-access mr-4"></i>--}} {{_lang('Area')}}
        </h1>
        <p>{{_lang('Create Area. Here you can Add, Edit & Delete The Areas')}}</p>
    </div>
    {{--<ul class="app-breadcrumb breadcrumb">
        {{ Breadcrumbs::render('area') }}
    </ul>--}}
</div>
@stop

{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="row">
    {{-- following section is for the form --}}
    <div class="col-md-4">
        <div class="tile">
            <div class="tile-head mb-2">
                Add New Area
                <hr>
            </div>
            <div class="tile-body">
                <form action="{{route('admin.area.store')}}" method="post" id="content_form">
                    @csrf
                    <div class="row">
                        {{-- Area Name --}}
                        <div class="col-md-12 form-group">
                            <label for="calender">{{_lang('Area Name')}}
                            </label>
                            <span class="text-danger">*</span>
                            <input type="text" name="area" id="area" class="form-control" placeholder="Type Area Name"  required>
                        </div>

                        {{-- Thana Name --}}
                        <div class="col-md-12 form-group">
                            <label for="calender">{{_lang('Thana Name')}}
                            </label><span class="text-danger">*</span>
                            <input type="text" name="thana" id="thana" class="form-control" placeholder="Type District Name"  required>
                        </div>

                        {{-- District Name --}}
                        <div class="col-md-12 form-group">
                            <label for="calender">{{_lang('District Name')}}
                            </label>
                            <span class="text-danger">*</span>
                            <input type="text" name="district" id="district" class="form-control" placeholder="Type District Name"  required>
                        </div>



                        @can('area.create')
                        <div class="form-group col-md-12" align="right">
                            {{-- <input type="hidden" name="type[]" value=" "> --}}
                            <button type="submit" class="btn btn-primary" id="submit">{{_lang('Create')}}<i
                                    class="icon-arrow-right14 position-right"></i></button>
                            <button type="button" class="btn btn-link" id="submiting"
                                style="display: none;">{{_lang('Processing')}}<img src="{{ asset('ajaxloader.gif') }}"
                                    width="80px"></button>
                            <button type="reset" class="btn btn-danger" data-dismiss="modal">Reset</button>
                        </div>
                        @endcan
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- The following section is for the table to show data  --}}
    <div class="col-md-8">
        <div class="tile">

            <div class="tile-body">
                <table class="table table-hover table-bordered content_managment_table"
                    data-url="{{ route('admin.area.datatable') }}">
                    <thead>
                        <tr>
                            <th>{{_lang('Sl No')}}</th>
                            <th>{{_lang('Area')}}</th>
                            <th>{{_lang('District')}}</th>
                            <th>{{_lang('Thana')}}</th>
                            <th>{{_lang('action')}}</th>
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
<script src="{{ asset('backend/js/plugins/buttons.min.js') }}"></script>
<script src="{{ asset('backend/js/plugins/responsive.min.js') }}"></script>
<script src="{{ asset('js/pages/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('js/pages/area.js') }}"></script>

@endpush
