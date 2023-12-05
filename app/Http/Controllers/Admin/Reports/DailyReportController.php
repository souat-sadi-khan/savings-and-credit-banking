<?php

namespace App\Http\Controllers\Admin\Reports;

use App\models\utility\ExpenseCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\employee\PayrollTransaction;
use App\models\utility\IncomeCategory;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use App\models\utility\Transaction;


class DailyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.daily-report.index');
    }


    // here the calculation for report will be performed
    public function store(Request $request)
    {
        $report_type =  $request->report_type;
        $start_date =  Carbon::createFromFormat('d/m/Y',  $request->start_date)->format('Y-m-d');

        $report_date = Carbon::createFromFormat('d/m/Y',  $request->start_date)->format('d-M, Y');

        $organization['name'] = get_option('company_name');
        $organization['address'] = get_option('address');
        $organization['phone'] = get_option('phone');
        $organization['email'] = get_option('email');

        if ($report_type == 'DAILY STATEMENT OF AFFAIRS') {

            // All withdraws
            $savings_withdraw = Transaction::where('tx_type', 'savings repay')->where('tx_date', '<=', $start_date)->sum('grand_total_amt');
            $dps_withdraw = Transaction::where('tx_type', 'dps repay')->where('tx_date', '<=', $start_date)->sum('grand_total_amt');
            $double_benifit_withdraw = Transaction::where('tx_type', 'double benifit repay')->where('tx_date', '<=', $start_date)->sum('grand_total_amt');
            $loan_from_member_withdraw = Transaction::where('tx_type', 'fdr repay')->where('tx_date', '<=', $start_date)->sum('grand_total_amt');
            $share_withdraw = Transaction::where('tx_type', 'share repay')->where('tx_date', '<=', $start_date)->sum('grand_total_amt');
            $sundry_withdraw = Transaction::where('tx_type', 'sundry payment')->where('tx_date', '<=', $start_date)->sum('grand_total_amt');



            $liability_head_amt['Savings Deposit'] = Transaction::where('tx_type', 'savings payment')->where('tx_date', '<=', $start_date)->sum('grand_total_amt') - $savings_withdraw;

            $liability_head_amt['DPS Deposit'] = Transaction::where('tx_type', 'dps payment')->where('tx_date', '<=', $start_date)->sum('grand_total_amt') - $dps_withdraw;

            $liability_head_amt['Double Benifit Deposit'] = Transaction::where('tx_type', 'double benifit payment')->where('tx_date', '<=', $start_date)->sum('grand_total_amt') - $double_benifit_withdraw;

            $liability_head_amt['Loan From Member Deposit'] = Transaction::where('tx_type', 'fdr payment')->where('tx_date', '<=', $start_date)->sum('total_amt') - $loan_from_member_withdraw;

            $liability_head_amt['Share Deposit'] = Transaction::where('tx_type', 'share payment')->where('tx_date', '<=', $start_date)->sum('grand_total_amt') - $share_withdraw;

            $liability_head_amt['Sundry Deposit'] = Transaction::where('tx_type', 'sundry repay')->where('tx_date', '<=', $start_date)->sum('grand_total_amt') - $sundry_withdraw;


            // claculate cash in hand
            $asset_head_amt['Cash In Hand'] = Transaction::where('cash_in_hand', '1')->sum('grand_total_amt');

            // loan related calculation 
            $loan_collected = Transaction::where('tx_type', 'loan repay')->where('tx_date', '<=', $start_date)->sum('total_amt');
            $interest_collected_loan = Transaction::where('tx_type', 'loan repay')->where('tx_date', '<=', $start_date)->sum('total_interest_amt');
            $loan_provided = Transaction::where('tx_type', 'loan payment')->where('tx_date', '<=', $start_date)->sum('total_amt');

            $asset_head_amt['Loan General AC'] = $loan_provided - $loan_collected;

            // calculating all incomes
            $total_income = 0;
            $income_cat_model = IncomeCategory::all();

            foreach ($income_cat_model as $income_cats) {
                $liability_head_amt[$income_cats->name] = Transaction::where('income_category_id', $income_cats->id)->where('tx_date', '<=', $start_date)->sum('grand_total_amt');
                $total_income += $liability_head_amt[$income_cats->name];
            }
            $total_income += $interest_collected_loan;

            $liability_head_amt['Interest Receivable'] = $interest_collected_loan;
            // $liability_head_amt['Investment Deposit'] = 0;

            $liability_head_amt['Opening Balance'] = $asset_head_amt['Cash In Hand'];
            // get bank deposit
            $bank_deposit = Transaction::where('tx_type', 'bank payment')->where('tx_date', $start_date)->sum('grand_total_amt');
            $bank_withdraw =  Transaction::where('tx_type', 'bank repay')->where('tx_date', $start_date)->sum('grand_total_amt');

            $asset_head_amt['Balance With Other Bank'] = $bank_deposit - $bank_withdraw;

            // get salary payment
            $asset_head_amt['Salary Payment'] = PayrollTransaction::where('created_at', $start_date)->sum('amount');

            // now get expenses that are asset
            $total_expense = 0;
            $expense_cat_model = ExpenseCategory::where('asset', 'Yes')->get();

            foreach ($expense_cat_model as $expense_cats) {
                $asset_head_amt[$expense_cats->name] = Transaction::where('expense_category_id', $expense_cats->id)->where('tx_date', $start_date)->sum('grand_total_amt');
                $total_expense += $asset_head_amt[$expense_cats->name];
            }

            // now calculate final value of cash in hand 

            $asset_head_amt['Cash In Hand'] += ($liability_head_amt['Savings Deposit'] + $liability_head_amt['DPS Deposit'] + $liability_head_amt['Double Benifit Deposit'] + $liability_head_amt['Loan From Member Deposit'] + $liability_head_amt['Share Deposit'] + $liability_head_amt['Sundry Deposit']   + $total_income)
                -
                ($asset_head_amt['Balance With Other Bank'] + $asset_head_amt['Loan General AC'] + $asset_head_amt['Salary Payment'] + $total_expense);

            // calculating total liability without investment deposit
            $total_liability = 0;
            // $i = 0
            foreach ($liability_head_amt as  $key => $value) {
                $liability_keys[] = $key;
                $total_liability += $value;
            }


            // calculating total liability without investment deposit
            $total_asset = 0;
            // $i = 0
            foreach ($asset_head_amt as  $key => $value) {
                $asset_keys[] = $key;
                $total_asset += $value;
            }
            // the following value will be added with investment deposit amount to calculate current cash in hand




            $liability_length = count($liability_head_amt);
            $asset_length = count($asset_head_amt);

            $row_no = $asset_length > $liability_length ? $asset_length : $liability_length;

            // dd($row_no);

            return view('admin.reports.daily-report.daily_affairs', compact('report_type', 'organization', 'report_date', 'liability_head_amt', 'total_liability', 'asset_head_amt', 'total_asset', 'row_no', 'asset_length', 'liability_length', 'liability_keys', 'asset_keys'));

            // report for 'DAILY COLLECTION SHEET OF LOAN'
        } else if ($report_type == 'DAILY COLLECTION SHEET OF LOAN') {
            $daily_loan_collection = Transaction::where('tx_type', 'loan repay')->where('tx_date', $start_date)->get();
            $total_collection = Transaction::where('tx_type', 'loan repay')->where('tx_date', $start_date)->sum('grand_total_amt');
            $in_words = convert_number_to_words($total_collection);
            return view('admin.reports.daily-report.daily_loan_colleciton', compact('report_type', 'organization', 'report_date', 'daily_loan_collection', 'total_collection', 'in_words', 'start_date'));
        }
    }


    // in the following function the modal for selecting date will be opened

    public function edit($report_type)
    {
        return view('admin.reports.daily-report.report_form', compact('report_type'));
    }
}
