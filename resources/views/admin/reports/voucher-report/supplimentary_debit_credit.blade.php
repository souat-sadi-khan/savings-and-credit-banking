@extends('layouts.app', ['title' => _lang('Voucher Report'), 'modal' => 'lg'])


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
        <h1 data-placement="bottom" title="Voucher Report.">{{--<i class="fa fa-universal-access mr-4"></i>--}}
            {{_lang('Voucher Report')}}</h1>
        <p>{{_lang('Voucher Report. Here you can See Voucher Reports')}}</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
        {{-- {{ Breadcrumbs::render(($report_type == "DEBIT VOUCHER"?"debit":"credit").'-voucher') }} --}}
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
                    class="{{$report_type == "SUPPLIMENTARY DEBIT VOUCHER"?'bg-danger':'bg-success'}} text-light">
                            <b>{{$report_type}}</b></h4>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>

                                        <p style="margin:0px ; margin-top: -8px;">

                                            Report Of Date : <span class="ml-1">{{$dates['start_date']}}</span>

                                            @if ($dates['both'])
                                            <span class="badge badge-danger mx-2"> TO </span>
                                            {{ $dates['end_date'] }}
                                            @endif

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
                                    <th scope="col" style="width: 80px;">Sl No</th>
                                    <th scope="col">{{$report_type == "SUPPLIMENTARY DEBIT VOUCHER"?'Debit Head':'Credit Head'}}</th>
                                    <th scope="col">A/C No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($model)
                                @php
                                $total_amount = 0 ;
                                    $i = 0 ;
                                @endphp
                                 <tr>
                                            <td>{{++$i}}</td>
                                            <td>Cash In Hand</td>
                                            <td>
                                                N/A
                                            </td>
                                        <td></td>
                                            <td>{{number_format( $cash_in_hand,2)}}</td>
                                        </tr>
                                @foreach ($model as $transaction)
                                    {{-- checking if the variation is savings of not --}}
                                    @if ($transaction->savings_account_id)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>Savings</td>
                                            <td>
                                                {{get_id_account_no('savings',$transaction->savings_ac->prefix, $transaction->savings_ac->code)}}
                                            </td>
                                        <td>{{carbonDate($transaction->tx_date)}}</td>
                                            <td>{{number_format($transaction->grand_grand_total_amt,2)}}</td>
                                        </tr>
                                    @endif


                                    {{-- checking if the variation is loan of not --}}
                                    @if ($transaction->loan_account_id)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>Loan</td>
                                            <td>
                                                {{get_id_account_no('loan',$transaction->loan_acc->prefix, $transaction->loan_acc->code)}}
                                            </td>
                                        <td>{{carbonDate($transaction->tx_date)}}</td>
                                            <td>{{number_format($transaction->grand_total_amt,2)}}</td>
                                        </tr>
                                    @endif
                                    {{-- checking if the variation is dps of not --}}
                                    @if ($transaction->dps_account_id)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>DPS</td>
                                            <td>
                                                {{get_id_account_no('dps',$transaction->dps_ac->prefix, $transaction->dps_ac->code)}}
                                            </td>
                                        <td>{{carbonDate($transaction->tx_date)}}</td>
                                            <td>{{number_format($transaction->grand_grand_total_amt,2)}}</td>
                                        </tr>
                                    @endif
                                    {{-- checking if the variation is double benifit of not --}}
                                    @if ($transaction->double_benifit_account_id)

                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>Double Benifit</td>
                                            <td>
                                                {{get_id_account_no('double_benifit',$transaction->double_benifit_acc->prefix, $transaction->double_benifit_acc->code)}}
                                            </td>
                                        <td>{{carbonDate($transaction->tx_date)}}</td>
                                            <td>{{number_format($transaction->grand_grand_total_amt,2)}}</td>
                                        </tr>
                                    @endif

                                    {{-- checking if the variation is Loan From Member of not --}}
                                    @if ($transaction->fdr_account_id)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>Loan From Member</td>
                                            <td>
                                                {{get_id_account_no('fdr',$transaction->fdr_acc->prefix, $transaction->fdr_acc->code)}}
                                            </td>
                                        <td>{{carbonDate($transaction->tx_date)}}</td>
                                            <td>{{number_format($transaction->grand_total_amt,2)}}</td>
                                        </tr>
                                    @endif



                                    {{-- checking if the variation is salary payment of not --}}
                                    @if ($transaction->bank_account_id)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>Bank Transaction</td>
                                            <td>
                                                {{-- {{ dd($model->bank_account) }} --}}
                                                {{$transaction->bank_account->account_no}}
                                            </td>
                                        <td>{{carbonDate($transaction->tx_date)}}</td>
                                            <td>{{number_format($transaction->grand_grand_total_amt,2)}}</td>
                                        </tr>
                                    @endif

                                    {{-- checking if the variation is share_id of not --}}
                                    @if ($transaction->share_id)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>Share</td>
                                            <td>
                                                {{get_id_account_no('Share')}}
                                            </td>
                                        <td>{{carbonDate($transaction->tx_date)}}</td>
                                            <td>{{number_format($transaction->grand_grand_total_amt,2)}}</td>
                                        </tr>
                                    @endif

                                    {{-- checking if the variation is expense_id of not --}}
                                    @if ($transaction->expense_id)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>Expense</td>
                                            <td>
                                                {{get_id_account_no('expense')}}
                                            </td>
                                        <td>{{carbonDate($transaction->tx_date)}}</td>
                                            <td>{{number_format($transaction->grand_grand_total_amt,2)}}</td>
                                        </tr>
                                    @endif

                                    {{-- checking if the variation is expense_id of not --}}
                                    @if ($transaction->income_id)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>Income</td>
                                            <td>
                                                {{get_id_account_no('expense')}}
                                            </td>
                                        <td>{{carbonDate($transaction->tx_date)}}</td>
                                            <td>{{number_format($transaction->grand_grand_total_amt,2)}}</td>
                                        </tr>
                                    @endif


                                    @if ($transaction->sundry_id)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>Sundry</td>
                                            <td>
                                                N/A
                                            </td>
                                        <td>{{carbonDate($transaction->tx_date)}}</td>
                                            <td>{{number_format($transaction->grand_grand_total_amt,2)}}</td>
                                        </tr>
                                    @endif

{{--
                                    @php
                                        $total_amount += $transaction->grand_total_amt;
                                    @endphp --}}
                                @endforeach
                                <tr>
                                <td colspan="4" align="right">Total</td>
                                    <td style="text-align:left">{{number_format($total,2)}}</td>

                                </tr>
                                @else
                                <tr>
                                    <td colspan="5" align="center" style="color:red">No Record Found</td>
                                </tr>
                                @endif



                            </tbody>
                        </table>

                    </div>
                    <br>
                    <br>
                   @php
                       $total = $total_amount < 0 ? $total_amount * -1 : $total_amount ;
                       @endphp
                       <h5>In Words: {{ucwords($in_word)}} Taka Only.</h5>

                    <br><br><br><br>

                    <div class="row">
                        <div class="col-md-4 text-center">
                            <hr class="border-dark">
                            <p> Prepered By </p>
                        </div>
                        <div class="col-md-4 text-center">
                            <hr class="border-dark">
                            <p> Officer </p>
                        </div>
                        <div class="col-md-4 text-center">
                            <hr class="border-dark">
                            <p> Officer </p>
                        </div>
                    </div>


                </div>
                <div class="text-center">
                    @if ($total)


                    @php
                    $print_table = 'print_table';

                    @endphp

                    <a class="text-light btn-primary btn" onclick="printContent('{{ $print_table }}')" name="print"
                        id="print_receipt">
                        <i class="fa fa-print" aria-hidden="true"></i>
                        {{_lang('Print Voucher')}}

                    </a>
 @endif
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
