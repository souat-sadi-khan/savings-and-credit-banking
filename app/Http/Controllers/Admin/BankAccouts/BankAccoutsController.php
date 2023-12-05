<?php

namespace App\Http\Controllers\Admin\BankAccouts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\bank_accounts\BankAccount;
use Yajra\Datatables\Datatables;
use App\models\utility\Transaction;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;


class BankAccoutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index()
    {
        return view('admin.bank-transactions.bank-accounts.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $model = BankAccount::all();
            return Datatables::of($model)
                ->addIndexColumn()
                ->editColumn('expense_categoty', function ($model) {
                    return $model->expense_category ? $model->expense_category->name : '';
                })
                ->editColumn('deposit', function ($model) {
                    $withdraw_depo = bank_withdraw_deposit($model->id);
                    return $withdraw_depo['deposit'];
                })
                ->editColumn('withdraw', function ($model) {
                    $withdraw_depo = bank_withdraw_deposit($model->id);
                    return $withdraw_depo['withdraw'];
                })
                ->editColumn('in_hand', function ($model) {
                    $withdraw_depo = bank_withdraw_deposit($model->id);
                    return $withdraw_depo['in_hand'];
                })
                ->addColumn('action', function ($model) {
                    return view('admin.bank-transactions.bank-accounts.action', compact('model'));
                })->rawColumns(['action'])->make(true);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bank-transactions.bank-accounts.create');
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
            'bank_name' => 'required',
            'branch_name' => 'required',
            'account_holder_name' => 'required',
            'account_no' => 'required',
        ]);
        $model = new BankAccount;

        $model->bank_name = $request->bank_name;
        $model->branch_name = $request->branch_name;
        $model->account_holder_name = $request->account_holder_name;
        $model->account_no = $request->account_no;
        $model->created_by = auth()->user()->id;
        $model->save();


        activity()->log('Added Bank Account ');
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
        $model = BankAccount::findOrFail($id);
        return view('admin.bank-transactions.bank-accounts.edit', compact('model'));
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
            'bank_name' => 'required',
            'branch_name' => 'required',
            'account_holder_name' => 'required',
            'account_no' => 'required',
        ]);
        $model =  BankAccount::findOrFail($id);

        $model->bank_name = $request->bank_name;
        $model->branch_name = $request->branch_name;
        $model->account_holder_name = $request->account_holder_name;
        $model->account_no = $request->account_no;
        $model->created_by = auth()->user()->id;
        $model->save();


        activity()->log('Updated Bank Account ');
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
        $model =  BankAccount::findOrFail($id);
        $model->delete();


        activity()->log('Deleted Bank Account ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    }

    public function withdraw($id)
    {
        $model = BankAccount::findOrFail($id);
        $in_hand = bank_withdraw_deposit($id)['in_hand'];
        return view('admin.bank-transactions.bank-accounts.withdraw', compact('model', 'in_hand'));
    }
    public function deposit($id)
    {
        $model = BankAccount::findOrFail($id);
        $in_hand = bank_withdraw_deposit($id)['in_hand'];

        return view('admin.bank-transactions.bank-accounts.deposit', compact('model', 'in_hand'));
    }

    public function add_withdraw(Request $request, $id)
    {
        $request->validate([
            'new_withdraw_amt' => 'required',
            'withdraw_date' => 'required',
        ]);

        // generate new invoice no
        $uniqu_id = generate_id("invoice", true);
        $code_prefix = get_option('invoice_code_prefix');
        $code_digits = get_option('digits_invoice_code');
        $uniqu_id = numer_padding($uniqu_id, $code_digits);
        $new_invoice_no = $code_prefix . $uniqu_id;

        $model = new Transaction;

        $model->bank_account_id = $id;
        $model->tx_type = 'bank repay';
        $model->type = 'credit';
        $model->payment_status = 'paid';
        $model->invoice_no = $new_invoice_no;
        $model->reference_no = $request->reference_no;
        $model->tx_date  =  Carbon::createFromFormat('d/m/Y', $request->withdraw_date)->format('Y-m-d');
        $model->grand_total_amt  =  $request->new_withdraw_amt;
        $model->additional_note  =  $request->additional_note;
        $model->save();

        activity()->log('New Deposit Added Successfully');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data added'), 'load' => true]);
    }
    public function add_deposit(Request $request, $id)
    {
        $request->validate([
            'new_deposit_amt' => 'required',
            'deposit_date' => 'required',
        ]);

        // generate new invoice no
        $uniqu_id = generate_id("invoice", true);
        $code_prefix = get_option('invoice_code_prefix');
        $code_digits = get_option('digits_invoice_code');
        $uniqu_id = numer_padding($uniqu_id, $code_digits);
        $new_invoice_no = $code_prefix . $uniqu_id;

        $model = new Transaction;

        $model->bank_account_id = $id;
        $model->tx_type = 'bank payment';
        $model->type = 'debit';
        $model->payment_status = 'paid';
        $model->invoice_no = $new_invoice_no;
        $model->reference_no = $request->reference_no;
        $model->tx_date  =  Carbon::createFromFormat('d/m/Y', $request->deposit_date)->format('Y-m-d');
        $model->grand_total_amt  =  $request->new_deposit_amt;
        $model->additional_note  =  $request->additional_note;
        $model->save();

        activity()->log('New Deposit Added Successfully');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data added'), 'load' => true]);
    }
}
