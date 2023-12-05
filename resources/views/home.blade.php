@extends('layouts.app', ['title' => 'Dahsboard', 'modal' => false])
@push('css')
<style>

    .card-1{
        background-color: #14c1d7eb;
        border: 1px solid #0192a5;
        margin-bottom: 20px;
    }
    .card-1-bottom{
        background-color: #02bed6;
    }
    .card-2{
        background-color: #4caf50;
        border: 1px solid #028808;
        margin-bottom: 20px;
    }
    .card-2-bottom{
        background-color: #3aa53f;
    }
    .card-3{
        background-color: #f9652c;
        border: 1px solid #b93603;
        margin-bottom: 20px;
    }
    .card-3-bottom{
        background-color: #eb4d10;
    }
    .card-4{
        background-color: #f9a72c;
        border: 1px solid #c07300;
        margin-bottom: 20px;
    }
    .card-4-bottom{
        background-color: #e38a06;
    }

    i.icon.fa{
        float: right;
        position: relative;
        top: 5px;
        left: -10px;
        opacity: 0.5;
        color: #0000008a;
    }
.info h4 {
    font-size: 16px;
}
    .info p {
        font-size: 20px;
        margin-top: 10px;
    }

</style>
<link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

@endpush

{{-- Header Option --}}
@section('page.header')
<div class="app-title shadow pb-2 text-center bg-danger text-white">
    <div class="text-center w-100">
        <h1 data-toggle="tooltip" data-placement="bottom"
            title="Savings and Credit Co-operative Management Software Dashboard"> {{_lang('Dashboard')}}</h1>
        <p>{{_lang('Dashboard for Savings and Credit Co-operative Management Software')}} </p>
    </div>
    {{-- <ul class="app-breadcrumb breadcrumb d-sm-block d-none">
        <li class="breadcrumb-item">{{ Breadcrumbs::render('home') }}</li>
    </ul> --}}
</div>
@stop

@section('content')
<!-- Basic initialization -->
<div class="card px-3 mb-3">
<div class="row">
    <div class="col-md-12" style="margin-top: 20px; ">
        <h4 class="mb-3 ">Today's Summary</h4>
    </div>
    {{-- User Count Card --}}
    <div class="col-md-3">
        <div class="card-1 pt-2 text-white rounded "><i class="icon fa fa-users fa-3x"></i>
            <div class="info p-3 ">
                <h4>Total User</h4>
                <p><b>
                        @php
                        $users = App\User::get();
                        echo count($users) - 1;
                        @endphp
                    </b></p>
            </div>
{{--            <div class="card-1-bottom text-center py-1 mt-3">--}}
{{--                More Info &nbsp;--}}
{{--                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>--}}
{{--            </div>--}}
        </div>
    </div>

    {{-- Employee Card --}}
    <div class="col-md-3">
        <div class="card-2 pt-2 text-white rounded"><i class="icon fa fa-user fa-3x"></i>
            <div class="info p-3">
                <h4>Total Employee</h4>
                <p><b>
                        @php
                        $employee = App\models\employee\Employee::get();
                        echo count($employee);
                        @endphp
                    </b></p>
            </div>
{{--            <div class="card-2-bottom text-center py-1 mt-3">--}}
{{--                More Info &nbsp;--}}
{{--                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>--}}
{{--            </div>--}}

        </div>
    </div>

    {{-- Loan Provided card --}}
    <div class="col-md-3">
        <div class="card-3 pt-2 text-white rounded"><i class="icon fa fa-bar-chart  fa-3x"></i>
            <div class="info p-3">
                <h4>Loan Provided</h4>
                <p><b>
                        @php
                        $today = Carbon\Carbon::createFromFormat('Y-m-d', date("Y-m-d"))->format('Y-m-d');

                        $provided_loan = App\models\utility\Transaction::where('tx_type','loan payment')->where('tx_date', $today)->sum('total_amt');
                        echo $provided_loan;
                        @endphp
                    </b></p>
            </div>
{{--            <div class="card-3-bottom text-center py-1 mt-3">--}}
{{--                More Info &nbsp;--}}
                <!-- <i class="fa fa-long-arrow-right" aria-hidden="true"></i> -->
{{--            </div>--}}

        </div>
    </div>

    {{-- Loan Collected card --}}
    <div class="col-md-3">
        <div class="card-4 pt-2 text-white rounded"><i class="icon fa fa-money fa-3x"></i>
            <div class="info p-3">
                <h4>Loan Collected</h4>
                <p><b>
                        @php

                        $collected_loan = App\models\utility\Transaction::where('tx_type','loan repay')->where('tx_date',$today)->sum('grand_total_amt');
                        echo $collected_loan;
                        @endphp
                    </b></p>
            </div>
{{--            <div class="card-4-bottom text-center py-1 mt-3">--}}
{{--                More Info &nbsp;--}}
{{--                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>--}}
{{--            </div>--}}

        </div>
    </div>

    {{-- Loan DPS Deposit --}}
    <div class="col-md-3">
        <div class="card-2 pt-2 text-white rounded"><i class="icon fa fa-handshake-o  fa-3x"></i>
            <div class="info p-3">
                <h4>DPS Deposit</h4>
                <p><b>
                        @php

                        $dps_deposit = App\models\utility\Transaction::where('tx_type','dps payment')->where('tx_date',$today)->sum('grand_total_amt');
                        echo $dps_deposit;
                        @endphp
                    </b></p>
            </div>
{{--            <div class="card-2-bottom text-center py-1 mt-3">--}}
{{--                More Info &nbsp;--}}
{{--                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>--}}
{{--            </div>--}}

        </div>
    </div>


    {{-- Loan DPS Withdraw --}}
    <div class="col-md-3">
        <div class="card-4 pt-2 text-white rounded"><i class="icon fa fa-calculator  fa-3x"></i>
            <div class="info p-3">
                <h4>DPS Withdraw</h4>
                <p><b>
                        @php

                        $dps_withdraw = App\models\utility\Transaction::where('tx_type','dps repay')->where('tx_date',$today)->sum('grand_total_amt');
                        echo $dps_withdraw;
                        @endphp
                    </b></p>
            </div>
{{--            <div class="card-4-bottom text-center py-1 mt-3">--}}
{{--                More Info &nbsp;--}}
{{--                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>--}}
{{--            </div>--}}

        </div>
    </div>


    {{-- Double Benifit  Deposit --}}
    <div class="col-md-3">
        <div class="card-1 pt-2 text-white rounded"><i class="icon fa fa-line-chart   fa-3x"></i>
            <div class="info p-3">
                <h4>Double Benifit Deposit</h4>
                <p><b>
                        @php

                        $double_benifit_deposit = App\models\utility\Transaction::where('tx_type','double benifit payment')->where('tx_date',$today)->sum('grand_total_amt');
                        echo $double_benifit_deposit;
                        @endphp
                    </b></p>
            </div>
{{--            <div class="card-1-bottom text-center py-1 mt-3">--}}
{{--                More Info &nbsp;--}}
{{--                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>--}}
{{--            </div>--}}

        </div>
    </div>


    {{-- Double Benifit  withdraw --}}
    <div class="col-md-3">
        <div class="card-3 pt-2 text-white rounded"> <i class="icon fa fa-cc-visa  fa-3x"></i>
            <div class="info p-3">
                <h4>Double Benifit Withdraw</h4>
                <p><b>
                        @php

                        $double_benifit_withdraw = App\models\utility\Transaction::where('tx_type','double benifit repay')->where('tx_date',$today)->sum('grand_total_amt');
                        echo $double_benifit_withdraw;
                        @endphp
                    </b></p>
            </div>
{{--        <div class="card-3-bottom text-center py-1 mt-3">--}}
{{--            More Info &nbsp;--}}
{{--            <i class="fa fa-long-arrow-right" aria-hidden="true"></i>--}}
{{--        </div>--}}

    </div>
    </div>


    {{-- Loan From Member deposit --}}
    <div class="col-md-3">
        <div class="card-4 pt-2 text-white rounded"><i class="icon fa fa-area-chart  fa-3x"></i>
            <div class="info p-3">
                <h4>Member Loan deposit</h4>
                <p><b>
                        @php

                        $member_loan_deposit = App\models\utility\Transaction::where('tx_type','fdr payment')->where('tx_date',$today)->sum('total_amt');
                        echo $member_loan_deposit;
                        @endphp
                    </b></p>
            </div>
{{--            <div class="card-4-bottom text-center py-1 mt-3">--}}
{{--                More Info &nbsp;--}}
{{--                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>--}}
{{--            </div>--}}

        </div>
    </div>


    {{-- Loan From Member withdraw --}}
    <div class="col-md-3">
        <div class="card-3 pt-2 text-white rounded"><i class="icon fa fa-usd  fa-3x"></i>
            <div class="info p-3">
                <h4>Member Loan withdraw</h4>
                <p><b>
                        @php

                        $member_loan_withdraw = App\models\utility\Transaction::where('tx_type','fdr repay')->where('tx_date',$today)->sum('grand_total_amt');
                        echo $member_loan_withdraw;
                        @endphp
                    </b></p>
            </div>
{{--            <div class="card-3-bottom text-center py-1 mt-3">--}}
{{--                More Info &nbsp;--}}
{{--                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>--}}
{{--            </div>--}}

        </div>
    </div>


    {{-- share deposit --}}
    <div class="col-md-3">
        <div class="card-2 pt-2 text-white rounded"><i class="icon fa fa-cc-mastercard fa-3x"></i>
            <div class="info p-3">
                <h4>Share deposit</h4>
                <p><b>
                        @php

                        $share_deposit = App\models\utility\Transaction::where('tx_type','share payment')->where('tx_date',$today)->sum('grand_total_amt');
                        echo $share_deposit;
                        @endphp
                    </b></p>
            </div>
{{--            <div class="card-2-bottom text-center py-1 mt-3">--}}
{{--                More Info &nbsp;--}}
{{--                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>--}}
{{--            </div>--}}

        </div>
    </div>


    {{-- share withdraw --}}
    <div class="col-md-3">
        <div class="card-1 pt-2 text-white rounded"><i class="icon fa fa-eur  fa-3x"></i>
            <div class="info p-3">
                <h4>Share withdraw</h4>
                <p><b>
                        @php

                        $share_withdraw = App\models\utility\Transaction::where('tx_type','share repay')->where('tx_date',$today)->sum('grand_total_amt');
                        echo $share_withdraw;
                        @endphp
                    </b></p>
            </div>
{{--            <div class="card-1-bottom text-center py-1 mt-3">--}}
{{--                More Info &nbsp;--}}
{{--                <i class="fa fa-long-arrow-right" aria-hidden="true"></i>--}}
{{--            </div>--}}

        </div>
    </div>



</div>
</div>


    {{-- =============   The following section is for calculation of charts elements   ========= --}}
    @php
        $date = \Carbon\Carbon::today()->subDays(30)->format('Y-m-d');
        for ($i = 1; $i <= 30; $i++) {

         
                $date = \Carbon\Carbon::createFromFormat('Y-m-d',$date);
                $date = $date->addDays(1);
                $date = $date->format('Y-m-d');
                $dates[]=$date;
            

                // Debit Credit Calculation
                $debit[] = App\models\utility\Transaction::where('type','debit')->where('tx_date',$date)->sum('grand_total_amt');
                $credit[] = App\models\utility\Transaction::where('type','credit')->where('tx_date',$date)->sum('grand_total_amt');

                // loan calculation
                $loan_provided[] = App\models\utility\Transaction::where('tx_type','loan payment')->where('tx_date',$date)->sum('total_amt');
                $loan_collected[] = App\models\utility\Transaction::where('tx_type','loan repay')->where('tx_date',$date)->sum('grand_total_amt');

                // dps calculation
                $dps_deposit_info[] = App\models\utility\Transaction::where('tx_type','dps payment')->where('tx_date',$date)->sum('grand_total_amt');
                $dps_withdraw_info[] = App\models\utility\Transaction::where('tx_type','dps repay')->where('tx_date',$date)->sum('grand_total_amt');

                // double_benifit calculation
                $double_benifit_deposit_info[] = App\models\utility\Transaction::where('tx_type','double benifit payment')->where('tx_date',$date)->sum('grand_total_amt');

                $double_benifit_withdraw_info[] = App\models\utility\Transaction::where('tx_type','double benifit repay')->where('tx_date',$date)->sum('grand_total_amt');

                // member_loan calculation
                $member_loan_deposit_info[] = App\models\utility\Transaction::where('tx_type','fdr payment')->where('tx_date',$date)->sum('total_amt');
                $member_loan_withdraw_info[] = App\models\utility\Transaction::where('tx_type','fdr repay')->where('tx_date',$date)->sum('grand_total_amt');

                // share calculation
                $share_deposit_info[] = App\models\utility\Transaction::where('tx_type','share payment')->where('tx_date',$date)->sum('grand_total_amt');
                $share_withdraw_info[] = App\models\utility\Transaction::where('tx_type','share repay')->where('tx_date',$date)->sum('grand_total_amt');
            
        }
        // dd($dps_withdraw_info);
     

    // the following section is for declaring chart class
    $debit_credit_chart = new App\Charts\DebitCreditChart;
    $debit_credit_chart->labels($dates);
    $debit_credit_chart->dataset('Credit', 'line', $credit)->backgroundColor('rgba(0,255,0,.8)');
    $debit_credit_chart->dataset('Debit', 'line', $debit)->backgroundColor('rgba(255,0,0,.8)');

    // create chart class Provided and Collected Loan
    $loan_chart = new App\Charts\LoanChart;
    $loan_chart->labels($dates);
    $loan_chart->dataset('Collected', 'bar', $loan_collected)->backgroundColor('rgba(0,255,0,.8)');
    $loan_chart->dataset('Provided', 'bar', $loan_provided)->backgroundColor('rgba(255,0,0,.8)');

    // create chart class Of Dps deposit and Withdraw
    $dps_chart = new App\Charts\DpsChart;
    $dps_chart->labels($dates);
    $dps_chart->dataset('Deposit', 'line', $dps_deposit_info)->backgroundColor('rgba(0,255,0,.8)');
    $dps_chart->dataset('Withdraw', 'line', $dps_withdraw_info)->backgroundColor('rgba(255,0,0,.8)');

    // create chart class Of Double Benifit deposit and Withdraw
    $double_benifit_chart = new App\Charts\DoubleBenifitChart;
    $double_benifit_chart->labels($dates);
    $double_benifit_chart->dataset('Deposit', 'bar', $double_benifit_deposit_info)->backgroundColor('rgba(0,255,0,.8)');
    $double_benifit_chart->dataset('Withdraw', 'bar', $double_benifit_withdraw_info)->backgroundColor('rgba(255,0,0,.8)');

    // create chart class Of Member Loan deposit and Withdraw
    $loan_from_member_chart = new App\Charts\LoanFromMemberChart;
    $loan_from_member_chart->labels($dates);
    $loan_from_member_chart->dataset('Deposit', 'line', $member_loan_deposit_info)->backgroundColor('rgba(0,255,0,.8)');
    $loan_from_member_chart->dataset('Withdraw', 'line', $member_loan_withdraw_info)->backgroundColor('rgba(255,0,0,.8)');

    // create chart class Of Member Loan deposit and Withdraw
    $share_chart = new App\Charts\ShareChart;
    $share_chart->labels($dates);
    $share_chart->dataset('Deposit', 'line', $share_deposit_info)->backgroundColor('rgba(0,255,0, .8)');
    $share_chart->dataset('Withdraw', 'line', $share_withdraw_info)->backgroundColor('rgba(255,0,0, .8)');

    @endphp


    {{-- Debit Credit chart show --}}

    <div class="tile">
        <div class="tile-head mb-2">
            <div class="col-md-12">
                <h5 class="text- mt-2">Debit Credit Of Previous 30 Days</h5>
            </div>
            <hr>
        </div>
        <div class="tile-body">
            {!! $debit_credit_chart->container() !!}
        </div>
    </div>

    {{-- Show  dps and Loan Chart --}}

    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <div class="tile-head mb-2">
                    <div class="col-md-12">
                        <h5 class="text- mt-2">Loan Summary Of Previous 30 Days</h5>
                    </div>
                    <hr>
                </div>
                <div class="tile-body">
                    {!! $loan_chart->container() !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">
                <div class="tile-head mb-2">
                    <div class="col-md-12">
                        <h5 class="text- mt-2">DPS Summary Of Previous 30 Days</h5>
                    </div>
                    <hr>
                </div>
                <div class="tile-body">
                    {!! $dps_chart->container() !!}
                </div>
            </div>
        </div>
    </div>


    {{-- Show  double benifit and loan form member Chart --}}

    <div class="row">
        <div class="col-md-6">
            <div class="tile">
                <div class="tile-head mb-2">
                    <div class="col-md-12">
                        <h5 class="text- mt-2">Double Benifit Summary Of Previous 30 Days</h5>
                    </div>
                    <hr>
                </div>
                <div class="tile-body">
                    {!! $double_benifit_chart->container() !!}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="tile">
                <div class="tile-head mb-2">
                    <div class="col-md-12">
                        <h5 class="text- mt-2">Loan From Member Summary Of Previous 30 Days</h5>
                    </div>
                    <hr>
                </div>
                <div class="tile-body">
                    {!! $loan_from_member_chart->container() !!}
                </div>
            </div>
        </div>
    </div>


    {{-- Share Summary chart show --}}

    <div class="tile">
        <div class="tile-head mb-2">
            <div class="col-md-12">
                <h5 class="text- mt-2">Share Summary Of Previous 30 Days</h5>
            </div>
            <hr>
        </div>
        <div class="tile-body">
            {!! $share_chart->container() !!}
        </div>
    </div>

    <!-- /basic initialization -->
    @stop

    @push('scripts')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {!! $debit_credit_chart->script() !!}
    {!! $loan_chart->script() !!}
    {!! $dps_chart->script() !!}
    {!! $double_benifit_chart->script() !!}
    {!! $loan_from_member_chart->script() !!}
    {!! $share_chart->script() !!}

    @endpush
