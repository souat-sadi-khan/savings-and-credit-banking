@extends('layouts.app', ['title' => _lang('All Transaction Report'), 'modal' => 'lg'])


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
        <h1 data-placement="bottom" title='All Transaction Report.'><i
                class="fa fa-universal-access mr-4"></i>
            {{_lang(' Report')}}</h1>
        <p>{{_lang('All Transaction Report. Here you can See All transacitons wihin the selected date')}}
        </p>
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
                        <div class="col-md-6 text-right">
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
                                    <th scope="col">AC No</th>
                                    <th scope="col">Transaction Type</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Debit</th>
                                    <th scope="col">Credit</th>
                                </tr>
                            </thead>
                            <tbody>
                               @php
                                    $i = 0;
                                    $total_debit = 0;
                                    $total_credit = 0;
                                @endphp
                                @foreach ($transaciton_info as $tx_info)
                                 
                                            @php
                                            $debit = 0;
                                            $credit = 0;
                                            $type = '';
                                            if ($tx_info->savings_account_id) {
                                                $account_no =  get_id_account_no('savings',$tx_info->savings_acc->prefix,$tx_info->savings_acc->code) ;
                                                if ($tx_info->type == 'debit') {
                                                    $type = "Savings Withdraw";
                                                    $debit = $tx_info->grand_total_amt;
                                                    $total_debit += $tx_info->grand_total_amt;
                                                }else{
                                                    $type = "Savings Deposit";
                                                    $credit = $tx_info->grand_total_amt;
                                                    $total_credit += $tx_info->grand_total_amt;
                                                }
                                                
                                            }elseif ($tx_info->loan_account_id) {
                                                $account_no =  get_id_account_no('loan',$tx_info->loan_acc->prefix,$tx_info->loan_acc->code) ;
                                                if ($tx_info->type == 'debit') {
                                                    $type = "Loan Provided";
                                                    $debit = $tx_info->grand_total_amt;
                                                    $total_debit += $tx_info->total_amt;
                                                }else{
                                                    $type = "Loan Collected";
                                                    $credit = $tx_info->grand_total_amt;
                                                    $total_credit += $tx_info->grand_total_amt;
                                                }
                                            }elseif ($tx_info->dps_account_id) {
                                                $account_no =  get_id_account_no('dps',$tx_info->dps_ac->prefix,$tx_info->dps_ac->code) ;
                                                if ($tx_info->type == 'debit') {
                                                    $type = "DPS Withdraw";
                                                    $debit = $tx_info->grand_total_amt;
                                                    $total_debit += $tx_info->grand_total_amt;
                                                }else{
                                                    $type = "DPS Deposit";
                                                    $credit = $tx_info->grand_total_amt;
                                                    $total_credit += $tx_info->grand_total_amt;
                                                }
                                            }elseif ($tx_info->double_benifit_account_id) {
                                                $account_no =  get_id_account_no('double_benifit',$tx_info->double_benifit_acc->prefix,$tx_info->double_benifit_acc->code) ;
                                                if ($tx_info->type == 'debit') {
                                                    $type = "Double Benifit Withdraw";
                                                    $debit = $tx_info->grand_total_amt;
                                                    $total_debit += $tx_info->grand_total_amt;
                                                }else{
                                                    $type = "Double Benifit Deposit";
                                                    $credit = $tx_info->grand_total_amt;
                                                    $total_credit += $tx_info->grand_total_amt;
                                                }
                                            }elseif ($tx_info->fdr_account_id) {
                                                $account_no =  get_id_account_no('fdr',$tx_info->fdr_acc->prefix,$tx_info->fdr_acc->code) ;
                                                if ($tx_info->type == 'debit') {
                                                    $type = "Loan From Member Withdraw";
                                                    $debit = $tx_info->grand_total_amt;
                                                    $total_debit += $tx_info->grand_total_amt;
                                                }else{
                                                    $type = "Loan From Member Deposit";
                                                    $credit = $tx_info->grand_total_amt;
                                                    $total_credit += $tx_info->grand_total_amt;
                                                }
                                            }elseif ($tx_info->bank_account_id) {
                                                $account_no = $tx_info->bank_account->account_no;
                                                if ($tx_info->type == 'debit') {
                                                    $type = "Bank Deposit( ".$tx_info->bank_account->bank_name." )";
                                                    $debit = $tx_info->grand_total_amt;
                                                    $total_debit += $tx_info->grand_total_amt;
                                                }else{
                                                    $type = "Bank Withdraw( ".$tx_info->bank_account->bank_name." )";
                                                    $credit = $tx_info->grand_total_amt;
                                                    $total_credit += $tx_info->grand_total_amt;
                                                }
                                            }elseif ($tx_info->tx_type == 'sundry repay' || $tx_info->tx_type == 'sundry payment' ) {
                                                $account_no = "N/A";
                                                if ($tx_info->type == 'debit') {
                                                    $type = "Sundry Deposit";
                                                    $debit = $tx_info->grand_total_amt;
                                                    $total_debit += $tx_info->grand_total_amt;
                                                }else{
                                                    $type = "Sundry Withdraw";
                                                    $credit = $tx_info->grand_total_amt;
                                                    $total_credit += $tx_info->grand_total_amt;
                                                }
                                            }elseif ($tx_info->expense_category_id) {
                                                $account_no = $tx_info->expense_category_inf->name;
                                                if ($tx_info->type == 'debit') {
                                                    $type = "Expense";
                                                    $debit = $tx_info->grand_total_amt;
                                                    $total_debit += $tx_info->grand_total_amt;
                                                }else{
                                                    $type = "Expense";
                                                    $credit = $tx_info->grand_total_amt;
                                                    $total_credit += $tx_info->grand_total_amt;
                                                }
                                            }
                                            elseif ($tx_info->income_category_id) {
                                                $account_no = $tx_info->income_category_inf->name;
                                                if ($tx_info->type == 'debit') {
                                                    $type = "Income";
                                                    $debit = $tx_info->grand_total_amt;
                                                    $total_debit += $tx_info->grand_total_amt;
                                                }else{
                                                    $type = "Income";
                                                    $credit = $tx_info->grand_total_amt;
                                                    $total_credit += $tx_info->grand_total_amt;
                                                }
                                            }else if ($tx_info->share_id) {
                                                $member = App\models\Member\Member::find($tx_info->share_id);
                                                $account_no =  get_id_account_no('share',$member->prefix_share,$member->code_share) ;
                                                if ($tx_info->type == 'debit') {
                                                    $type = "Share Withdraw";
                                                    $debit = $tx_info->grand_total_amt;
                                                    $total_debit += $tx_info->grand_total_amt;
                                                }else{
                                                    $type = "Share Deposit";
                                                    $credit = $tx_info->grand_total_amt;
                                                    $total_credit += $tx_info->grand_total_amt;
                                                }
                                            }else{
                                                $account_no = "N/A";
                                                if ($tx_info->type == 'debit') {
                                                    $type = "Others";
                                                    $debit = $tx_info->grand_total_amt;
                                                    $total_debit += $tx_info->grand_total_amt;
                                                }
                                                // else{
                                                //     $type = "Others";
                                                //     $credit = $tx_info->grand_total_amt;
                                                //     $total_credit += $tx_info->grand_total_amt;
                                                // }
                                            }
                                            @endphp

                                            @if ($debit == 0 && $credit == 0)
                                         
                                         @else
                                                
                                            <tr>
                                             <td>{{ ++$i }}</td>
                                             <td>{{ $account_no }}</td>
                                             <td>{{ $type }}</td>
                                             <td>{{ carbonDate($tx_info->tx_date) }}</td>
                                             <td>{{ $debit }}</td>
                                             <td>{{ $credit }}</td>
                                         </tr>
                                            @endif
                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-right">Total <span class="text-danger">(Without cash in hand calculation)</span></td>
                                    <td>{{ $total_debit }}</td>
                                    <td>{{ $total_credit }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <br><br>

                    {{-- <h5>In Words: {{ucwords(convert_number_to_words($total))}} Taka Only.</h5> --}}
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
