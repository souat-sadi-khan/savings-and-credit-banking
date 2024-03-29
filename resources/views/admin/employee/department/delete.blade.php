@extends('layouts.app', ['title' => _lang('Trash Employee Department'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
    <div class="app-title text-center bg-danger text-white">
        <div class="text-center w-100">
            <h1 data-placement="bottom" title="Trashed Employee Department Data.">{{--<i class="fa fa-universal-access mr-4"></i>--}} {{_lang('Trash Employee Department')}}</h1>
            <p>{{_lang('Here you can see only the deleted employee department data. You can only Restore and Force Delete the data from here.')}}</p>
        </div>
        {{--<ul class="app-breadcrumb breadcrumb">
            {{ Breadcrumbs::render('trash-employee-department') }}
        </ul>--}}
    </div>
@stop

{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
    <div class="row">

        @if (Request::is('admin/trash*'))
            {{-- Trash Heading --}}
            <div class="col-md-12">
                <div class="card mb-3 text-white bg-danger">
                    <div class="card-body text-center">
                        <blockquote class="card-blockquote">
                            <h4>Warning</h4>
                            <h6>Currently You are In Recycle Bin Folder</h6>
                            <p>On the left sidebar, You can see the all features that you can also see in the Main Folder. Here you can only see the deleted item list for all section. Here you can restore the deleted data & alse delete the data forever</p>
                            <p><a href="{{route('admin.employee.department.index')}}">Get Back To Main Employee Category File</a></p>
                    </blockquote>
                    </div>
                </div>
            </div>
        @endif

        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.trash.department.datatable') }}">
                        <thead>
                            <tr>
                                <th>{{_lang('id')}}</th>
                                <th>{{_lang('Name')}}</th>
                                <th>{{_lang('Description')}}</th>
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
    {{-- <script src="{{ asset('backend/js/plugins/buttons.min.js') }}"></script> --}}
    <script src="{{ asset('backend/js/plugins/responsive.min.js') }}"></script>
    <script src="{{ asset('js/employee/category.js') }}"></script>
@endpush

