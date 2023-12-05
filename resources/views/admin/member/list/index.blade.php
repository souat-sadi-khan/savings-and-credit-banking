@extends('layouts.app', ['title' => _lang('Member List'), 'modal' => 'lg'])

{{-- Header Section --}}
@section('page.header')
    <div class="app-title text-center bg-danger text-white">
        <div class="text-center w-100">
            <h1 data-placement="bottom" title="Member List.">{{--<i class="fa fa-universal-access mr-4"></i>--}} {{_lang('Member List')}}</h1>
            <p>{{_lang('Create Member. Here you can Add, Edit & Delete The Member ')}}</p>
        </div>
       {{-- <ul class="app-breadcrumb breadcrumb">
            {{ Breadcrumbs::render('member-list') }}
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
                    @can('member_list.create')
                        <a data-placement="bottom" title="Create New Member" type="button" class="btn btn-info"  href="{{ route('admin.member-list.create') }}"><i class="fa fa-plus-square mr-2" aria-hidden="true"></i></i>{{_lang('create')}}</a>
                    @endcan
                </h3>
                <div class="tile-body ">
                    @if(!get_option('member_code_prefix') && !get_option('digits_member_code'))
                        <div class="col-md-12">
                            <div class="card mb-3 text-white bg-danger">
                                <div class="card-body text-center">
                                    <blockquote class="card-blockquote">
                                        <h2>{{_lang('Warning')}} </h2>
                                        <h4>{{_lang("Look Like You didn't set Some more Required Information")}} </h4>
                                        <p>{{_lang("Look Lijje You didn't set the Member Code Prefix & Member Code Digit. IF You don't set this 2 value, you can not add Member. If you want to add Member, Please Set the value by clicking the below Link")}} </p>
                                        <p><a href="{{route('admin.module.setting')}}">{{_lang('Click Here to Set The Value')}} </a></p>
                                  </blockquote>
                                </div>
                            </div>
                        </div>
                    @endif
                    <table class="table table-hover table-bordered content_managment_table" data-url="{{ route('admin.member-list.datatable') }}">
                        <thead>
                            <tr>
                                <th>{{_lang('id')}}</th>
                                <th>{{_lang('Code')}}</th>
                                <th>{{_lang('Name')}}</th>
                                <th>{{_lang('Father Name')}}</th>
                                <th>{{_lang('Date Of Birth')}}</th>
                                <th>{{_lang('Contact No')}}</th>
                                <th>{{_lang('Address')}}</th>
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
    <script src="{{ asset('backend/js/plugins/responsive.min.js') }}"></script>
    <script src="{{ asset('js/member/list.js') }}"></script>

@endpush

