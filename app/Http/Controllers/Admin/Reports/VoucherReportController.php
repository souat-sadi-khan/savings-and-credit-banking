<?php

namespace App\Http\Controllers\Admin\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\utility\Transaction;
use App\Setting;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
// use NumberFormatter;
use NumberFormatter;

class VoucherReportController extends Controller
{

    // it is index function to return the main page of the report
    public function index()
    {
        return view('admin.reports.voucher-report.index');
    }


    // here the report will be generated and will be shown in a new page
    public function store(Request $request)
    {
        $report_type =  $request->report_type;
        // dd($report_type);
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

        if ($report_type == "CREDIT VOUCHER") {

            $report = trial_balance($start_date, $end_date);
            $credit = $report['credit'];
            $head_amt['total'] = $report['total_credit'];

            foreach ($credit as $key => $value) {
                $head_amt[$key] = $value;
            }
            if ($head_amt['total'] == 0) {
                $head_amt['found'] = false;
            } else {
                $head_amt['found'] = true;
            }


            $head_amt['In Word'] = convert_number_to_words($head_amt['total'] < 0 ? $head_amt['total'] * -1 : $head_amt['total']);

            return view('admin.reports.voucher-report.debit_credit_voucher', compact('report_type', 'organization', 'dates', 'head_amt'));

            // ::::::::::::::      the following section is for debit voucher ::::::::::::
        } else if ($report_type == "DEBIT VOUCHER") {
            $report = trial_balance($start_date, $end_date);
            $debit = $report['debit'];
            $head_amt['total'] = $report['total_debit'];

            foreach ($debit as $key => $value) {
                $head_amt[$key] = $value;
            }
            if ($head_amt['total'] == 0) {
                $head_amt['found'] = false;
            } else {
                $head_amt['found'] = true;
            }


            $head_amt['In Word'] = convert_number_to_words($head_amt['total'] < 0 ? $head_amt['total'] * -1 : $head_amt['total']);

            return view('admin.reports.voucher-report.debit_credit_voucher', compact('report_type', 'organization', 'dates', 'head_amt'));
        } else if ($report_type == "SUPPLIMENTARY CREDIT VOUCHER") {
            $model = Transaction::where('type', 'credit')->whereBetween('tx_date', [$start_date, $end_date])->get();

            $report = trial_balance($start_date, $end_date);
            $cash_in_hand = $report['credit']['Cash In Hand'];

            $total = $report['total_credit'];
            $in_word = convert_number_to_words($total < 0 ? $total * -1 : $total);
            return view('admin.reports.voucher-report.supplimentary_debit_credit', compact('report_type', 'organization', 'dates', 'model', 'cash_in_hand', 'total', 'in_word'));
        } else if ($report_type == "SUPPLIMENTARY DEBIT VOUCHER") {
            $model = Transaction::where('type', 'debit')->whereBetween('tx_date', [$start_date, $end_date])->get();

            $report = trial_balance($start_date, $end_date);
            $cash_in_hand = $report['debit']['Cash In Hand'];

            $total = $report['total_debit'];
            $in_word = convert_number_to_words($total < 0 ? $total * -1 : $total);
            return view('admin.reports.voucher-report.supplimentary_debit_credit', compact('report_type', 'organization', 'dates', 'model', 'cash_in_hand', 'total', 'in_word'));
        } else if ($report_type == 'CASH POSITION MEMO') {

            $head_amt['Opening Balance'] = 0;
            $head_amt['Total Credit'] = 0;
            $head_amt['Total Debit'] = 0;
            $head_amt['Cash In Hand'] = 0;

            // calculating total credit

            $report = trial_balance($start_date, $end_date);
            $head_amt['Opening Balance'] = $report['opening']['Cash In Hand'];
            // debit and credit in cash in hand is just reverse of normal case
            $head_amt['Total Credit'] = $report['debit']['Cash In Hand'];
            $head_amt['Total Debit'] = $report['credit']['Cash In Hand'];
            $head_amt['Cash In Hand'] = $head_amt['Opening Balance'] + $head_amt['Total Credit'] -  $head_amt['Total Debit'];
            // Checking if Debit and credit forund or not. It is used for showing data into data tabel . if not found any data then it will show record not found
            if ($head_amt['Total Credit'] == 0 &&  $head_amt['Total Debit'] = 0) {
                $head_amt['found'] = false;
            } else {
                $head_amt['found'] = true;
            }
            // $in_word = new NumberFormatter("en", NumberFormatter::SPELLOUT);
            // $head_amt['In Words'] = $in_word->format($head_amt['Cash In Hand']);

            // dd($head_amt['Cash In Hand']);
            $head_amt['In Word'] = convert_number_to_words($head_amt['Cash In Hand'] < 0 ? $head_amt['Cash In Hand'] * -1 : $head_amt['Cash In Hand']);


            return view('admin.reports.voucher-report.cash_position_memo', compact('report_type', 'organization', 'dates', 'head_amt'));
        } else {
            throw  ValidationException::withMessages(['message' => 'Ha Ha Ha ... How Funny You Are. Please Be Serious And Interact With Me.']);
        }
    }


    // in the following function the modal for selecting date will be opened
    public function edit($report_type)
    {
        return view('admin.reports.voucher-report.report_form', compact('report_type'));
    }
}
