<?php

namespace App\Http\Controllers\Admin\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\utility\Transaction;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class ServiceReportController extends Controller
{

    public function index()
    {
        return view('admin.reports.service-report.index');
    }


    public function store(Request $request)
    {
        $report_type =  $request->report_type;
        $report_head =  $request->report_head;
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

        if ($report_head == 'Loan') {
            $loan_provid_confirmation = false;
            $loan_collect_confirmation = false;
            $total = 0;
            $total_provided = 0;
            $total_collected = 0;
            $max_row = 0;
            $info = '';
            $loan_provided = '';
            $loan_collected = '';
            $in_word = '';
            $no_of_collection = 0;
            $no_of_provided = 0;
            if ($report_type == 'LOAN PROVIDED') {

                $info = Transaction::where('tx_type', 'loan payment')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total = Transaction::where('tx_type', 'loan payment')->whereBetween('tx_date', [$start_date, $end_date])->sum('total_amt');
                $loan_provid_confirmation = true;
                $in_word = convert_number_to_words($total);
            } elseif ($report_type == 'LOAN COLLECTED') {
                $info = Transaction::where('tx_type', 'loan repay')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total = Transaction::where('tx_type', 'loan repay')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $loan_collect_confirmation = true;
                $in_word = convert_number_to_words($total);
            } elseif ($report_type == 'LOAN PROVIDED & COLLECTED') {
                $loan_provided = Transaction::where('tx_type', 'loan payment')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total_provided = Transaction::where('tx_type', 'loan payment')->whereBetween('tx_date', [$start_date, $end_date])->sum('total_amt');
                $loan_provid_confirmation = true;

                $loan_collected = Transaction::where('tx_type', 'loan repay')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total_collected = Transaction::where('tx_type', 'loan repay')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $loan_collect_confirmation = true;

                $no_of_provided = count($loan_provided);
                $no_of_collection =  count($loan_collected);
                $max_row = $no_of_collection > $no_of_provided ? $no_of_collection : $no_of_provided;
            }
            return view('admin.reports.service-report.loan_report', compact('report_type', 'organization', 'dates', 'loan_provid_confirmation', 'loan_collect_confirmation', 'total_provided', 'total_collected', 'max_row', 'loan_provided', 'loan_collected', 'in_word', 'info', 'total', 'no_of_provided', 'no_of_collection'));
        } elseif ($report_head == 'DPS') {
            $dps_withdraw_confirmation = false;
            $dps_deposit_confirmation = false;
            $total = 0;
            $total_withdraw = 0;
            $total_deposit = 0;
            $max_row = 0;
            $info = '';
            $dps_withdrawed = '';
            $dps_deposited = '';
            $in_word = '';
            $no_of_deposit = 0;
            $no_of_withdraw = 0;
            if ($report_type == 'DPS DEPOSIT') {

                $info = Transaction::where('tx_type', 'dps payment')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total = Transaction::where('tx_type', 'dps payment')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $dps_withdraw_confirmation = true;
                $in_word = convert_number_to_words($total);
            } elseif ($report_type == 'DPS WITHDRAW') {
                $info = Transaction::where('tx_type', 'dps repay')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total = Transaction::where('tx_type', 'dps repay')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $dps_deposit_confirmation = true;
                $in_word = convert_number_to_words($total);
            } elseif ($report_type == 'DPS DEPOSIT & WITHDRAW') {
                $dps_withdrawed = Transaction::where('tx_type', 'dps repay')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total_withdraw = Transaction::where('tx_type', 'dps repay')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $dps_withdraw_confirmation = true;

                $dps_deposited = Transaction::where('tx_type', 'dps payment')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total_deposit = Transaction::where('tx_type', 'dps payment')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $dps_deposit_confirmation = true;

                $no_of_withdraw = count($dps_withdrawed);
                $no_of_deposit =  count($dps_deposited);
                $max_row = $no_of_deposit > $no_of_withdraw ? $no_of_deposit : $no_of_withdraw;
            }
            return view('admin.reports.service-report.dps_report', compact('report_type', 'organization', 'dates', 'dps_withdraw_confirmation', 'dps_deposit_confirmation', 'total_withdraw', 'total_deposit', 'max_row', 'dps_withdrawed', 'dps_deposited', 'in_word', 'info', 'total', 'no_of_withdraw', 'no_of_deposit'));
        } elseif ($report_head == 'double_benifit') {
            $double_benifit_withdraw_confirmation = false;
            $double_benifit_deposit_confirmation = false;
            $total = 0;
            $total_withdraw = 0;
            $total_deposit = 0;
            $max_row = 0;
            $info = '';
            $double_benifit_withdrawed = '';
            $double_benifit_deposited = '';
            $in_word = '';
            $no_of_deposit = 0;
            $no_of_withdraw = 0;
            if ($report_type == 'DOUBLE BENEFIT DEPOSIT') {

                $info = Transaction::where('tx_type', 'double benifit payment')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total = Transaction::where('tx_type', 'double benifit payment')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $double_benifit_withdraw_confirmation = true;
                $in_word = convert_number_to_words($total);
            } elseif ($report_type == 'DOUBLE BENEFIT WITHDRAW') {
                $info = Transaction::where('tx_type', 'double benifit repay')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total = Transaction::where('tx_type', 'double benifit repay')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $double_benifit_deposit_confirmation = true;
                $in_word = convert_number_to_words($total);
            } elseif ($report_type == 'DOUBLE BENEFIT DEPOSIT & WITHDRAW') {
                $double_benifit_withdrawed = Transaction::where('tx_type', 'double benifit repay')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total_withdraw = Transaction::where('tx_type', 'double benifit repay')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $double_benifit_withdraw_confirmation = true;

                $double_benifit_deposited = Transaction::where('tx_type', 'double benifit payment')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total_deposit = Transaction::where('tx_type', 'double benifit payment')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $dps_deposit_confirmation = true;

                $no_of_withdraw = count($double_benifit_withdrawed);
                $no_of_deposit =  count($double_benifit_deposited);
                $max_row = $no_of_deposit > $no_of_withdraw ? $no_of_deposit : $no_of_withdraw;
            }
            return view('admin.reports.service-report.double_benifit_report', compact('report_type', 'organization', 'dates', 'double_benifit_withdraw_confirmation', 'double_benifit_deposit_confirmation', 'total_withdraw', 'total_deposit', 'max_row', 'double_benifit_withdrawed', 'double_benifit_deposited', 'in_word', 'info', 'total', 'no_of_withdraw', 'no_of_deposit'));
        } elseif ($report_head == 'loan_from_member') {
            $loan_from_member_withdraw_confirmation = false;
            $loan_from_member_deposit_confirmation = false;
            $total = 0;
            $total_withdraw = 0;
            $total_deposit = 0;
            $max_row = 0;
            $info = '';
            $loan_from_member_withdrawed = '';
            $loan_from_member_deposited = '';
            $in_word = '';
            $no_of_deposit = 0;
            $no_of_withdraw = 0;
            if ($report_type == 'LOAN FROM MEMBER DEPOSIT') {

                $info = Transaction::where('tx_type', 'fdr payment')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total = Transaction::where('tx_type', 'fdr payment')->whereBetween('tx_date', [$start_date, $end_date])->sum('total_amt');
                $loan_from_member_deposit_confirmation = true;
                $in_word = convert_number_to_words($total);
            } elseif ($report_type == 'LOAN FROM MEMBER WITHDRAW') {
                $info = Transaction::where('tx_type', 'fdr repay')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total = Transaction::where('tx_type', 'fdr repay')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $loan_from_member_withdraw_confirmation = true;
                $in_word = convert_number_to_words($total);
            } elseif ($report_type == 'LOAN FROM MEMBER DEPOSIT & WITHDRAW') {
                $loan_from_member_withdrawed = Transaction::where('tx_type', 'fdr repay')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total_withdraw = Transaction::where('tx_type', 'fdr repay')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $loan_from_member_withdraw_confirmation = true;

                $loan_from_member_deposited = Transaction::where('tx_type', 'fdr payment')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total_deposit = Transaction::where('tx_type', 'fdr payment')->whereBetween('tx_date', [$start_date, $end_date])->sum('total_amt');
                // dd()
                $loan_from_member_deposit_confirmation = true;

                $no_of_withdraw = count($loan_from_member_withdrawed);
                $no_of_deposit =  count($loan_from_member_deposited);
                $max_row = $no_of_deposit > $no_of_withdraw ? $no_of_deposit : $no_of_withdraw;
            }
            return view('admin.reports.service-report.loan_from_member_report', compact('report_type', 'organization', 'dates', 'loan_from_member_withdraw_confirmation', 'loan_from_member_deposit_confirmation', 'total_withdraw', 'total_deposit', 'max_row', 'loan_from_member_withdrawed', 'loan_from_member_deposited', 'in_word', 'info', 'total', 'no_of_withdraw', 'no_of_deposit'));
        } elseif ($report_head == 'share') {
            $share_withdraw_confirmation = false;
            $share_deposit_confirmation = false;
            $total = 0;
            $total_withdraw = 0;
            $total_deposit = 0;
            $max_row = 0;
            $info = '';
            $share_withdrawed = '';
            $share_deposited = '';
            $in_word = '';
            $no_of_deposit = 0;
            $no_of_withdraw = 0;
            if ($report_type == 'SHARE DEPOSIT') {

                $info = Transaction::where('tx_type', 'share payment')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total = Transaction::where('tx_type', 'share payment')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $share_withdraw_confirmation = true;
                $in_word = convert_number_to_words($total);
            } elseif ($report_type == 'SHARE WITHDRAW') {
                $info = Transaction::where('tx_type', 'share repay')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total = Transaction::where('tx_type', 'share repay')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $share_deposit_confirmation = true;
                $in_word = convert_number_to_words($total);
            } elseif ($report_type == 'SHARE DEPOSIT & WITHDRAW') {
                $share_withdrawed = Transaction::where('tx_type', 'share repay')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total_withdraw = Transaction::where('tx_type', 'share repay')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $share_withdraw_confirmation = true;

                $share_deposited = Transaction::where('tx_type', 'share payment')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total_deposit = Transaction::where('tx_type', 'share payment')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $dps_deposit_confirmation = true;

                $no_of_withdraw = count($share_withdrawed);
                $no_of_deposit =  count($share_deposited);
                $max_row = $no_of_deposit > $no_of_withdraw ? $no_of_deposit : $no_of_withdraw;
            }
            return view('admin.reports.service-report.share_report', compact('report_type', 'organization', 'dates', 'share_withdraw_confirmation', 'share_deposit_confirmation', 'total_withdraw', 'total_deposit', 'max_row', 'share_withdrawed', 'share_deposited', 'in_word', 'info', 'total', 'no_of_withdraw', 'no_of_deposit'));
        } elseif ($report_head == 'savings') {
            $savings_withdraw_confirmation = false;
            $savings_deposit_confirmation = false;
            $total = 0;
            $total_withdraw = 0;
            $total_deposit = 0;
            $max_row = 0;
            $info = '';
            $savings_withdrawed = '';
            $savings_deposited = '';
            $in_word = '';
            $no_of_deposit = 0;
            $no_of_withdraw = 0;
            if ($report_type == 'SAVINGS DEPOSIT') {

                $info = Transaction::where('tx_type', 'savings payment')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total = Transaction::where('tx_type', 'savings payment')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $savings_withdraw_confirmation = true;
                $in_word = convert_number_to_words($total);
            } elseif ($report_type == 'SAVINGS WITHDRAW') {
                $info = Transaction::where('tx_type', 'savings repay')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total = Transaction::where('tx_type', 'savings repay')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $savings_deposit_confirmation = true;
                $in_word = convert_number_to_words($total);
            } elseif ($report_type == 'SAVINGS DEPOSIT & WITHDRAW') {
                $savings_withdrawed = Transaction::where('tx_type', 'savings repay')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total_withdraw = Transaction::where('tx_type', 'savings repay')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $savings_withdraw_confirmation = true;

                $savings_deposited = Transaction::where('tx_type', 'savings payment')->whereBetween('tx_date', [$start_date, $end_date])->get();
                $total_deposit = Transaction::where('tx_type', 'savings payment')->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $savings_deposit_confirmation = true;

                $no_of_withdraw = count($savings_withdrawed);
                $no_of_deposit =  count($savings_deposited);
                $max_row = $no_of_deposit > $no_of_withdraw ? $no_of_deposit : $no_of_withdraw;
            }
            return view('admin.reports.service-report.savings_report', compact('report_type', 'organization', 'dates', 'savings_withdraw_confirmation', 'savings_deposit_confirmation', 'total_withdraw', 'total_deposit', 'max_row', 'savings_withdrawed', 'savings_deposited', 'in_word', 'info', 'total', 'no_of_withdraw', 'no_of_deposit'));
        }
    }

    // in the following function the modal for selecting date will be opened
    public function edit($report_type)
    {
        // dd($report_type);
        return view('admin.reports.service-report.report_form', compact('report_type'));
    }
}
