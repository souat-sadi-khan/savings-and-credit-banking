@extends('layouts.app', ['title' => _lang('Income Vs Expense Report'), 'modal' => 'lg'])


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
        <h1 data-placement="bottom" title="Income Vs Expense Report."><i class="fa fa-universal-access mr-4"></i>
            {{_lang('Income Vs Expense Report')}}</h1>
        <p>{{_lang('Income Vs Expense Report. Here you can See Income Vs Expense Report')}}</p>
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
                                    <th scope="col" colspan="3" class="text-center bg-white text-dark">INCOME</th>
                                    <th scope="col" colspan="2"  class="text-center bg-white text-dark">EXPENSE</th>
                                </tr>
                                <tr>
                                    <th>Sl No</th>
                                    <th scope="col">Income Head</th>
                                    <th scope="col">Income Amt</th>
                                    <th scope="col">Expense Head</th>
                                    <th scope="col">Expense Amt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($total_income_count>0 ||$total_expense_count > 0)
                 @php
                 $i = 0 ;
                 @endphp
              
                 @for ($i = 0; $i < $max_row; $i++)
                    <tr>
                        <td>{{ $i+1 }}</td>
                    @if ($i<$total_income_count)
                        <td>{{$income_cat_model[$i]->name}}</td>
                        <td>{{$income_head_amt[$income_cat_model[$i]->name]}}</td>
                    @else
                        <td colspan="2"></td>
                    @endif
                    @if ($i<$total_expense_count)
                        <td>{{$expense_cat_model[$i]->name}}</td>
                        <td>{{$expense_head_amt[$expense_cat_model[$i]->name]}}</td>
                    @else
                        <td colspan="2"></td>
                    @endif
                    </tr>
                     
                 @endfor
                    <tr class="text-weight-bold">
                        <td colspan="2" class="text-right">Total Income</td>
                        <td>{{$total_income}}</td>
                        <td  class="text-right">Total Expense</td>
                        <td>{{$total_expense}}</td>
                    </tr>
                 @else
                 <tr>
                     <td colspan="5" align="center" class="text-danger">No Transactions Found</td>
                 </tr>
                 @endif
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
