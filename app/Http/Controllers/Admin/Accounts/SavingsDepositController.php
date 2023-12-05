<?php

namespace App\Http\Controllers\Admin\Accounts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\accounts\LoanAccount;
use App\models\accounts\SavingsAccount;
use App\models\utility\Transaction;
use Carbon\Carbon;

class SavingsDepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.accounts.savings-deposit.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.accounts.savings-deposit.create');
    }

    // ajax data table
    public function datatable(Request $request)
    {

        if ($request->ajax()) {
            $model = Transaction::where('tx_type', 'savings payment')->get();
            return Datatables::of($model)
                ->addIndexColumn()
                ->editColumn('member', function ($model) {
                    return $model->member ? '<a href="' . route('admin.member-list.edit', $model->member->uuid) . '">' . ($model->member->name_in_bangla . ' (' . $model->member->prefix . numer_padding($model->member->code, get_option('digits_member_code')) . ')') : "" . '</a>';
                })
                ->editColumn('account_no', function ($model) {
                    return '<a href="' . route('admin.savings-account.show', $model->savings_ac->uuid) . '">' . $model->savings_ac->prefix . numer_padding($model->savings_ac->code, get_option('digits_savings_account_code')) . '</a>';
                })
                ->editColumn('deposit_amt', function ($model) {
                    return $model->grand_total_amt;
                })

                ->editColumn('date', function ($model) {
                    return carbonDate($model->tx_date);
                })
                ->addColumn('action', function ($model) {
                    // return view('admin.accounts.savings-deposit.action', compact('model'));
                    return check_date_within_this_month($model->tx_date) ? view('admin.accounts.savings-deposit.action', compact('model')) : 'Time Up';
                })->rawColumns(['action', 'member', 'photo', 'account_no'])->make(true);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'member_id' => 'required',
            'savings_acc_id' => 'required',
            'new_deposit' => 'required',
            'payment_method' => 'required',
            'tx_date' => 'required',
        ]);
        // backend calculation

        $transaction_info = Transaction::where('savings_account_id', $request->savings_acc_id)->first();

        // generate new invoice no
        $uniqu_id = generate_id("invoice", true);
        $code_prefix = get_option('invoice_code_prefix');
        $code_digits = get_option('digits_invoice_code');
        $uniqu_id = numer_padding($uniqu_id, $code_digits);
        $new_invoice_no = $code_prefix . $uniqu_id;


        $dtobj = Carbon::createFromFormat('d/m/Y', $request->tx_date);

        $tx_date = $dtobj->format('Y-m-d');


        // formating check active date
        $check_active_date = $request->check_active_date ? (Carbon::createFromFormat('d/m/Y', $request->check_active_date)->format('Y-m-d')) : null;

        // formating mobile banking payment date active date
        $mob_payment_date = $request->mob_payment_date ? (Carbon::createFromFormat('d/m/Y', $request->mob_payment_date)->format('Y-m-d')) : null;

        // now save data
        $model = new Transaction;


        $model->savings_account_id = $request->savings_acc_id;
        $model->tx_type = 'savings payment';
        $model->type = 'credit';
        $model->payment_status = 'paid';
        $model->member_id = $request->member_id;
        $model->invoice_no = $new_invoice_no;
        $model->tx_date = $tx_date;

        $model->grand_total_amt = $request->new_deposit;

        $model->payment_method = $request->payment_method;
        $model->mob_banking_name = $request->mob_banking_name;
        $model->mob_account_holder = $request->mob_account_holder;
        $model->sending_mob_no = $request->sending_mob_no;
        $model->receiving_mob_no = $request->receiving_mob_no;
        $model->mob_tx_id = $request->mob_tx_id;
        $model->mob_payment_date = $mob_payment_date;
        $model->bank_name = $request->bank_name;
        $model->account_holder = $request->account_holder;
        $model->account_no = $request->account_no;
        $model->check_no = $request->check_no;
        $model->check_active_date = $check_active_date;
        $model->additional_note = $request->additional_note;
        $model->parent_id = $transaction_info ? $transaction_info->id : null;
        $model->created_by = auth()->user()->id;
        $model->save();

        activity()->log('Transaction Completed');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'load' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Transaction::findOrFail($id);

        $deposit_info = Transaction::where('savings_account_id', $model->savings_ac->id)->where('tx_type', 'savings payment')->orderBy('id', 'DESC')->get();

        $withdraw_info = Transaction::where('savings_account_id', $model->savings_ac->id)->where('tx_type', 'savings repay')->orderBy('id', 'DESC')->get();

        $payment_status = current_payment_status('savings', $model->savings_ac->id);


        return view('admin.accounts.savings-deposit.edit', compact('model', 'deposit_info', 'withdraw_info', 'payment_status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'new_deposit' => 'required',
            'payment_method' => 'required',
            'tx_date' => 'required',
        ]);


        $dtobj = Carbon::createFromFormat('d/m/Y', $request->tx_date);
        $tx_date = $dtobj->format('Y-m-d');


        // formating check active date
        $check_active_date = $request->check_active_date ? (Carbon::createFromFormat('d/m/Y', $request->check_active_date)->format('Y-m-d')) : null;

        // formating mobile banking payment date active date
        $mob_payment_date = $request->mob_payment_date ? (Carbon::createFromFormat('d/m/Y', $request->mob_payment_date)->format('Y-m-d')) : null;


        $model = Transaction::findOrFail($id);

        $model->grand_total_amt = $request->new_deposit;
        $model->payment_method = $request->payment_method;
        $model->mob_banking_name = $request->mob_banking_name;
        $model->mob_account_holder = $request->mob_account_holder;
        $model->sending_mob_no = $request->sending_mob_no;
        $model->receiving_mob_no = $request->receiving_mob_no;
        $model->mob_tx_id = $request->mob_tx_id;
        $model->mob_payment_date = $mob_payment_date;
        $model->bank_name = $request->bank_name;
        $model->account_holder = $request->account_holder;
        $model->account_no = $request->account_no;
        $model->check_no = $request->check_no;
        $model->check_active_date = $check_active_date;
        $model->additional_note = $request->additional_note;
        $model->tx_date = $tx_date;
        $model->created_by = auth()->user()->id;
        $model->save();
        activity()->log('Transaction Updated');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated'), 'load' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $model = Transaction::findOrFail($id);
        $model->delete();
        // Activity Log
        activity()->log('Deleted Savings Deposit');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    }

    // get saving account while changing member and append the account to drop down of savings account id
    public function get_savings_account(Request $request)
    {
        $savings_ac = SavingsAccount::where('member_id', $request->member_id)->where('status', 'Active')->get();
        $options = ' <option value="">Please Select One ..</option>';
        if ($savings_ac) {
            foreach ($savings_ac as  $savings_account) {
                $options .= '<option value="' . $savings_account->id . '">' . $savings_account->prefix . numer_padding($savings_account->code, get_option("digits_savings_account_code")) . ' (' . carbonDate($savings_account->created_at) . ')</option>';
            }
        }

        return response()->json(['options' => $options]);
    }

    // get deposit information while changing saving accoutn id
    public function get_deposit_info(Request $request)
    {
        $sav_acc_info = SavingsAccount::where('id', $request->savings_acc_id)->with('member')->latest()->first();
        $member = $sav_acc_info->member;

        $deposit_info = Transaction::where('savings_account_id', $request->savings_acc_id)->where('tx_type', 'savings payment')->orderBy('id', 'DESC')->get();

        $withdraw_info = Transaction::where('savings_account_id', $request->savings_acc_id)->where('tx_type', 'savings repay')->orderBy('id', 'DESC')->get();

        $payment_status = current_payment_status('savings', $request->savings_acc_id);

        $previous_payment_records = view('admin.accounts.savings-deposit.prev_pay_record', compact('sav_acc_info', 'member', 'deposit_info', 'withdraw_info', 'payment_status'))->render();

        return response()->json(['sav_acc_info' => $sav_acc_info, 'payment_status' => $payment_status, 'previous_payment_records' => $previous_payment_records]);
    }
}
