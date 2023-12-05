<?php

namespace App\Http\Controllers\Admin\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\bank_accounts\BankAccount;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use App\models\utility\Transaction;


class BankTransactionReportController extends Controller
{

    public function index()
    {
        return view('admin.reports.bank-tx-report.index');
    }


    public function store(Request $request)
    {
        $report_type =  $request->report_type;

        $start_date =  Carbon::createFromFormat('d/m/Y',  $request->start_date)->format('Y-m-d');
        $end_date =  Carbon::createFromFormat('d/m/Y',  $request->end_date)->format('Y-m-d');

        if ($start_date > $end_date) {

            throw  ValidationException::withMessages(['message' => 'Remember: Start Date Cannot Be Greater Than The End Date.']);
        }
        $dates['start_date'] = Carbon::createFromFormat('d/m/Y',  $request->start_date)->format('d-M, Y');
        $dates['end_date'] = Carbon::createFromFormat('d/m/Y',  $request->end_date)->format('d-M, Y');
        $dates['both'] = $start_date == $end_date ? false : true;



        $organization['name'] = get_option('company_name');
        $organization['address'] = get_option('address');
        $organization['phone'] = get_option('phone');
        $organization['email'] = get_option('email');

        if ($report_type == 'BANK DEPOSIT GENERAL REPORT') {
            // calculating all incomes
            $total = 0;
            $accounts = BankAccount::all();

            foreach ($accounts as $account) {
                $head_amt[$account->id] = Transaction::where('bank_account_id', $account->id)->where('tx_type', 'bank payment')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $total += $head_amt[$account->id];
            }
            return view('admin.reports.bank-tx-report.general_report', compact('report_type', 'organization', 'dates', 'head_amt', 'total', 'accounts'));
        } elseif ($report_type == 'BANK WITHDRAW GENERAL REPORT') {
            // now get expenses that are 
            $total = 0;
            $accounts = BankAccount::all();

            foreach ($accounts as $account) {
                $head_amt[$account->id] = Transaction::where('bank_account_id', $account->id)->where('tx_type', 'bank repay')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $total += $head_amt[$account->id];
            }
            return view('admin.reports.bank-tx-report.general_report', compact('report_type', 'organization', 'dates', 'head_amt', 'total', 'accounts'));
        } elseif ($report_type == 'BANK ACCOUNT WISE DEPOSIT REPORT') {
            $account_id = $request->account_id;

            $account_info = BankAccount::find($account_id);
            $tx_info = Transaction::where('bank_account_id', $account_id)->where('tx_type', 'bank payment')->whereBetween('tx_date', [$start_date, $end_date])->get();

            $total = Transaction::where('bank_account_id', $account_id)->where('tx_type', 'bank payment')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');

            return view('admin.reports.bank-tx-report.account_wise_report', compact('report_type', 'organization', 'dates', 'account_info', 'tx_info', 'total'));
        } elseif ($report_type == 'BANK ACCOUNT WISE WITHDRAW REPORT') {
            $account_id = $request->account_id;

            $account_info = BankAccount::find($account_id);
            $tx_info = Transaction::where('bank_account_id', $account_id)->where('tx_type', 'bank repay')->whereBetween('tx_date', [$start_date, $end_date])->get();

            $total = Transaction::where('bank_account_id', $account_id)->where('tx_type', 'bank repay')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');

            return view('admin.reports.bank-tx-report.account_wise_report', compact('report_type', 'organization', 'dates', 'account_info', 'tx_info', 'total'));
        } elseif ($report_type == "BANK DEPOSIT VS WITHDRAW REPORT") {
            // calculating all Deposit
            $total_deposit = 0;
            $accounts = BankAccount::all();

            foreach ($accounts as $account) {
                $deposit_head_amt[$account->id] = Transaction::where('bank_account_id', $account->id)->where('tx_type', 'bank payment')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $total_deposit += $deposit_head_amt[$account->id];
            }

            $total_withdraw = 0;
            foreach ($accounts as $account) {
                $withdraw_head_amt[$account->id] = Transaction::where('bank_account_id', $account->id)->where('tx_type', 'bank repay')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $total_withdraw += $withdraw_head_amt[$account->id];
            }


            return view('admin.reports.bank-tx-report.deposit_vs_withdraw_report', compact('report_type', 'organization', 'dates', 'accounts', 'deposit_head_amt', 'total_deposit', 'withdraw_head_amt', 'total_withdraw'));
        }
    }

    // in the following function the modal for selecting date will be opened
    public function edit($report_type)
    {
        // dd($report_type);
        if ($report_type == 'BANK ACCOUNT WISE DEPOSIT REPORT' || $report_type == 'BANK ACCOUNT WISE WITHDRAW REPORT') {
            $bank_accounts = BankAccount::all();
            return view('admin.reports.bank-tx-report.report_form', compact('report_type', 'bank_accounts'));
        }
        return view('admin.reports.bank-tx-report.report_form', compact('report_type'));
    }
}
