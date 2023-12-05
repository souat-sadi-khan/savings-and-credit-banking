<?php

namespace App\Http\Controllers\Admin\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\accounts\DoubleBenifitAccount;
use App\models\accounts\DpsAccount;
use App\models\accounts\FdrAccount;
use App\models\accounts\FdrMember;
use App\models\accounts\LoanAccount;
use App\models\accounts\SavingsAccount;
use App\models\Member\Member;
use App\models\utility\Transaction;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class MemberReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.member-report.index');
    }


    public function store(Request $request)
    {
        $report_type =  $request->report_type;

        $dates['start_date'] = Carbon::createFromFormat('d/m/Y',  date('d/m/Y'))->format('d-M, Y');



        $organization['name'] = get_option('company_name');
        $organization['address'] = get_option('address');
        $organization['phone'] = get_option('phone');
        $organization['email'] = get_option('email');

        if ($report_type == 'LOAN REPORT') {

            $loan_info = LoanAccount::where('id', $request->account_id)->with('loan_confirmation', 'member')->latest()->first();
            $loan_information = $loan_info->loan_confirmation;
            $member_information = $loan_info->member;
            $transaction_info = Transaction::where('loan_account_id', $request->account_id)->where('tx_type', 'loan repay')->get();

            $due_and_payment_status = current_payment_status('loan', $request->account_id);

            return view('admin.reports.member-report.loan_report', compact('report_type', 'organization', 'dates', 'loan_information', 'due_and_payment_status', 'member_information', 'transaction_info'));
        } elseif ($report_type == 'DPS REPORT') {
            $dps_acc_info = DpsAccount::where('id', $request->account_id)->with('member')->latest()->first();
            $member_information = $dps_acc_info->member;

            $deposit_info = Transaction::where('dps_account_id', $request->account_id)->where('tx_type', 'dps payment')->orderBy('id', 'DESC')->get();

            $withdraw_info = Transaction::where('dps_account_id', $request->account_id)->where('tx_type', 'dps repay')->orderBy('id', 'DESC')->get();

            $payment_status = current_payment_status('dps withdraw', $request->account_id);

            // dd('sohag');
            return view('admin.reports.member-report.dps_report', compact('report_type', 'organization', 'dates', 'dps_acc_info', 'deposit_info', 'withdraw_info', 'payment_status', 'member_information'));
        } elseif ($report_type == 'DOUBLE BENEFIT REPORT') {

            $double_benifit_info = DoubleBenifitAccount::where('id', $request->account_id)->with('member')->latest()->first();

            $member_information = $double_benifit_info->member;
            $transaction_info = Transaction::where('double_benifit_account_id', $request->account_id)->where('tx_type', 'double benifit repay')->get();

            $due_and_payment_status = current_payment_status('double benifit', $request->account_id);


            return view('admin.reports.member-report.double_benifit_report', compact('report_type', 'organization', 'dates', 'double_benifit_info', 'member_information', 'transaction_info', 'due_and_payment_status'));
        } elseif ($report_type == 'LOAN FROM MEMBER REPORT') {
            $fdr_info = FdrAccount::where('id', $request->account_id)->with('fdrMember')->latest()->first();

            $member_informations = $fdr_info->fdrMember;
            // dd($member_informations);
            $transaction_info = Transaction::where('fdr_account_id', $request->account_id)->where('tx_type', 'fdr repay')->get();

            $due_and_payment_status = current_payment_status('fdr', $request->account_id);


            return view('admin.reports.member-report.loan_from_member_report', compact('report_type', 'organization', 'dates', 'fdr_info', 'transaction_info', 'due_and_payment_status', 'member_informations'));
        } elseif ($report_type == 'SHARE REPORT') {

            $member = Member::findOrFail($request->account_id);

            // here share id is member id because in member table i have kept the share information 

            $current_share_info = current_payment_status('share', $member->id);

            $previous_transaction_information = view('admin.share-deposit.previous_tx_report', compact('member', 'current_share_info'))->render();

            $share_id  =  $member->prefix_share . numer_padding($member->code_share, get_option('digits_share_code'));

            // dd($member);

            return view('admin.reports.member-report.share_report', compact('report_type', 'organization', 'dates', 'share_id', 'current_share_info', 'member'));
        } elseif ($report_type == 'SAVINGS REPORT') {
            $sav_acc_info = SavingsAccount::where('id', $request->account_id)->with('member')->latest()->first();
            $member_information = $sav_acc_info->member;

            $deposit_info = Transaction::where('savings_account_id', $request->account_id)->where('tx_type', 'savings payment')->orderBy('id', 'DESC')->get();

            $withdraw_info = Transaction::where('savings_account_id', $request->account_id)->where('tx_type', 'savings repay')->orderBy('id', 'DESC')->get();

            $payment_status = current_payment_status('savings', $request->account_id);


            return view('admin.reports.member-report.savings_report', compact('report_type', 'organization', 'dates', 'sav_acc_info', 'member_information', 'deposit_info', 'withdraw_info', 'payment_status'));
        }
    }

    // in the following function the modal for selecting date will be opened
    public function edit($report_type)
    {

        if ($report_type == 'SHARE REPORT') {
            $accounts = Member::all();
        } else {
            $accounts = SavingsAccount::all();
        }
        return view('admin.reports.member-report.report_form', compact('report_type', 'accounts'));
    }

    public function get_account(Request $request)
    {
        $report_type = $request->report_type;
        // dd($report_type);
        if ($report_type == 'LOAN REPORT') {
            $loans = LoanAccount::where('member_id', $request->member_id)->where('approval', 'Approved')->get();
            $options = ' <option value="">Please Select One ..</option>';
            if ($loans) {
                foreach ($loans as  $loan) {
                    $options .= '<option value="' . $loan->id . '">' . $loan->prefix . numer_padding($loan->code, get_option("digits_loan_account_code")) . ' (' . carbonDate($loan->approval_date) . ')</option>';
                }
            }
        } elseif ($report_type == 'DPS REPORT') {
            $dps_accounts = DpsAccount::where('member_id', $request->member_id)->where('approval', 'Approved')->get();
            $options = ' <option value="">Please Select One ..</option>';
            if ($dps_accounts) {
                foreach ($dps_accounts as  $double_acc) {
                    $options .= '<option value="' . $double_acc->id . '">' . $double_acc->prefix . numer_padding($double_acc->code, get_option("digits_dps_code")) . ' (' . carbonDate($double_acc->approval_date) . ')</option>';
                }
            }
        } elseif ($report_type == 'DOUBLE BENEFIT REPORT') {
            $double_benifit_accounts = DoubleBenifitAccount::where('member_id', $request->member_id)->where('approval', 'Approved')->get();
            $options = ' <option value="">Please Select One ..</option>';
            if ($double_benifit_accounts) {
                foreach ($double_benifit_accounts as  $double_acc) {
                    $options .= '<option value="' . $double_acc->id . '">' . $double_acc->prefix . numer_padding($double_acc->code, get_option("digits_double_benifit_code")) . ' (' . carbonDate($double_acc->approval_date) . ')</option>';
                }
            }
        } elseif ($report_type == 'LOAN FROM MEMBER REPORT') {
            $fdr_member = FdrMember::where('member_id', $request->member_id)->get();
            // dd($share_account);
            $options = ' <option value="">Please Select One ..</option>';
            foreach ($fdr_member as  $value) {
                $fdr_account = FdrAccount::where('id', $value->fdr_id)->first();
                $options .= '<option value="' . $fdr_account->id . '">' . $fdr_account->prefix . numer_padding($fdr_account->code, get_option("digits_loan_from_member_code")) . ' (' . carbonDate($fdr_account->approval_date) . ')</option>';
            }
        } elseif ($report_type == 'SHARE REPORT') {
            $share_account = Member::where('id', $request->member_id)->first();
            // dd($share_account);
            $options = ' <option value="">Please Select One ..</option>';
            if ($share_account) {
                $options .= '<option value="' . $share_account->id . '">' . $share_account->prefix_share . numer_padding($share_account->code_share, get_option("digits_share_code")) . ' (' . carbonDate($share_account->created_at) . ')</option>';
            }
        } elseif ($report_type == 'SAVINGS REPORT') {
            $savings_accounts = SavingsAccount::where('member_id', $request->member_id)->get();
            $options = ' <option value="">Please Select One ..</option>';
            if ($savings_accounts) {
                foreach ($savings_accounts as  $savings_acc) {
                    $options .= '<option value="' . $savings_acc->id . '">' . $savings_acc->prefix . numer_padding($savings_acc->code, get_option("digits_savings_account_code")) . ' (' . carbonDate($savings_acc->created_at) . ')</option>';
                }
            }
        }

        return response()->json(['options' => $options]);
    }
}
