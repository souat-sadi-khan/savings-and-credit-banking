<?php

namespace App\Http\Controllers\Admin\DoubleBenifit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\accounts\SavingsAccount;
use App\models\accounts\DoubleBenifitAccount;
use App\models\service_type\DoubleBenifitType;
use App\models\Member\Member;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;


class DoubleBenifitApplicationController extends Controller
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

        $code_prefix = get_option('double_benifit_code_prefix');
        $code_digits = get_option('digits_double_benifit_code');
        $uniqu_id = generate_id('double_benifit', false);
        $uniqu_id = numer_padding($uniqu_id, $code_digits);

        $double_benifit_types = DoubleBenifitType::where('status', "Active")->get();
        // dd($double_benifit_types);
        return view('admin.double_benifit.double_benifit_application', compact('model', "code_prefix", "uniqu_id", 'double_benifit_types'));
    }


    //  Store dps account information  
    public function store(Request $request)
    {

        $request->validate([
            'prefix' => 'required',
            'code' => 'required',
            'member_id' => 'required',

            'double_benifit_amt' => 'required',
            'double_benifit_type' => 'required',
            'interest_rate' => 'required',
            'double_benifit_duration' => 'required',
            'double_benifit_duration_type' => 'required',
            'total_interest_amt' => 'required',
            'grand_total_double_benifit' => 'required',

            'nomenee_name1' => 'required',
            'nomenee_relation_with_member1' => 'required',
            'nomenee_part_asset1' => 'required',
            'nomenee_permanent_address1' => 'required',
            'identity_provider_id' => 'required',
            'status' => 'required',
        ]);

        $uuid =  Str::uuid()->toString();
        $round = $request->round ? 1 : 0;

        $model = new DoubleBenifitAccount;

        $model->uuid = $uuid;
        $model->prefix = $request->prefix;
        $model->code = $request->code;
        $model->member_id = $request->member_id;


        $model->round = $round;
        $model->double_benifit_amt = $request->double_benifit_amt;
        $model->double_benifit_type = $request->double_benifit_type;
        $model->interest_rate = $request->interest_rate;
        $model->double_benifit_duration = $request->double_benifit_duration;
        $model->double_benifit_duration_type = $request->double_benifit_duration_type;
        $model->total_interest_amt = $request->total_interest_amt;
        $model->grand_total_double_benifit = $request->grand_total_double_benifit;
        $model->double_benifit_reason = $request->double_benifit_reason;

        $model->nomenee_name1 = $request->nomenee_name1;
        $model->nomenee_fathers_name1 = $request->nomenee_fathers_name1;
        $model->nomenee_husbands_name1 = $request->nomenee_husbands_name1;
        $model->nomenee_relation_with_member1 = $request->nomenee_relation_with_member1;
        $model->nomenee_age1 = $request->nomenee_age1;
        $model->nomenee_part_asset1 = $request->nomenee_part_asset1;
        $model->nomenee_permanent_address1 = $request->nomenee_permanent_address1;


        $model->nomenee_name2 = $request->nomenee_name2;
        $model->nomenee_fathers_name2 = $request->nomenee_fathers_name2;
        $model->nomenee_husbands_name2 = $request->nomenee_husbands_name2;
        $model->nomenee_relation_with_member2 = $request->nomenee_relation_with_member2;
        $model->nomenee_age2 = $request->nomenee_age2;
        $model->nomenee_part_asset2 = $request->nomenee_part_asset2;
        $model->nomenee_permanent_address2 = $request->nomenee_permanent_address2;

        $model->nomenee_name3 = $request->nomenee_name3;
        $model->nomenee_fathers_name3 = $request->nomenee_fathers_name3;
        $model->nomenee_husbands_name3 = $request->nomenee_husbands_name3;
        $model->nomenee_relation_with_member3 = $request->nomenee_relation_with_member3;
        $model->nomenee_age3 = $request->nomenee_age3;
        $model->nomenee_part_asset3 = $request->nomenee_part_asset3;
        $model->nomenee_permanent_address3 = $request->nomenee_permanent_address3;


        $model->identity_provider_id = $request->identity_provider_id;

        $model->created_by = auth()->user()->id;
        $model->status = $request->status;
        $model->save();

        generate_id("double_benifit", true);

        activity()->log('Added Double Benifit Account ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'load' => true]);
    }

    // this function is used to get loan type data while changing  the loan type
    public function double_benifit_type(Request $request)
    {
        $double_benifit_type_id = $request->double_benifit_type_id;
        $double_benifit_type = DoubleBenifitType::findOrFail($double_benifit_type_id);
        return response()->json($double_benifit_type);
    }
}
