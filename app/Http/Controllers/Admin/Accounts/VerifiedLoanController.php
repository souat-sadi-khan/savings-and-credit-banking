<?php

namespace App\Http\Controllers\Admin\Accounts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\accounts\LoanAccount;
use App\models\accounts\LoanConfirmation;
use App\models\Zone;
use App\models\ZoneArea;
use App\models\service_type\LoanType;
use App\models\utility\Transaction;
use Illuminate\Support\Carbon;


class VerifiedLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.accounts.verified-loan.index');
    }


    //  ajax data table for showing data  in tabel 
    public function datatable(Request $request)
    {
        // dd('sohag');
        if ($request->ajax()) {
            $model = LoanAccount::where('confirmation', 'Confirmed')->where('approval', '!=', 'Approved')->get();
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
                    return view('admin.accounts.verified-loan.action', compact('model'));
                })
                ->rawColumns(['action', 'member', 'business', 'loan', 'image'])->make(true);
        }
    }

    // edit last verification 
    public function edit($id)
    {

        $loan_info = LoanAccount::findOrFail($id);

        $loan_confirmation = LoanConfirmation::where('loan_account_id', $id)->latest()->first();

        $zone_id = $loan_info->zone_id;
        $zone_areas = ZoneArea::where('zone_id', $zone_id)->get();

        $zones = Zone::all();
        $loan_types = LoanType::where('status', "Active")->get();

        // dd($id);
        return view('admin.accounts.verified-loan.edit_verification', compact('loan_info', 'loan_confirmation', 'zones', 'zone_areas', 'loan_types'));
    }

    // update last verification 
    public function update_verification(Request $request, $uuid)
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
            // 'shop_rent_per_month' => 'numeric',
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

        $round = $request->round ? 1 : 0;

        $loan_account_id = $request->loan_account_id;
        $loan = LoanAccount::findOrFail($loan_account_id);
        $loan->business_shop_owner = $request->business_shop_owner;
        if ($request->confirmation == 'Refused') {
            $loan->approval = 'Not Approved';
        }
        $loan->confirmation = $request->confirmation;
        $loan->save();

        $model = LoanConfirmation::where('uuid', $uuid)->firstOrFail();
        $model->loan_account_id = $request->loan_account_id;
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


        // Now its time to update the transaction table according to the modificaton of investigation
        // if the investigation result is confirmed then the transaction table will be updated else the transactions related with this loan will be deleted
        if ($request->confirmation == 'Confirmed') {

            if ($model->round) {
                $total_interest_amt = round($model->loan_amount * $model->interest_rate / 100);
            } else {
                $total_interest_amt = $model->loan_amount * $model->interest_rate / 100;
            }

            // now calculating grand total loan ie loan with total interest amount
            $grand_total_loan = $model->loan_amount + $total_interest_amt;

            $transaction = Transaction::findOrFail($loan->transaction_id);
            $transaction->zone_id = $model->zone_id;
            $transaction->area_id = $model->area_id;
            $transaction->total_amt = $model->loan_amount;
            $transaction->interest_rate = $model->interest_rate;
            $transaction->total_interest_amt = $total_interest_amt;
            $transaction->installment_no = $model->installment_no;
            $transaction->per_installment_amt = $model->installment_total;
            $transaction->grand_total_amt = $grand_total_loan;
            $transaction->duration = $model->loan_duration;
            $transaction->duration_type = $model->loan_duration_type;
            $transaction->installment_duration = $model->installment_duration;
            $transaction->installment_duration_type = $model->installment_duration_type;
            $transaction->created_by = auth()->user()->id;

            $transaction->save();
        } else {
            // here the loan confirmation is refused hence the transactions will be deleted
            $trnx = Transaction::findOrFail($loan->transaction_id);
            $trnx->delete();
            // now updatind loan table and making transacton id null as transaction is deleted
            $loan->transaction_id = null;
            $loan->save();
        }

        activity()->log('Accont Updated ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated'), 'load' => true]);
    }

    // Update loan account for Approving 
    public function update(Request $request, $id)
    {
        $request->validate([
            'issue_date' => 'required',
            'completion_date' => 'required',
        ]);
        $issue_date = Carbon::createFromFormat('d/m/Y',  $request->issue_date)->format('Y-m-d');
        $completion_date = Carbon::createFromFormat('d/m/Y',  $request->completion_date)->format('Y-m-d');

        $model = LoanAccount::findOrFail($id);

        $model->approval = $request->approval;
        if ($request->approval == 'Refused') {
            $model->confirmation = $request->approval;
        } else {
            $model->confirmation = "Confirmed";
        }
        $model->approved_by = auth()->user()->id;
        $model->approval_date = date('Y-m-d h:i:s');
        $model->approval_comment = $request->approval_comment;
        $model->issue_date = $issue_date;
        $model->completion_date = $completion_date;
        $model->save();

        // now update loan confirmation table for making calculation easier

        $confirmation = LoanConfirmation::where('loan_account_id', $id)->get();
        foreach ($confirmation as $value) {
            $value->issue_date = $issue_date;
            $value->completion_date = $completion_date;
            $value->save();
        }

        // calculate total interest amount 
        if ($model->round) {
            $total_interest_amt = round($model->loan_amount * $model->interest_rate / 100);
        } else {
            $total_interest_amt = $model->loan_amount * $model->interest_rate / 100;
        }

        // now calculating grand total loan ie loan with total interest amount
        $grand_total_loan = $model->loan_amount + $total_interest_amt;

        //  new invoice no generation
        $uniqu_id = generate_id("invoice", true);
        $code_prefix = get_option('invoice_code_prefix');
        $code_digits = get_option('digits_invoice_code');
        $uniqu_id = numer_padding($uniqu_id, $code_digits);
        $new_invoice_no = $code_prefix . $uniqu_id;

        $transaction = new Transaction;
        if ($request->approval == 'Approved') {
            $transaction->zone_id = $model->zone_id;
            $transaction->area_id = $model->area_id;
            $transaction->loan_account_id = $model->id;
            $transaction->tx_type = 'loan payment';
            $transaction->type = 'debit';
            $transaction->payment_status = 'due';
            $transaction->member_id = $model->member_id;
            $transaction->invoice_no = $new_invoice_no;
            $transaction->tx_date = $issue_date;
            $transaction->total_amt = $model->loan_amount;
            $transaction->interest_rate = $model->interest_rate;
            $transaction->total_interest_amt = $total_interest_amt;
            $transaction->installment_no = $model->installment_no;
            $transaction->per_installment_amt = $model->installment_total;
            $transaction->grand_total_amt = $grand_total_loan;

            $transaction->duration = $model->loan_duration;
            $transaction->duration_type = $model->loan_duration_type;
            $transaction->installment_duration = $model->installment_duration;
            $transaction->installment_duration_type = $model->installment_duration_type;

            $transaction->created_by = auth()->user()->id;
            // dd('sohag');
            $transaction->save();
        }

        $model->transaction_id = $transaction->id;
        $model->save();

        activity()->log('Approval Information Accepted');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated'), 'load' => true]);
    }

    //Get loan and verification details for approval    
    public function approve($uuid)
    {
        $loan_info = LoanAccount::where('uuid', $uuid)->firstOrFail();

        $loan_confirmation = LoanConfirmation::where('loan_account_id', $loan_info->id)->latest()->first();
        $confirmation_history = LoanConfirmation::where('loan_account_id', $loan_info->id)->get();
        // dd($loan_info); 


        return view('admin.accounts.verified-loan.approve', compact('loan_info', 'loan_confirmation', 'confirmation_history'));
    }

    //    get previous verification history
    public function previous_history($id)
    {
        $loan_confirmation = LoanConfirmation::findOrFail($id);

        return view('admin.accounts.verified-loan.previous_history', compact('loan_confirmation'));
    }

    // delete last verification and update the loan according to existing last verification
    public function destroy($id)
    {

        $loan_confirmation = LoanConfirmation::where('loan_account_id', $id)->latest()->first();
        $loan_confirmation->delete();


        $loan_conf = LoanConfirmation::where('loan_account_id', $id)->latest()->first();
        // dd($loan_conf);

        $model = LoanAccount::findOrFail($id);
        if ($loan_conf) {
            $model->confirmation = $loan_conf->confirmation;
            $model->approval = 'Not Approved';
            $model->verified_by = $loan_conf->created_by;
        } else {
            $model->approval_comment = "Refused";
            $model->approval = 'Not Approved';
            $model->verified_by = null;
        }
        $model->save();

        activity()->log('Verification Deleted.');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    }

    public function get_completation_date(Request $request)
    {
        $date  = Carbon::createFromFormat('d/m/Y', $request->issue_date);
        // dd($request->duration);
        if ($request->duration_type == 'Year') {
            $completation_date = $date->addYears($request->duration);
        } else if ($request->duration_type == 'Month') {
            $completation_date = $date->addMonths($request->duration);
        } else {
            $completation_date = $date->addDays($request->duration);
        }
        $completation_date = $completation_date->format('d/m/Y');
        return response()->json(['completation_date' => $completation_date]);
    }
}
