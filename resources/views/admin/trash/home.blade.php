@extends('layouts.app', ['title' => 'Dahsboard', 'modal' => false])

{{-- Header Option --}}
@section('page.header')
    <div class="app-title text-center bg-danger text-white">
        <div class="text-center w-100">
            <h1 data-toggle="tooltip" data-placement="bottom" title="Savings and Credit Co-operative Management Software Recycle Bin Dashboard">{{--<i class="fa fa-dashboard mr-4"></i>--}}{{_lang('Recycle Bin Dashboard')}}</h1>
            <p>{{_lang('Recycle bin Dashboard for Savings and Credit Co-operative Management Software')}} </p>
        </div>
        {{--<ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item">{{ Breadcrumbs::render('trash') }}</li>
        </ul>--}}
    </div>
@stop

@section('content')
<!-- Basic initialization -->

    <div class="row">

        {{-- Trash Heading --}}
        <div class="col-md-12">
            <div class="card mb-3 text-white bg-danger">
                <div class="card-body text-center">
                    <blockquote class="card-blockquote">
                        <h2>Warning</h2>
                        <h4>You In Recycle Bin Folder</h4>
                        <p>On the left sidebar, You can see the all features that you can also see in the Main Folder. Here you can only see the deleted item list for all section. Here you can restore the deleted data & alse delete the data forever</p>
                        <p><a href="{{route('home')}}">Get Back To Main Folder</a></p>
                  </blockquote>
                </div>
            </div>
        </div>

        {{-- User Count Card --}}
        {{-- <div class="col-md-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>Total User</h4>
                    <p><b>
                    @php
                        $users = App\User::get();
                        echo count($users) - 1;
                    @endphp
                    </b></p>
                </div>
            </div>
        </div> --}}

    </div>

<!-- /basic initialization -->
@stop

