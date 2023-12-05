@extends('layouts.app', ['title' => _lang('Financial Year Report'), 'modal' => 'lg'])

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
<div class="app-title" text-center bg-danger text-white>
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Financial Year Report.">{{--<i class="fa fa-universal-access mr-4"></i>--}}
            {{_lang('Financial Year Report')}}</h1>
        <p>{{_lang('Financial Year Report. Here you can See Financial Year Report')}}</p>
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



                <br>
                <hr>

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


                    <h5 class="mt-2"><b>{{$financial_year}}</b></h5>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>

                                        <p style="margin:0px ; margin-top: -8px;">

                                            {{-- Report Of Date : <span class="ml-1">{{$report_date}}</span> --}}

                                        </p>

                                    </td>
                                    <td class="text-center">

                                    </td>
                                    <td class="text-right">
                                        <p style="margin:0px ; margin-top: -8px;">Printing Date :
                                            <span></span> {{ date('d F, Y') }} </span></p>
                                        <p style="margin:0px ; margin-top: -4px;">Time :
                                            <span></span>{{date('h:i:s A')}}</span></p>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>



                    <div class="table-responsive border-dark">
                        <table class="table table-bordered ">
                            <thead class="table-head-bg">
                                <tr>
                                    <th scope="col">Calculation Code</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Note</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- =======    Show Incomes    ======== --}}
                                <tr>
                                    <td></td>
                                    <td><b>Income</b></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @foreach ($incomes as $income_key=>$income_amt)
                                    @if ($income_key != 'Total Income')

                                        <tr>
                                            <td></td>
                                        <td>{{$income_key}}</td>
                                        <td></td>
                                        <td>{{$income_amt}}</td>
                                        </tr>

                                    @endif
                                @endforeach
                                    <td></td>
                                    <td><b>Total Income</b></td>
                                    <td></td>
                                    <td>{{$incomes['Total Income']}}</td>
                                </tr>

                                {{-- =======    Show Expenses    ======== --}}
                                <tr>
                                    <td></td>
                                    <td><b>Expense</b></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @foreach ($expenses as $exp_key=>$exp_amt)
                                    @if ($exp_key != 'Total Expense')

                                        <tr>
                                            <td></td>
                                        <td>{{$exp_key}}</td>
                                        <td></td>
                                        <td>{{$exp_amt}}</td>
                                        </tr>

                                    @endif
                                @endforeach
                                    <td></td>
                                    <td><b>Total Expense</b></td>
                                    <td></td>
                                    <td>{{$expenses['Total Expense']}}</td>
                                </tr>

                                {{-- =========  shwo before allocation information  --}}
                                <tr>
                                    <td></td>
                                    <td>Net Profit Loss Before Allocation</td>
                                    <td></td>
                                    <td>{{$before_allcations['Net Profit Loss Before Allocation']}}</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><b>Net Total<b></td>
                                    <td></td>
                                    <td>{{$before_allcations['Net Total']}}</td>
                                </tr>

                                {{-- ========== show allocation calculation =========== --}}
                                 <tr>
                                    <td></td>
                                    <td><b>Allocation Calculation :</b></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @foreach ($allocation_calculations as $alloc_calc_key=>$alloc_calc_amt)

                                        <tr>
                                            <td></td>
                                        <td>{{$alloc_calc_key}}</td>
                                        <td></td>
                                        <td>{{$alloc_calc_amt}}</td>
                                        </tr>

                                @endforeach

                                </tr>

                                {{-- ========== show after  allocations =========== --}}

                                @foreach ($after_allocations as $after_alloc_key=>$after_alloc_amt)

                                        <tr>
                                            <td></td>
                                        <td> @if ($after_alloc_key == 'Net Profit After Allocation')
                                            <b>{{$after_alloc_key}}</b>
                                            @else
                                            {{$after_alloc_key}}
                                        @endif </td>
                                        <td></td>
                                        <td>{{$after_alloc_amt}}</td>
                                        </tr>

                                @endforeach

                                </tr>

                            </tbody>
                        </table>

                    </div>
                    <br>
                    {{-- <h5>In Words: {{ucwords($in_words)}} Taka Only.</h5> --}}
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
<script src="{{ asset('js/pages/financial_year_report.js') }}"></script>
@endpush
