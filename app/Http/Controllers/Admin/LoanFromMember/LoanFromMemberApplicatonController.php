<?php

namespace App\Http\Controllers\Admin\LoanFromMember;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\accounts\SavingsAccount;
use App\models\accounts\FdrAccount;
use App\models\accounts\FdrMember;
use App\models\service_type\FdrType;
use App\models\Member\Member;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class LoanFromMemberApplicatonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $savings_accounts = SavingsAccount::all();
        $member_id = [];
        foreach ($savings_accounts as $savings_account) {
            $member_id[] = $savings_account->member_id;
        }
        $model = Member::whereIn('id', $member_id)->get();

        $code_prefix = get_option('loan_from_member_code_prefix');
        $code_digits = get_option('digits_loan_from_member_code');
        $uniqu_id = generate_id('loan_from_member', false);
        $uniqu_id = numer_padding($uniqu_id, $code_digits);

        $loan_types = FdrType::where('status', "Active")->get();
        // dd($loan_types);
        return view('admin.loan_from_member.application', compact('model', "code_prefix", "uniqu_id", 'loan_types'));
    }


    //  Store dps account information  
    public function store(Request $request)
    {
        $request->validate([
            'prefix' => 'required',
            'code' => 'required|numeric',
            'member_id' => 'required',

            'loan_amt' => 'required',
            'loan_type' => 'required',
            'interest_rate' => 'required|numeric',
            'loan_duration' => 'required|numeric',
            'loan_duration_type' => 'required',
            'total_interest_amt' => 'required|numeric',
            'grand_total_amt' => 'required|numeric',

            'nomenee_name1' => 'required',
            'nomenee_relation_with_member1' => 'required',
            'nomenee_part_asset1' => 'required',
            'nomenee_permanent_address1' => 'required',

            'status' => 'required',
        ]);
        $uuid =  Str::uuid()->toString();
        $round = $request->round ? 1 : 0;

        $model = new FdrAccount;

        $model->uuid = $uuid;
        $model->prefix = $request->prefix;
        $model->code = $request->code;
        // $model->member_id = $request->member_id;

        $model->round = $round;
        $model->loan_amt = $request->loan_amt;
        $model->loan_type = $request->loan_type;
        $model->interest_rate = $request->interest_rate;
        $model->loan_duration = $request->loan_duration;
        $model->loan_duration_type = $request->loan_duration_type;
        $model->total_interest_amt = $request->total_interest_amt;
        $model->grand_total_amt = $request->grand_total_amt;
        $model->loan_reason = $request->loan_reason;

        $model->nomenee_name1 = $request->nomenee_name1;
        $model->nomenee_fathers_name1 = $request->nomenee_fathers_name1;
        $model->nomenee_husbands_name1 = $request->nomenee_husbands_name1;
        $model->nomenee_relation_with_member1 = $request->nomenee_relation_with_member1;
        $model->nomenee_age1 = $request->nomenee_age1;
        $model->nomenee_part_asset1 = $request->nomenee_part_asset1;
        $model->nomenee_permanent_address1 = $request->nomenee_permanent_address1;

        $model->created_by = auth()->user()->id;
        $model->status = $request->status;
        $model->save();

        // now store member information to fdr member table 
        foreach ($request->member_id as $mem_id) {
            $member = new FdrMember;
            $member->fdr_id = $model->id;
            $member->member_id = $mem_id;
            $member->save();
        }

        generate_id("loan_from_member", true);

        activity()->log('Added Loan From Member Application ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'load' => true]);
    }

    // this function is used to get loan type data while changing  the loan type
    public function loan_type(Request $request)
    {
        $loan_type_id = $request->loan_type_id;
        $double_benifit_type = FdrType::findOrFail($loan_type_id);
        return response()->json($double_benifit_type);
    }
}
