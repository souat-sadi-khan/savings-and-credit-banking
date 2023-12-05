<?php

namespace App\Http\Controllers\Admin\LoanFromMember;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\accounts\DoubleBenifitAccount;
use App\models\accounts\FdrAccount;
use App\models\Member\Member;
use App\models\sundry\SundryCalculation;
use App\models\utility\Transaction;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class LoanFromMemberWithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = FdrAccount::where('status', 'Active')->get();
        return view('admin.fdr-withdraw.index', compact('model'));
    }



    public function store(Request $request)
    {

        $request->validate([
            'fdr_id' => 'required',
            'withdraw_type' => 'required',
            'withdrawable' => 'required',
            'payment_method' => 'required',
            'tx_date' => 'required',
        ]);
        // backend calculation

        $withdrawable_amt = $request->withdrawable;
        $withdraw_type = $request->withdraw_type;

        if ($withdraw_type == "Total") {
            $sundry_depo = SundryCalculation::where('fdr_id', $request->fdr_id)->where('tx_type', 'deposit')->sum('submitted_amt');
            $sundry_withdraw = SundryCalculation::where('fdr_id', $request->fdr_id)->where('tx_type', 'withdraw')->sum('submitted_amt');
            $sundry_in_hand = $sundry_depo - $sundry_withdraw;
        }

        $due_and_payment_status = current_payment_status('fdr', $request->fdr_id);

        $now_withdrable_total = $due_and_payment_status['now_withdrable_total'];
        $now_withdrable_interest = $due_and_payment_status['now_withdrable_interest'];

        if ($withdraw_type == 'Total' && $withdrawable_amt > $now_withdrable_total) {
            throw  ValidationException::withMessages(['message' => 'Remember: cannot Withdraw More Than ' . $now_withdrable_total . ' Taka']);
        } else if ($withdraw_type == 'Interest' && $withdrawable_amt > $now_withdrable_interest) {
            throw  ValidationException::withMessages(['message' => 'Remember: cannot Withdraw More Than ' . $now_withdrable_interest . ' Taka']);
        }

        if ($withdrawable_amt < 1) {
            throw  ValidationException::withMessages(['message' => 'No Withdraw Amount Found.']);
        }

        // generate new invoice no
        $uniqu_id = generate_id("invoice", true);
        $code_prefix = get_option('invoice_code_prefix');
        $code_digits = get_option('digits_invoice_code');
        $uniqu_id = numer_padding($uniqu_id, $code_digits);
        $new_invoice_no = $code_prefix . $uniqu_id;

        $model = new Transaction;

        $model->fdr_account_id = $request->fdr_id;
        $model->tx_type = 'fdr repay';
        $model->type = 'credit';
        // $model->payment_status = 'partial';
        $model->member_id = $request->member_id;
        $model->invoice_no = $new_invoice_no;
        $tx_date = Carbon::createFromFormat('d/m/Y', $request->tx_date)->format('Y-m-d');
        $model->tx_date = $tx_date;
        $model->grand_total_amt = $withdrawable_amt;

        $model->payment_method = $request->payment_method;
        $model->mob_banking_name = $request->mob_banking_name;
        $model->mob_account_holder = $request->mob_account_holder;
        $model->sending_mob_no = $request->sending_mob_no;
        $model->receiving_mob_no = $request->receiving_mob_no;
        $model->mob_tx_id = $request->mob_tx_id;
        $mob_payment_date = $request->mob_payment_date ? Carbon::createFromFormat('d/m/Y', $request->mob_payment_date)->format('Y-m-d') : null;
        $model->mob_payment_date = $mob_payment_date;
        $model->bank_name = $request->bank_name;
        $model->account_holder = $request->account_holder;
        $model->account_no = $request->account_no;
        $model->check_no = $request->check_no;
        $check_active_date =  $request->check_active_date ? Carbon::createFromFormat('d/m/Y', $request->check_active_date)->format('Y-m-d') : null;
        $model->check_active_date = $check_active_date;
        $model->additional_note = $request->additional_note;
        $model->created_by = auth()->user()->id;
        $model->save();

        // now update the loan payment of this loan 

        $fdr_model = FdrAccount::findOrFail($request->fdr_id);


        if ($withdraw_type == "Total") {
            $fdr_model->total_withdraw = '1';
            $fdr_model->status = 'Inactive';
            $fdr_model->save();

            if ($sundry_in_hand > 0) {
                $sundry_model = new SundryCalculation;
                $sundry_model->fdr_id = $request->fdr_id;
                // $sundry_model->member_id = $fdr_model->member->id;
                $sundry_model->tx_type = 'withdraw';
                $sundry_model->submitted_amt = $sundry_in_hand;
                $sundry_model->withdraw_date = $tx_date;
                $sundry_model->save();
            }
        }

        if ($withdraw_type == 'Interest') {

            $sundry_model = new SundryCalculation;
            $sundry_model->fdr_id = $request->fdr_id;
            // $sundry_model->member_id = $dps_model->member->id;
            $sundry_model->tx_type = 'withdraw';
            $sundry_model->submitted_amt = $withdrawable_amt;
            $sundry_model->withdraw_date = $tx_date;
            $sundry_model->save();
        }


        activity()->log('Withdraw Completed ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'load' => true]);
    }




    public function get_fdr_info(Request $request)
    {

        $fdr_info = FdrAccount::where('id', $request->fdr_id)->with('fdrMember')->latest()->first();

        $member_informations = $fdr_info->fdrMember;
        $transaction_info = Transaction::where('fdr_account_id', $request->fdr_id)->where('tx_type', 'fdr repay')->get();

        $due_and_payment_status = current_payment_status('fdr', $request->fdr_id);

        $previous_payment_records = view('admin.fdr-withdraw.prev_pay_record', compact('fdr_info', 'member_informations', 'transaction_info', 'due_and_payment_status'))->render();

        return response()->json(['fdr_info' => $fdr_info, 'due_and_payment_status' => $due_and_payment_status, 'previous_payment_records' => $previous_payment_records]);
    }
}
