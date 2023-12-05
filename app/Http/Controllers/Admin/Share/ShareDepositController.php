<?php

namespace App\Http\Controllers\Admin\Share;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\accounts\LoanAccount;
use App\models\Member\Member;
use App\models\utility\Transaction;
use Carbon\Carbon;

class ShareDepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.share-deposit.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'share_account' => 'required',
            'new_deposit_amount' => 'required',
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

        $transaciton = new Transaction;

        $transaciton->share_id = $request->member_id; // here the member table's id is share id because I have kept share ifnormation  in this table .
        $transaciton->tx_type = 'share payment';
        $transaciton->type = 'credit';
        $transaciton->payment_status = 'paid';
        $transaciton->member_id = $request->member_id;
        $transaciton->invoice_no = $new_invoice_no;
        // $transaciton->interest_rate = $share_rate;
        $transaciton->grand_total_amt = $request->new_deposit_amount;
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    // Get select2 members  
    public function search_member(Request $request)
    {
        // dd('fahmida');
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


    public function get_share_info(Request $request)
    {

        $member = Member::findOrFail($request->member_id);

        // here share id is member id because in member table i have kept the share information 

        $current_share_info = current_payment_status('share', $request->member_id);

        $previous_transaction_information = view('admin.share-deposit.previous_tx_report', compact('member', 'current_share_info'))->render();

        $share_id  =  $member->prefix_share . numer_padding($member->code_share, get_option('digits_share_code'));


        return response()->json(['previous_transaction_information' => $previous_transaction_information, 'memebr' => $member, 'in_hand' => $current_share_info['in_hand'], 'share_id' => $share_id, 'share_withdrawable' => $current_share_info['share_withdrawable']]);
    }
}
