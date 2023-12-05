<?php

namespace App\Http\Controllers\Admin\DPS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\accounts\SavingsAccount;
use App\models\accounts\DpsAccount;
use App\models\service_type\DpsType;
use App\models\Member\Member;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class DpsApplicationController extends Controller
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

        $code_prefix = get_option('dps_code_prefix');
        $code_digits = get_option('digits_dps_code');
        $uniqu_id = generate_id('dps', false);
        $uniqu_id = numer_padding($uniqu_id, $code_digits);

        $dps_types = DpsType::where('status', "Active")->get();
        return view('admin.dps.dps_application', compact('model', "code_prefix", "uniqu_id", 'dps_types'));
    }


    //  Store dps account information  
    public function store(Request $request)
    {
        $request->validate([
            'prefix' => 'required',
            'code' => 'required|numeric',
            'member_id' => 'required',

            'per_month_dps_amt' => 'required',
            'dps_type' => 'required',
            'interest_rate' => 'required|numeric',
            'dps_duration' => 'required|numeric',
            'dps_duration_type' => 'required',
            'total_dps_amt' => 'required|numeric',
            'total_interest_amt' => 'required|numeric',
            'grand_total_dps' => 'required|numeric',
            'nomenee_name1' => 'required',
            'nomenee_relation_with_member1' => 'required',
            'nomenee_part_asset1' => 'required',
            'nomenee_permanent_address1' => 'required',
            'identity_provider_id' => 'required',
            'status' => 'required',
        ]);

        $uuid =  Str::uuid()->toString();
        $round = $request->round ? 1 : 0;

        $model = new DpsAccount;

        $model->uuid = $uuid;
        $model->prefix = $request->prefix;
        $model->code = $request->code;
        $model->member_id = $request->member_id;


        $model->round = $round;
        $model->per_month_dps_amt = $request->per_month_dps_amt;
        $model->dps_type = $request->dps_type;
        $model->interest_rate = $request->interest_rate;
        $model->dps_duration = $request->dps_duration;
        $model->dps_duration_type = $request->dps_duration_type;
        $model->total_dps_amt = $request->total_dps_amt;
        $model->total_interest_amt = $request->total_interest_amt;
        $model->grand_total_dps = $request->grand_total_dps;
        $model->dps_reason = $request->dps_reason;

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

        generate_id("dps", true);

        activity()->log('Added DPS Account ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'load' => true]);
    }

    // this function is used to get loan type data while changing  the loan type
    public function dps_type(Request $request)
    {
        $dps_type_id = $request->dps_type_id;
        $dps_type = DpsType::findOrFail($dps_type_id);
        return response()->json($dps_type);
    }
}
