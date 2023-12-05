<?php

namespace App\Http\Controllers\Admin\Accounts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\accounts\LoanAccount;
use App\models\accounts\SavingsAccount;
use App\models\accounts\LoanConfirmation;
use App\models\Zone;
use App\models\ZoneArea;
use App\models\service_type\LoanType;
use App\models\Member\Member;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class LoanAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.accounts.loan-account.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $savings_accounts = SavingsAccount::all();
        $member_id = [];
        foreach ($savings_accounts as $savings_account) {
            $member_id[] = $savings_account->member_id;
        }
        $model = Member::whereIn('id', $member_id)->get();

        $code_prefix = get_option('loan_account_code_prefix');
        $code_digits = get_option('digits_loan_account_code');
        $uniqu_id = generate_id('loan_account', false);
        $uniqu_id = numer_padding($uniqu_id, $code_digits);

        $zones = Zone::all();


        $loan_types = LoanType::where('status', "Active")->get();

        return view('admin.accounts.loan-account.create', compact('model', "code_prefix", "uniqu_id", "zones", 'loan_types'));
    }

    //  Store loan accout information 
    public function store(Request $request)
    {
        $request->validate([
            'prefix' => 'required',
            'code' => 'required|numeric',
            'member_id' => 'required',
            'zone_id' => 'required',
            'area_id' => 'required',
            'business_name' => 'required',
            'duration_indication' => 'required',
            'business_address' => 'required',
            'business_investment' => 'required',
            'business_stock' => 'required',
            'business_average_sell' => 'required',
            'business_average_income' => 'required',
            'business_shop_owner' => 'required',
            'loan_amount' => 'required',
            'loan_type' => 'required',
            'installment_no' => 'required|numeric',
            'installment_amount' => 'required|numeric',
            'installment_interest' => 'required|numeric',
            'installment_total' => 'required|numeric',
            'loan_duration' => 'required|numeric',
            'loan_duration_type' => 'required',
            'installment_duration' => 'required|numeric',
            'installment_duration_type' => 'required',
            'sponsonr_name1' => 'required',
            'sponsor_relation_with_member1' => 'required',
            'sponsor_permanent_address1' => 'required',
            'sponsonr_name2' => 'required',
            'sponsor_relation_with_member2' => 'required',
            'sponsor_permanent_address2' => 'required',
            'status' => 'required',
        ]);

        $uuid =  Str::uuid()->toString();
        $round = $request->round ? 1 : 0;

        $model = new LoanAccount;

        $model->uuid = $uuid;
        $model->prefix = $request->prefix;
        $model->code = $request->code;
        $model->member_id = $request->member_id;
        $model->zone_id = $request->zone_id;
        $model->area_id = $request->area_id;
        $model->business_name = $request->business_name;
        $model->business_duration = $request->business_duration;
        $model->duration_indication = $request->duration_indication;
        $model->business_address = $request->business_address;
        $model->business_investment = $request->business_investment;
        $model->business_stock = $request->business_stock;
        $model->business_average_sell = $request->business_average_sell;
        $model->business_average_income = $request->business_average_income;
        $model->business_shop_owner = $request->business_shop_owner;
        $model->round = $round;
        $model->loan_amount = $request->loan_amount;
        $model->loan_type = $request->loan_type;
        $model->interest_rate = $request->interest_rate;
        $model->installment_no = $request->installment_no;
        $model->installment_amount = $request->installment_amount;
        $model->installment_interest = $request->installment_interest;
        $model->installment_total = $request->installment_total;
        $model->loan_duration = $request->loan_duration;
        $model->loan_duration_type = $request->loan_duration_type;
        $model->installment_duration = $request->installment_duration;
        $model->installment_duration_type = $request->installment_duration_type;
        $model->loan_reason = $request->loan_reason;
        $model->sponsonr_name1 = $request->sponsonr_name1;
        $model->sponsor_fathers_name1 = $request->sponsor_fathers_name1;
        $model->sponsor_husbands_name1 = $request->sponsor_husbands_name1;
        $model->sponsor_relation_with_member1 = $request->sponsor_relation_with_member1;
        $model->sponsor_account_no1 = $request->sponsor_account_no1;
        $model->sponsor_permanent_address1 = $request->sponsor_permanent_address1;
        $model->sponsonr_name2 = $request->sponsonr_name2;
        $model->sponsor_fathers_name2 = $request->sponsor_fathers_name2;
        $model->sponsor_husbands_name2 = $request->sponsor_husbands_name2;
        $model->sponsor_relation_with_member2 = $request->sponsor_relation_with_member2;
        $model->sponsor_account_no2 = $request->sponsor_account_no2;
        $model->sponsor_permanent_address2 = $request->sponsor_permanent_address2;
        $model->created_by = auth()->user()->id;
        $model->status = $request->status;
        $model->save();

        generate_id("loan_account", true);

        activity()->log('Added Account ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'load' => true]);
    }
    //  ajax data table for showing data  in tabel 
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $model = LoanAccount::where('confirmation', null)->get();
            return Datatables::of($model)
                ->addIndexColumn()
                ->editColumn('member', function ($model) {
                    return $model->member ? ('Name: ' . $model->member->name_in_bangla . '<br>Father:' . $model->member->father_name . '<br>Phone: ' . $model->member->contact_number . '<br>Address:' . $model->member->present_address_line_1 . '<br>Gender: ' . $model->member->gender) : "";
                })

                ->editColumn('image', function ($model) {
                    return  $model->member ? '<a href="' . asset('storage/member/' . $model->member->photo) . '" target="_blank"><img  src="' . asset('storage/member/' . $model->member->photo) . '" id="" width="120" class="rounded img-thumbnail"></a>' : '';
                })

                ->editColumn('business', function ($model) {
                    return 'Name: ' . $model->business_name . '<br>Address: ' . $model->business_address . '<br>Investment: ' . $model->business_investment . ' (৳)<br> Stock:' . $model->business_stock . ' (৳)<br>Sell: ' . $model->business_average_sell . ' (৳/day)<br>Income: ' . $model->business_average_income . ' (৳/day)<br>Shop Owner: ' . $model->business_shop_owner;
                })

                ->editColumn('loan', function ($model) {
                    return ('A/C No: ' . $model->prefix . numer_padding($model->code, get_option('digits_loan_account_code')) . '<br>Loan Amount: ' . $model->loan_amount . ' (৳)<br>Duration: ' . $model->loan_duration . ' (' . $model->loan_duration_type . ')<br>Interest: ' . $model->interest_rate . ' (%)<br>Per Installment: ' . $model->installment_total . ' (৳)<br>No Of Installments: ' . $model->installment_no . '<br>Installment Interval: ' . $model->installment_duration . ' (' . $model->installment_duration_type . ')' . '<br>Status: ' . (($model->status == "Active") ? '<span class="badge badge-success">' . $model->status . '</span>' : '<span class="badge badge-danger">' . $model->status . '</span>') . '<br> Applied At: ' . carbonDate($model->created_at));
                })

                ->addColumn('action', function ($model) {
                    return view('admin.accounts.loan-account.action', compact('model'));
                })
                ->rawColumns(['action', 'member', 'business', 'loan', 'image'])->make(true);
        }
    }

    // show all information of a loan request
    public function show($uuid)
    {
        $account_information = LoanAccount::where('uuid', $uuid)->firstOrFail();
        $member = Member::findOrFail($account_information->member_id);
        return view('admin.accounts.loan-account.show', compact('account_information', 'member'));
    }

    //    Edit loan account informatio 
    public function edit($id)
    {
        $uuid = $id;
        $loan_info = LoanAccount::where('uuid', $uuid)->firstOrFail();
        $zone_id = $loan_info->zone_id;

        $zone_areas = ZoneArea::where('zone_id', $zone_id)->get();

        $savings_accounts = SavingsAccount::all();
        $member_id = [];
        foreach ($savings_accounts as $savings_account) {
            $member_id[] = $savings_account->member_id;
        }
        $members = Member::whereIn('id', $member_id)->get();
        $zones = Zone::all();
        $loan_types = LoanType::where('status', "Active")->get();

        return view('admin.accounts.loan-account.edit', compact('members', "zones", 'loan_types', 'loan_info', 'zone_areas'));
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
        $model = LoanAccount::findOrFail($id);

        $request->validate([
            'prefix' => 'required',
            'code' => 'required|numeric',
            'member_id' => 'required',
            'zone_id' => 'required',
            'area_id' => 'required',
            'business_name' => 'required',
            'duration_indication' => 'required',
            'business_address' => 'required',
            'business_investment' => 'required',
            'business_stock' => 'required',
            'business_average_sell' => 'required',
            'business_average_income' => 'required',
            'business_shop_owner' => 'required',
            'loan_amount' => 'required',
            'loan_type' => 'required',
            'installment_no' => 'required|numeric',
            'installment_amount' => 'required|numeric',
            'installment_interest' => 'required|numeric',
            'installment_total' => 'required|numeric',
            'loan_duration' => 'required|numeric',
            'loan_duration_type' => 'required',
            'installment_duration' => 'required|numeric',
            'installment_duration_type' => 'required',
            'sponsonr_name1' => 'required',
            'sponsor_relation_with_member1' => 'required',
            'sponsor_permanent_address1' => 'required',
            'sponsonr_name2' => 'required',
            'sponsor_relation_with_member2' => 'required',
            'sponsor_permanent_address2' => 'required',
            'status' => 'required',
        ]);

        $round = $request->round ? 1 : 0;

        $model->prefix = $request->prefix;
        $model->code = $request->code;
        $model->member_id = $request->member_id;
        $model->zone_id = $request->zone_id;
        $model->area_id = $request->area_id;
        $model->business_name = $request->business_name;
        $model->business_duration = $request->business_duration;
        $model->duration_indication = $request->duration_indication;
        $model->business_address = $request->business_address;
        $model->business_investment = $request->business_investment;
        $model->business_stock = $request->business_stock;
        $model->business_average_sell = $request->business_average_sell;
        $model->business_average_income = $request->business_average_income;
        $model->business_shop_owner = $request->business_shop_owner;
        $model->round = $round;
        $model->loan_amount = $request->loan_amount;
        $model->loan_type = $request->loan_type;
        $model->interest_rate = $request->interest_rate;
        $model->installment_no = $request->installment_no;
        $model->installment_amount = $request->installment_amount;
        $model->installment_interest = $request->installment_interest;
        $model->installment_total = $request->installment_total;
        $model->loan_duration = $request->loan_duration;
        $model->loan_duration_type = $request->loan_duration_type;
        $model->installment_duration = $request->installment_duration;
        $model->installment_duration_type = $request->installment_duration_type;
        $model->loan_reason = $request->loan_reason;
        $model->sponsonr_name1 = $request->sponsonr_name1;
        $model->sponsor_fathers_name1 = $request->sponsor_fathers_name1;
        $model->sponsor_husbands_name1 = $request->sponsor_husbands_name1;
        $model->sponsor_relation_with_member1 = $request->sponsor_relation_with_member1;
        $model->sponsor_account_no1 = $request->sponsor_account_no1;
        $model->sponsor_permanent_address1 = $request->sponsor_permanent_address1;
        $model->sponsonr_name2 = $request->sponsonr_name2;
        $model->sponsor_fathers_name2 = $request->sponsor_fathers_name2;
        $model->sponsor_husbands_name2 = $request->sponsor_husbands_name2;
        $model->sponsor_relation_with_member2 = $request->sponsor_relation_with_member2;
        $model->sponsor_account_no2 = $request->sponsor_account_no2;
        $model->sponsor_permanent_address2 = $request->sponsor_permanent_address2;
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
        $model = LoanAccount::findOrFail($id);

        $model->delete();
        // Activity Log
        activity()->log('Account Deleted.');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    }

    // the following function is used to get member information while changing member 
    public function member_info(Request $request)
    {
        $member_id = $request->member_id;

        $member_info = Member::findOrFail($member_id);
        $img_link = asset('storage/member/' . $member_info->photo);
        $sign_link = asset('storage/member/' . $member_info->signature);

        return response()->json(['image' => $img_link, 'member_info' => $member_info, 'sign' => $sign_link]);
    }

    // the following function is used to get aras of corresponding zone while changing zone 
    public function zone_area(Request $request)
    {
        $zone_id = $request->zone_id;
        $areas = ZoneArea::with('area')->where('zone_id', $zone_id)->get();
        $options = '';

        foreach ($areas as $area) {
            $options .= '<option value="' . $area->area->id . '">' . $area->area->area . ', ' . $area->area->thana . '</option>';
        }

        return response()->json($options);
    }

    // this function is used to get loan type data while changing  the loan type
    public function loan_type(Request $request)
    {
        $loan_type_id = $request->loan_type_id;
        $loan_type = LoanType::findOrFail($loan_type_id);

        return response()->json($loan_type);
    }

    // fetching data for adding verification and showing those information in the form
    public function verification($uuid)
    {
        $loan_info = LoanAccount::where('uuid', $uuid)->firstOrFail();

        $loan_id = $loan_info->id;

        $loan_confirmation = LoanConfirmation::where('loan_account_id', $loan_id)->latest()->first();

        $zone_id = $loan_info->zone_id;
        $zone_areas = ZoneArea::where('zone_id', $zone_id)->get();

        $savings_accounts = SavingsAccount::all();
        $member_id = [];
        foreach ($savings_accounts as $savings_account) {
            $member_id[] = $savings_account->member_id;
        }
        $members = Member::whereIn('id', $member_id)->get();
        $zones = Zone::all();
        $loan_types = LoanType::where('status', "Active")->get();

        return view('admin.accounts.loan-account.verification', compact('members', "zones", 'loan_types', 'loan_info', 'zone_areas', 'loan_confirmation'));
    }

    // Saving verification information into database
    public function add_verification(Request $request)
    {

        $request->validate([
            'loan_account_id' => 'required',
            'prefix' => 'required',
            'code' => 'required|numeric',
            'member_id' => 'required',
            'zone_id' => 'required',
            'area_id' => 'required',
            'business_name' => 'required',
            'duration_indication' => 'required',
            'business_address' => 'required',
            'business_investment' => 'required',
            'business_stock' => 'required',
            'business_average_sell' => 'required',
            'business_average_income' => 'required',
            'business_shop_owner' => 'required',
            'investment_sector' => 'required',
            'loan_amount' => 'required',
            'loan_type' => 'required',
            'installment_no' => 'required|numeric',
            'installment_amount' => 'required|numeric',
            'installment_interest' => 'required|numeric',
            'installment_total' => 'required|numeric',
            'loan_duration' => 'required|numeric',
            'loan_duration_type' => 'required',
            'installment_duration' => 'required|numeric',
            'installment_duration_type' => 'required',
            'sponsonr_name1' => 'required',
            'sponsor_relation_with_member1' => 'required',
            'sponsor_permanent_address1' => 'required',
            'sponsonr_name2' => 'required',
            'sponsor_relation_with_member2' => 'required',
            'sponsor_permanent_address2' => 'required',
        ]);

        $uuid =  Str::uuid()->toString();
        $round = $request->round ? 1 : 0;

        $loan_account_id = $request->loan_account_id;
        $loan = LoanAccount::findOrFail($loan_account_id);
        $loan->business_shop_owner = $request->business_shop_owner;
        $loan->confirmation = $request->confirmation;
        $loan->save();

        $model = new LoanConfirmation;

        $model->loan_account_id = $request->loan_account_id;
        $model->uuid = $uuid;
        $model->prefix = $request->prefix;
        $model->code = $request->code;
        $model->member_id = $request->member_id;
        $model->zone_id = $request->zone_id;
        $model->area_id = $request->area_id;
        $model->business_name = $request->business_name;
        $model->business_duration = $request->business_duration;
        $model->duration_indication = $request->duration_indication;
        $model->business_address = $request->business_address;
        $model->business_investment = $request->business_investment;
        $model->business_stock = $request->business_stock;
        $model->business_average_sell = $request->business_average_sell;
        $model->business_average_income = $request->business_average_income;

        $model->business_shop_owner = $request->business_shop_owner;
        $model->shop_previous_position_owner = $request->shop_previous_position_owner;
        $model->position_buy_date = $request->position_buy_date;
        $model->rent_start_date = $request->rent_start_date;
        $model->shop_rent_per_month = $request->shop_rent_per_month;
        $model->shop_owner_name = $request->shop_owner_name;
        $model->shop_booked_from = $request->shop_booked_from;
        $model->investment_sector = $request->investment_sector;

        $model->round = $round;
        $model->loan_amount = $request->loan_amount;
        $model->loan_type = $request->loan_type;
        $model->interest_rate = $request->interest_rate;
        $model->installment_no = $request->installment_no;
        $model->installment_amount = $request->installment_amount;
        $model->installment_interest = $request->installment_interest;
        $model->installment_total = $request->installment_total;
        $model->loan_duration = $request->loan_duration;
        $model->loan_duration_type = $request->loan_duration_type;
        $model->installment_duration = $request->installment_duration;
        $model->installment_duration_type = $request->installment_duration_type;
        $model->loan_reason = $request->loan_reason;
        $model->sponsonr_name1 = $request->sponsonr_name1;
        $model->sponsor_fathers_name1 = $request->sponsor_fathers_name1;
        $model->sponsor_husbands_name1 = $request->sponsor_husbands_name1;
        $model->sponsor_relation_with_member1 = $request->sponsor_relation_with_member1;
        $model->sponsor_account_no1 = $request->sponsor_account_no1;
        $model->sponsor_permanent_address1 = $request->sponsor_permanent_address1;
        $model->sponsonr_name2 = $request->sponsonr_name2;
        $model->sponsor_fathers_name2 = $request->sponsor_fathers_name2;
        $model->sponsor_husbands_name2 = $request->sponsor_husbands_name2;
        $model->sponsor_relation_with_member2 = $request->sponsor_relation_with_member2;
        $model->sponsor_account_no2 = $request->sponsor_account_no2;
        $model->sponsor_permanent_address2 = $request->sponsor_permanent_address2;
        $model->created_by = auth()->user()->id;
        $model->confirmation = $request->confirmation;
        $model->save();


        activity()->log('Added Confirmation  ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'load' => true]);
    }
}
