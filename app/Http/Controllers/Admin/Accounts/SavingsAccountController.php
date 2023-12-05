<?php

namespace App\Http\Controllers\Admin\Accounts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\accounts\SavingsAccount;
use App\models\Member\Member;
use App\models\utility\Transaction;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class SavingsAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $model = SavingsAccount::all();
        return view('admin.accounts.savings-account.index');
    }

    // ajax data table
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $model = SavingsAccount::all();
            return Datatables::of($model)
                ->addIndexColumn()
                ->editColumn('member', function ($model) {
                    return $model->member ? ('ID No: ' . $model->member->prefix . numer_padding($model->member->code, get_option('digits_member_code')) . '<br>Name: ' . $model->member->name_in_bangla . '<br>Phone: ' . $model->member->contact_number . '<br>Address:' . $model->member->present_address_line_1) : "";
                })
                ->editColumn('photo', function ($model) {
                    return $model->member ? ('<a href="' . asset('storage/member/' . $model->member->photo) . '" target="_blank"><img  src="' . asset('storage/member/' . $model->member->photo) . '" id="" width="120" class="rounded img-thumbnail"></a>') : "";
                })
                ->editColumn('account_no', function ($model) {
                    return $model->prefix . numer_padding($model->code, get_option('digits_savings_account_code'));
                })
                ->editColumn('nomenee', function ($model) {
                    return ('Name: ' . $model->nomenee_name . ($model->nomenee_fathers_name ? '<br>Father: ' . $model->nomenee_fathers_name : '') . ($model->nomenee_husbands_name ? '<br>Husband: ' . $model->nomenee_husbands_name : '') . '<br>Address: ' . $model->nomenee_permanent_address . '<br>Relation: <span class="badge badge-success">' . $model->nomenee_relation_with_member . '</span>');
                })
                ->editColumn('identifier', function ($model) {
                    return ('Name: ' . $model->identifier_name . ($model->identifier_fathers_name ? '<br>Father: ' . $model->identifier_fathers_name : '') . ($model->identifier_husbands_name ? '<br>Husband: ' . $model->identifier_husbands_name : '') . '<br>Address: ' . $model->identifier_permanent_address);
                })
                ->editColumn('status', function ($model) {
                    return $model->status == "Active" ? '<span class="badge badge-success">' . $model->status . '</span>' : '<span class="badge badge-danger">' . $model->status . '</span>';
                })
                ->addColumn('action', function ($model) {
                    return view('admin.accounts.savings-account.action', compact('model'));
                })->rawColumns(['action', 'status', 'member', 'photo', 'nomenee', 'identifier'])->make(true);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = Transaction::where('cash_in_hand', '1')->first();
        if ($model) {

            $savings_accounts = SavingsAccount::all();
            $member_id = [];

            foreach ($savings_accounts as $savings_account) {
                $member_id[] = $savings_account->member_id;
            }
            $model = Member::whereNotIn('id', $member_id)->get();

            // dd($model);

            $code_prefix = get_option('savings_account_code_prefix');
            $code_digits = get_option('digits_savings_account_code');
            $uniqu_id = generate_id('savings_account', false);
            $uniqu_id = numer_padding($uniqu_id, $code_digits);

            return view('admin.accounts.savings-account.create', compact('model', "code_prefix", "uniqu_id"));
        } else {
            return view('admin.accounts.savings-account.cash_in_hand');
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
            'prefix' => 'required',
            'code' => 'required|numeric',
            'nomenee_name' => 'required',
            'nomenee_relation_with_member' => 'required',
            'nomenee_permanent_address' => 'required',
            'identifier_name' => 'required',
            'identifier_permanent_address' => 'required',
            'status' => 'required',
        ]);

        $uuid =  Str::uuid()->toString();

        $model = new SavingsAccount;

        $model->uuid = $uuid;
        $model->prefix = $request->prefix;
        $model->code = $request->code;
        $model->member_id = $request->member_id;
        $model->nomenee_name = $request->nomenee_name;
        $model->nomenee_fathers_name = $request->nomenee_fathers_name;
        $model->nomenee_husbands_name = $request->nomenee_husbands_name;
        $model->nomenee_present_address = $request->nomenee_present_address;
        $model->nomenee_permanent_address = $request->nomenee_permanent_address;
        $model->nomenee_age = $request->nomenee_age;
        $model->nomenee_relation_with_member = $request->nomenee_relation_with_member;
        $model->identifier_name = $request->identifier_name;
        $model->identifier_fathers_name = $request->identifier_fathers_name;
        $model->identifier_husbands_name = $request->identifier_husbands_name;
        $model->identifier_present_address = $request->identifier_present_address;
        $model->identifier_permanent_address = $request->identifier_permanent_address;
        $model->identifier_age = $request->identifier_age;
        $model->created_by = auth()->user()->id;
        $model->status = $request->status;
        $model->save();

        generate_id("savings_account", true);

        activity()->log('Added Account ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'load' => true]);
    }

    public function store_cash_in_hand(Request $request)
    {
        $request->validate([
            'amount' => 'required',
        ]);

        // generate new invoice no
        $uniqu_id = generate_id("invoice", true);
        $code_prefix = get_option('invoice_code_prefix');
        $code_digits = get_option('digits_invoice_code');
        $uniqu_id = numer_padding($uniqu_id, $code_digits);
        $new_invoice_no = $code_prefix . $uniqu_id;

        $model = new Transaction;


        $model->cash_in_hand = '1';
        $model->invoice_no = $new_invoice_no;
        $model->tx_date = date("Y-m-d");
        $model->grand_total_amt = $request->amount;
        $model->created_by = auth()->user()->id;
        $model->save();

        activity()->log('Added Cash In Hand ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Cash In Hand Amount Added'), 'load' => true]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $account_information = SavingsAccount::where('uuid', $uuid)->firstOrFail();
        $member = Member::findOrFail($account_information->member_id);

        $deposit_info = Transaction::where('savings_account_id', $account_information->id)->where('tx_type', 'savings payment')->orderBy('id', 'DESC')->get();

        $withdraw_info = Transaction::where('savings_account_id', $account_information->id)->where('tx_type', 'savings repay')->orderBy('id', 'DESC')->get();

        $payment_status = current_payment_status('savings', $account_information->id);

        return view('admin.accounts.savings-account.show', compact('account_information', 'member', 'payment_status', 'withdraw_info', 'deposit_info'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $model = SavingsAccount::findOrFail($id);
        // dd($model->member->id);
        $accounts = SavingsAccount::where('member_id', '!=', $model->member_id)->get();
        $member_ids = [];


        foreach ($accounts as $account) {
            $member_ids[] = $account->member_id;
        }
        // dd($member_ids);
        $members = Member::whereNotIn('id', $member_ids)->get();



        return view('admin.accounts.savings-account.edit', compact('model', 'members'));
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
            'member_id' => 'required',
            'prefix' => 'required',
            'code' => 'required|numeric',
            'nomenee_name' => 'required',
            'nomenee_relation_with_member' => 'required',
            'nomenee_permanent_address' => 'required',
            'identifier_name' => 'required',
            'identifier_permanent_address' => 'required',
            'status' => 'required',
        ]);

        $model = SavingsAccount::findOrFail($id);

        $model->member_id = $request->member_id;
        $model->nomenee_name = $request->nomenee_name;
        $model->nomenee_fathers_name = $request->nomenee_fathers_name;
        $model->nomenee_husbands_name = $request->nomenee_husbands_name;
        $model->nomenee_present_address = $request->nomenee_present_address;
        $model->nomenee_permanent_address = $request->nomenee_permanent_address;
        $model->nomenee_age = $request->nomenee_age;
        $model->nomenee_relation_with_member = $request->nomenee_relation_with_member;
        $model->identifier_name = $request->identifier_name;
        $model->identifier_fathers_name = $request->identifier_fathers_name;
        $model->identifier_husbands_name = $request->identifier_husbands_name;
        $model->identifier_present_address = $request->identifier_present_address;
        $model->identifier_permanent_address = $request->identifier_permanent_address;
        $model->identifier_age = $request->identifier_age;
        $model->created_by = $request->created_by;
        $model->status = $request->status;
        $model->save();

        activity()->log('Accont Updated ');
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
        // dd('sohag'); 
        $model = SavingsAccount::findOrFail($id);

        $model->delete();
        // Activity Log
        activity()->log('Account Deleted.');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    }

    public function member_info(Request $request)
    {
        // dd($request->all()); 
        $member_id = $request->member_id;

        $member_info = Member::findOrFail($member_id);
        $img_link = asset('storage/member/' . $member_info->photo);
        // dd();

        return response()->json(['image' => $img_link, 'member_info' => $member_info]);
    }
}
