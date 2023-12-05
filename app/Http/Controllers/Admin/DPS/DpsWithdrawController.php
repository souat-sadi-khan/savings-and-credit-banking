<?php

namespace App\Http\Controllers\Admin\DPS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\accounts\DoubleBenifitAccount;
use App\models\accounts\DpsAccount;
use App\models\Member\Member;
use App\models\sundry\SundryCalculation;
use App\models\utility\Transaction;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class DpsWithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $model = dpsAccount::where('status', 'Active')->get();
        return view('admin.dps-withdraw.index');
    }



    public function store(Request $request)
    {

        $request->validate([
            'member_id' => 'required',
            'dps_id' => 'required',
            'withdraw_type' => 'required',
            'withdrawable' => 'required',
            'payment_method' => 'required',
            'tx_date' => 'required',
        ]);
        // backend calculation
        $withdrawable_dps = $request->withdrawable_dps == null ? 0 : $request->withdrawable_dps;
        $withdrawable_interest = $request->withdrawable_interest == null ? 0 : $request->withdrawable_interest;

        $withdrawable_amt = $request->withdrawable == null ? 0 : $request->withdrawable;
        $withdraw_type = $request->withdraw_type;

        // $sundry_in_hand = 0;
        // if ($withdraw_type == "Total") {
        //     $sundry_depo = SundryCalculation::where('dps_id', $request->dps_id)->where('tx_type', 'deposit')->sum('submitted_amt');
        //     $sundry_withdraw = SundryCalculation::where('dps_id', $request->dps_id)->where('tx_type', 'withdraw')->sum('submitted_amt');
        //     $sundry_in_hand = $sundry_depo - $sundry_withdraw;
        // }

        $due_and_payment_status = current_payment_status('dps withdraw', $request->dps_id);

        $now_withdrable_dps = $due_and_payment_status['now_withdrable_dps'];
        $now_withdrable_interest = $due_and_payment_status['now_withdrable_interest'];

        if ($now_withdrable_dps < $withdrawable_dps) {
            throw  ValidationException::withMessages(['message' => 'Maximum withdrawable DPS = ' . $withdrawable_dps]);
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

        $model->dps_account_id = $request->dps_id;
        $model->tx_type = 'dps repay';
        $model->type = 'debit';
        // $model->payment_status = 'partial';
        $model->member_id = $request->member_id;
        $model->invoice_no = $new_invoice_no;
        $tx_date = Carbon::createFromFormat('d/m/Y', $request->tx_date)->format('Y-m-d');
        $model->tx_date = $tx_date;

        $model->total_amt = $withdrawable_dps;
        $model->total_interest_amt = $withdrawable_interest;
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

        // now update the account and make it inactive
        $dps_model = dpsAccount::findOrFail($request->dps_id);

        if ($withdraw_type == "Total" || $request->dps_completation == 'Yes') {
            $dps_model->total_withdraw = '1';
            $dps_model->status = 'Inactive';
            $dps_model->save();

            // if ($sundry_in_hand > 0) {
            //     $sundry_model = new SundryCalculation;
            //     $sundry_model->dps_id = $request->dps_id;
            //     $sundry_model->member_id = $dps_model->member->id;
            //     $sundry_model->tx_type = 'withdraw';
            //     $sundry_model->submitted_amt = $sundry_in_hand;
            //     $sundry_model->withdraw_date = $tx_date;
            //     $sundry_model->save();
            // }
        }
        // if ($withdraw_type == 'Interest') {

        //     $sundry_model = new SundryCalculation;
        //     $sundry_model->dps_id = $request->dps_id;
        //     $sundry_model->member_id = $dps_model->member->id;
        //     $sundry_model->tx_type = 'withdraw';
        //     $sundry_model->submitted_amt = $withdrawable_amt;
        //     $sundry_model->withdraw_date = $tx_date;
        //     $sundry_model->save();
        // }


        activity()->log('Withdraw Completed ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'load' => true]);
    }




    public function get_dps_info(Request $request)
    {

        $dps_acc_info = DpsAccount::where('id', $request->dps_id)->with('member')->latest()->first();
        $member = $dps_acc_info->member;

        $deposit_info = Transaction::where('dps_account_id', $request->dps_id)->where('tx_type', 'dps payment')->orderBy('id', 'DESC')->get();

        $withdraw_info = Transaction::where('dps_account_id', $request->dps_id)->where('tx_type', 'dps repay')->orderBy('id', 'DESC')->get();

        $payment_status = current_payment_status('dps withdraw', $request->dps_id);

        $previous_payment_records = view('admin.dps-withdraw.prev_pay_record', compact('dps_acc_info', 'member', 'deposit_info', 'withdraw_info', 'payment_status'))->render();

        return response()->json(['dps_info' => $dps_acc_info, 'due_and_payment_status' => $payment_status, 'previous_payment_records' => $previous_payment_records]);
    }



    // Get select2 members  
    public function search_member(Request $request)
    {
        $people = [];
        $data = [];

        $people = Member::select('id')
            ->where('name_in_bangla', 'like', '%' . $_GET['term'] . '%')
            ->orWhere('contact_number', 'like', '%' . $_GET['term'] . '%')
            ->orWhere('email', 'like', '%' . $_GET['term'] . '%')
            ->orWhere('code', 'like', '%' . $_GET['term'] . '%')
            ->orderBy('id', 'DESC')
            ->get();

        foreach ($people as $k => $v) {
            $data[$k]['id'] = $v->id;
            $data[$k]['name'] = $this->getCatagoryParent($v->id);
        }
        return response()->json(['items' => $data]);
    }

    public function getCatagoryParent($id, $name = Null)
    {
        $member = Member::find($id);
        if ($member) {
            $name =  $member->name_in_bangla . ', (' . $member->prefix . numer_padding($member->code, get_option('digits_member_code')) . ')' . ', ' . $member->contact_number;
        }
        return $name;
    }

    // get loan account of a member
    public function get_dps_account(Request $request)
    {

        $dps_accounts = DpsAccount::where('member_id', $request->member_id)->where('approval', 'Approved')->where('status', 'Active')->get();
        $options = ' <option value="">Please Select One ..</option>';
        if ($dps_accounts) {
            foreach ($dps_accounts as  $double_acc) {
                $options .= '<option value="' . $double_acc->id . '">' . $double_acc->prefix . numer_padding($double_acc->code, get_option("digits_dps_code")) . ' (' . carbonDate($double_acc->approval_date) . ')</option>';
            }
        }

        return response()->json(['options' => $options]);
    }
}
