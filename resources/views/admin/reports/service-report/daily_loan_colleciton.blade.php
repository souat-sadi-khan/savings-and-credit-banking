@extends('layouts.app', ['title' => _lang('Daily Report'), 'modal' => 'lg'])

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
<div class="app-title text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-placement="bottom" title="Daily Report.">{{--<i class="fa fa-universal-access mr-4"></i>--}}
            {{_lang('Daily Report')}}</h1>
        <p>{{_lang('Daily Report. Here you can See Daily Report')}}</p>
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
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>

                                        <p style="margin:0px ; margin-top: -8px;">

                                            Report Of Date : <span class="ml-1">{{$report_date}}</span>

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
                                    <th scope="col">Sl <br> No</th>
                                    <th scope="col">Loan<br>AC</th>
                                    <th scope="col">Savings<br>AC</th>
                                    <th scope="col">Member</th>
                                    <th scope="col">Loan +<br> Interest</th>
                                    <th scope="col">Paid Amt</th>
                                    <th scope="col">Due Amt</th>
                                    <th scope="col">Total <br>Instal</th>
                                    <th scope="col">Paid <br>Instal</th>
                                    <th scope="col">Due <br>Instal</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">Expire Date</th>

                                    <th scope="col">Collection</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($daily_loan_collection as $collected_loan)

                                @php
                                    $loan_paid = App\models\utility\Transaction::where('tx_type', 'loan repay')->where('loan_account_id',$collected_loan->loan_account_id)->where('tx_date','<=', $start_date)->sum('grand_total_amt');
                                // calculate total loan amount and then calculate the due
                                    $loan_amt  = $collected_loan->loan_acc->loan_amount;
                                    $total_loan_amt =$loan_amt*1 + $loan_amt*$collected_loan->loan_acc->interest_rate/100;
                                    $loan_due = $total_loan_amt - $loan_paid;

                                    // calculate paid installment no
                                    $loan_paid_installment = App\models\utility\Transaction::where('tx_type', 'loan repay')->where('loan_account_id',$collected_loan->loan_account_id)->where('tx_date','<=', $start_date)->sum('no_of_paying_installment');
                                    $loan_total_installment = $collected_loan->installment_no;
                                    $loan_due_installment = $loan_total_installment - $loan_paid_installment;


                                @endphp
                                  <tr>
                                  <td>{{++$i}}</td>
                                  <td>{{get_id_account_no('loan',$collected_loan->loan_acc->prefix,$collected_loan->loan_acc->code)}}</td>
                                    <td>{{get_id_account_no('savings',$collected_loan->loan_acc->member->savings_account[0]->prefix,$collected_loan->loan_acc->member->savings_account[0]->code)}}</td>
                                    {{-- <td></td> --}}

                                  <td>{{$collected_loan->member->name_in_bangla}}</td>

                                  <td>{{$total_loan_amt}}</td>
                                  <td>{{$loan_paid}}</td>
                                  <td>{{$loan_due}}</td>
                                  <td>{{$loan_total_installment}}</td>
                                  <td>{{$loan_paid_installment}}</td>
                                  <td>{{$loan_due_installment}}</td>
                                    <td>{{carbonDate($collected_loan->loan_acc->issue_date)}}</td>
                                    <td>{{carbonDate($collected_loan->loan_acc->completion_date)}}</td>
                                  <td>{{$collected_loan->grand_total_amt}}</td>
                                </tr>

                                @endforeach
                                @if ($total_collection > 0 )
                                <tr>
                                    <td class="text-right" colspan="7"><b> Total Collection<b></td>
                                    <td class="text-lect" colspan="7"><b> {{$total_collection}}<b></td>
                                </tr>
                                    @else
                                    <tr>
                                    <td class="text-danger text-center" colspan="13">No Collection Found in {{$report_date}}</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>

                    </div>
                    <br>
                    <h5>In Words: {{ucwords($in_words)}} Taka Only.</h5>
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
<script src="{{ asset('js/pages/daily_report.js') }}"></script>
@endpush
