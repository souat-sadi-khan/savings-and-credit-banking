@extends('layouts.app', ['title' => _lang('Sundry Withdraw'), 'modal' => 'lg'])
{{-- Header Section --}}
@section('page.header')

<style>
    .table th,
    .table td {
        padding: 0.40rem 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

</style>
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Sundry Withdraw "><i class="fa fa-users mr-4"></i>
            {{_lang('Sundry Withdraw ')}}</h1>
        <p>{{_lang('Here You Can Withdraw Sundry Amounts')}}</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        {{-- {{ Breadcrumbs::render('loan-repay') }} --}}
    </ul>
</div>
@stop

{{-- Main Section --}}
@section('content')
<div class="tile">
    <div class="tile-body">
        <div class="col-md-12" style="margin-top:-10px">
            <hr>
            <h4 class="text-center text-info">Sundry Withdraw: <span class="text-danger">{{$sundry_month}}</span>
            </h4>
            <hr>
        </div>
        <div class=" row">
             <div class="col-md-4">
                <div class="card text-white bg-primary m-1 ">
                    <div class="card-header"><h5>SHARE</h5></div>
                    <div class="card-body text-center">
                        <h3 class="card-title text-center" style="margin-top:-10px">TOTAL: {{ $sundry_info['share_withdrawable'] }}</h3>
                            
                        <p class="card-text text-capitalize" style="margin-top:-10px">This is the total sundry amount of share Which is wihtdrawable. Now To withdraw it, You have to click on the following button.</p>
                    </div>
                    <a href="{{ route('admin.sundry-withdraw.show','SHARE') }}" style="text-decoration:none" class="text-light">

                    <div class="card-footer text-center" style="margin-top:-10px">
                        <h5>
                        Click Here To Review And Save  <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                        </h5>
                    </div>
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger m-1 ">
                    <div class="card-header"><h5>SAVINGS</h5></div>
                     <div class="card-body text-center" >
                        <h3 class="card-title text-center" style="margin-top:-10px">TOTAL: {{ $sundry_info['savings_withdrawable'] }}</h3>
                            
                        <p class="card-text text-capitalize" style="margin-top:-10px">This is the total sundry amount of savings Which is wihtdrawable. Now To withdraw it, You have to click on the following button.</p>
                    </div>
                    <a href="{{ route('admin.sundry-withdraw.show','SAVINGS') }}" style="text-decoration:none" class="text-light">

                    <div class="card-footer text-center" style="margin-top:-10px">
                        <h5>
                        Click Here To Review And Save  <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                        </h5>
                    </div>
                    </a>

                </div>
            </div>
              <div class="col-md-4">
                <div class="card text-white bg-primary m-1 ">
                    <div class="card-header"><h5>DPS</h5></div>
                    <div class="card-body text-center">
                        <h3 class="card-title text-center" style="margin-top:-10px">TOTAL: {{ $sundry_info['dps_withdrawable'] }}</h3>
                            
                        <p class="card-text text-capitalize" style="margin-top:-10px">This is the total sundry amount of DPS Which is wihtdrawable. Now To withdraw it, You have to click on the following button.</p>
                    </div>
                    <a href="{{ route('admin.sundry-withdraw.show','DPS') }}" style="text-decoration:none" class="text-light">
                    <div class="card-footer text-center" style="margin-top:-10px">
                        <h5> Click Here To Review And Save  <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                            </h5>
                    </div>
                    </a>

                </div>
            </div>
            <div class="col-md-2"></div>


            <div class="col-md-4">
                <div class="card text-white bg-dark m-1 mt-4">
                    <div class="card-header"><h5>DOUBLE BENEFIT</h5></div>
                     <div class="card-body text-center">
                        <h3 class="card-title text-center" style="margin-top:-10px">TOTAL: {{ $sundry_info['double_benifit_withdrawable'] }}</h3>
                            
                        <p class="card-text text-capitalize" style="margin-top:-10px">This is the total sundry amount of double benefit Which is wihtdrawable. Now To withdraw it, You have to click on the following button.</p>
                    </div>
                    <a href="{{ route('admin.sundry-withdraw.show','DOUBLE BENEFIT') }}" style="text-decoration:none" class="text-light">
                    
                    <div class="card-footer text-center" style="margin-top:-10px">
                        <h5>
                        Click Here To Review And Save  <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>
                        </h5>
                    </div>
                    </a>

                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-info m-1 mt-4">
                    <div class="card-header"><h5>LOAN FROM MEMBER</h5></div>
                    <div class="card-body text-center">
                        <h3 class="card-title text-center" style="margin-top:-10px">TOTAL: {{ $sundry_info['loan_from_member_withdrawable'] }}</h3>
                            
                        <p class="card-text text-capitalize" style="margin-top:-10px">This is the total sundry amount of loan from member Which is wihtdrawable. Now To withdraw it, You have to click on the following button.</p>
                    </div>
                    <a href="{{ route('admin.sundry-withdraw.show','LOAN FROM MEMBER') }}" style="text-decoration:none" class="text-light">
                    
                    <div class="card-footer text-center" style="margin-top:-10px">
                        <h5>
                        Click Here To Review And Save  <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 
                        </h5>
                    </div>
                    </a>

                </div>
            </div>

            <div class="col-md-2"></div>

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
<script src="{{ asset('js/pages/loan_repay.js') }}"></script>

<script>
    $('.select').select2({
        width: '100%'
    });

    $(document).ready(function () {
        // $('#example').DataTable();

        $('#example').DataTable({
            "searching": false,
            "lengthChange": false,
            "pageLength": 15
        });

    });

</script>


@endpush
