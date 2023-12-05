<?php

namespace App\Http\Controllers\Admin\Share;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\sundry\SundryCalculation;
use App\models\utility\Transaction;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class ShareWithdrawController extends Controller
{


    public function index()
    {
        return view('admin.share-withdraw.index');
    }


    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required',
            'share_account' => 'required',
            // 'new_deposit_amount' => 'required',
            'in_hand' => 'required',
            'payment_method' => 'required',
        ]);

        // :::::::::::  add share information to transaction table ::::::::::::::: 
        $dtobj = Carbon::createFromFormat('d/m/Y', $request->tx_date);
        $tx_date = $dtobj->format('Y-m-d');

        if ($request->payment_method == 'Bank Check') {
            $dtobj = Carbon::createFromFormat('d/m/Y', $request->check_active_date);
            $tx_date = $dtobj->format('Y-m-d');
        }

        // generate new invoice no
        $uniqu_id = generate_id("invoice", true);
        $code_prefix = get_option('invoice_code_prefix');
        $code_digits = get_option('digits_invoice_code');
        $uniqu_id = numer_padding($uniqu_id, $code_digits);
        $new_invoice_no = $code_prefix . $uniqu_id;

        $interest_withdraw = ($request->interest_withdraw < 0 || $request->interest_withdraw == null || $request->interest_withdraw == "") ? 0 : $request->interest_withdraw;

        $new_withdraw = ($request->new_withdraw < 0 || $request->new_withdraw == null || $request->new_withdraw == "") ? 0 : $request->new_withdraw;

        $grand_total_amt = $interest_withdraw + $new_withdraw;

        if ($grand_total_amt > 0) {


            $transaciton = new Transaction;

            $transaciton->share_id = $request->member_id; // here the member table's id is share id because I have kept share ifnormation  in this table .
            $transaciton->tx_type = 'share repay';
            $transaciton->type = 'debit';
            $transaciton->payment_status = 'paid';
            $transaciton->member_id = $request->member_id;
            $transaciton->invoice_no = $new_invoice_no;
            // $transaciton->interest_rate = $share_rate;
            $transaciton->total_amt = $new_withdraw;
            $transaciton->total_interest_amt = $interest_withdraw;
            $transaciton->grand_total_amt = $grand_total_amt;
            $transaciton->payment_method = $request->payment_method;
            $transaciton->mob_banking_name = $request->mob_banking_name;
            $transaciton->mob_account_holder = $request->mob_account_holder;
            $transaciton->sending_mob_no = $request->sending_mob_no;
            $transaciton->receiving_mob_no = $request->receiving_mob_no;
            $transaciton->mob_tx_id = $request->mob_tx_id;
            $transaciton->mob_payment_date = $request->mob_payment_date;
            $transaciton->bank_name = $request->bank_name;
            $transaciton->account_holder = $request->account_holder;
            $transaciton->account_no = $request->account_no;
            $transaciton->check_no = $request->check_no;
            $transaciton->check_active_date = $request->check_active_date;
            $transaciton->tx_date = $tx_date;
            $transaciton->created_by = auth()->user()->id;
            $transaciton->save();
        } else {
            throw  ValidationException::withMessages(['message' => 'Be Careful! Nothing to withdraw.']);
        }

        if ($request->interest_withdraw > 0) {

            $sundry_model = new SundryCalculation;
            $sundry_model->share_id = $request->member_id;
            $sundry_model->member_id = $request->member_id;
            $sundry_model->tx_type = 'withdraw';
            $sundry_model->submitted_amt = $request->interest_withdraw;
            $sundry_model->withdraw_date = $tx_date;
            $sundry_model->save();
        }

        activity()->log('Transaction Completed');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'load' => true]);
    }
}
