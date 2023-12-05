@extends('layouts.app', ['title' => _lang('Bank Deposit Vs Withdraw Report'), 'modal' => 'lg'])


{{-- Script Section --}}
@push('css')
<style>
    @media print {

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
            color: #fff;
            background-color: #4caf50 !important;
        }
    }

</style>
@endpush
{{-- Header Section --}}
@section('page.header')
<div class="app-title">
    <div>
        <h1 data-placement="bottom" title="Bank Deposit Vs Withdraw Report."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Bank Deposit Vs Withdraw Report')}}</h1>
        <p>{{_lang('Bank Deposit Vs Withdraw Report. Here you can See Bank Deposit Vs Withdraw Report')}}</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        {{-- {{ Breadcrumbs::render('cash-position-memo') }} --}}
    </ul>
</div>
@stop

{{-- Main Section --}}
@section('content')
<!-- Basic initialization -->
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <h3 class="tile-title">

            </h3>
            <div class="tile-body">
                {{-- <div class="row"> --}}



               

                <div id="print_table" style="color:black">
                    <span class="text-center">
                        <h3><b class="text-uppercase">{{$organization['name']}}</b></h3>
                        <h5>{{$organization['address']}}</h5>
                        <h6>{{$organization['phone']}},{{$organization['email']}}</h6>

                    </span>
                    <div class="text-center col-md-12">
                        <h4 style="margin:0px ; margin-top: 7px; border:solid 1px #000; border-radius:50px; display:inline-block; padding:10px;"
                            class="bg-success text-light">
                            <b>{{$report_type}}</b></h4>
                    </div>
                   
  
                    <div class="row">
                        <div class="col-md-6 text-left">
                             <p style="margin:0px ;">
                                Report Of Date : <span class="ml-1">{{$dates['start_date']}}</span>

                                @if ($dates['both'])
                                <span class="badge badge-danger mx-2"> TO </span>
                                {{ $dates['end_date'] }}
                                @endif
                            </p>
                        </div>
                    <div class="col-md-6 text-right" >
                        <p style="margin:0px;">Printing Date : <span></span> {{ date('d F, Y') }} </span></p>
                        <p style="margin:0px ; ">Time : <span></span>{{date('h:i:s A')}}</span></p>
                    </div>
                </div>
                    {{-- <hr class="border-dark "> --}}
                    
                     <hr>

                    <div class="table-responsive border-dark ">
                        <table class="table table-bordered ">
                            <thead class="table-head-bg">
                                <tr>
                                    <th>Sl No</th>
                                    <th scope="col">Account No</th>
                                    <th scope="col">Bank Name</th>
                                    <th scope="col">Branch Name</th>
                                    <th scope="col">AC Holder Name</th>
                                    <th scope="col">Deposit</th>
                                    <th scope="col">Withdraw</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i  = 0;
                                @endphp
                              @foreach ($accounts as $acc)
                              <tr>
                                  <td>{{ ++$i }}</td>
                                  <td>{{ $acc->account_no }}</td>
                                  <td>{{ $acc->bank_name }}</td>
                                  <td>{{ $acc->branch_name }}</td>
                                  <td>{{ $acc->account_holder_name }}</td>
                                  <td>{{ $deposit_head_amt[$acc->id] }}</td>
                                  <td>{{ $withdraw_head_amt[$acc->id] }}</td>
                              </tr>
                                  
                              @endforeach
                              <tr>
                                  <td colspan="5" class="text-right">Total </td>
                                  <td>{{ $total_deposit }}</td>
                                  <td>{{ $total_withdraw }}</td>
                              </tr>
                            </tbody>
                        </table>

                    </div>
                    <br><br>

                    {{-- <h5>In Words:  {{ucwords(convert_number_to_words())}} Taka Only.</h5> --}}
                    <br><br><br>

                   <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-4 text-center">
                            <hr class="border-dark">
                            <p> Chief Cashier </p>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-4 text-center">
                            <hr class="border-dark">
                            <p> Manager </p>
                        </div>
                        <div class="col-md-1"></div>


                    </div>


                </div>
                <div class="text-center">

                    @php
                    $print_table = 'print_table';

                    @endphp

                    <a class="text-light btn-primary btn" onclick="printContent('{{ $print_table }}')" name="print"
                        id="print_receipt">
                        <i class="fa fa-print" aria-hidden="true"></i>
                        {{_lang('Print Report')}}

                    </a>

                </div>


                {{-- </div> --}}

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
<script src="{{ asset('js/pages/voucher_report.js') }}"></script>
@endpush
