<?php

namespace App\Http\Controllers\Admin\DoubleBenifit;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\accounts\SavingsAccount;
use App\models\accounts\DoubleBenifitAccount;
use App\models\service_type\DoubleBenifitType;
use App\models\Member\Member;
use App\models\utility\Transaction;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;


class RejectedDoubleBenifitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.double_benifit.rejected-double-benifit.index');
    }

    //  ajax data table for showing data  in tabel 
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $model = DoubleBenifitAccount::where('approval', 'Refused')->get();
            return Datatables::of($model)
                ->addIndexColumn()
                ->editColumn('member', function ($model) {
                    return $model->member ? ('Name: ' . $model->member->name_in_bangla . '<br>Father:' . $model->member->father_name . '<br>Phone: ' . $model->member->contact_number . '<br>Address:' . $model->member->present_address_line_1 . '<br>Gender: ' . $model->member->gender) : "";
                })

                ->editColumn('image', function ($model) {
                    return  $model->member ? '<a href="' . asset('storage/member/' . $model->member->photo) . '" target="_blank"><img  src="' . asset('storage/member/' . $model->member->photo) . '" id="" width="120" class="rounded img-thumbnail"></a>' : '';
                })

                ->editColumn('double_benifit', function ($model) {
                    return 'ID: ' . $model->prefix . numer_padding($model->code, get_option('digits_double_benifit_code')) . '<br>Saving Amount: ' . $model->double_benifit_amt . ' (Taka)<br>Duration: ' . $model->double_benifit_duration . ' (' . $model->double_benifit_duration_type . ')<br>Interest: ' . $model->interest_rate . ' (%)<br>Interest: ' . $model->total_interest_amt . ' (Taka)<br>Grand Total: ' . $model->grand_total_double_benifit . ' (Taka)<br>Applied: ' . carbonDate($model->created_at) . '<br>Applied By: ' . $model->user->name . '<br>Rejection: ' . carbonDate($model->approval_date) . '<br><span class="text-danger">Rejected By: ' . $model->approved->name . '</span>';
                })

                ->editColumn('nomenee', function ($model) {
                    return (($model->nomenee_name1 ? ('<span class="text-danger">Nomenee 01</span><br>Name: ' . $model->nomenee_name1 . '<br>Relation: ' . $model->nomenee_relation_with_member1 . '<br>Persent: ' . $model->nomenee_part_asset1 . ' (%)') : '') . ($model->nomenee_name2 ? ('<br><span class="text-danger">Nomenee 02</span><br>Name: ' . $model->nomenee_name2 . '<br>Relation: ' . $model->nomenee_relation_with_member2 . '<br>Persent: ' . $model->nomenee_part_asset2 . ' (%)') : '') . ($model->nomenee_name3 ? ('<br><span class="text-danger">Nomenee 03</span><br>Name: ' . $model->nomenee_name3 . '<br>Relation: ' . $model->nomenee_relation_with_member3 . '<br>Persent: ' . $model->nomenee_part_asset3 . ' (%)') : ''));
                })

                ->addColumn('action', function ($model) {
                    return view('admin.double_benifit.rejected-double-benifit.action', compact('model'));
                })
                ->rawColumns(['action', 'member', 'nomenee', 'double_benifit', 'image'])->make(true);
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $account_information = DoubleBenifitAccount::where('uuid', $uuid)->firstOrFail();
        return view('admin.double_benifit.rejected-double-benifit.show', compact('account_information'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {

        $model = DoubleBenifitAccount::where('uuid', $uuid)->firstOrFail();

        $accounts = SavingsAccount::all();
        $member_ids = [];
        foreach ($accounts as $account) {
            $member_ids[] = $account->member_id;
        }
        $members = Member::whereIn('id', $member_ids)->get();
        $double_benifit_types = DoubleBenifitType::where('status', "Active")->get();

        return view('admin.double_benifit.rejected-double-benifit.edit', compact('model', "members", 'double_benifit_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $request->validate([

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

        $round = $request->round ? 1 : 0;

        $model =  DoubleBenifitAccount::where('uuid', $uuid)->firstOrFail();

        // $model->prefix = $request->prefix;
        // $model->code = $request->code;
        // $model->member_id = $request->member_id;



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

        activity()->log('Updated DPS Account ');
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
        $model = DoubleBenifitAccount::findOrFail($id);

        $model->delete();
        // Activity Log
        activity()->log('Account Deleted.');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    }

    // the following function is for DPS Application Approval
    public function approve($uuid)
    {
        // dd($uuid);
        $account_information = DoubleBenifitAccount::where('uuid', $uuid)->firstOrFail();
        return view('admin.double_benifit.rejected-double-benifit.approve', compact('account_information'));
    }

    // the following function is for adding DPS Application Approval
    public function add_approve(Request $request, $uuid)
    {
        $request->validate([
            'issue_date' => 'required',
            'completion_date' => 'required',
        ]);
        $model = DoubleBenifitAccount::where('uuid', $uuid)->firstOrFail();

        $model->approved_by = auth()->user()->id;
        $model->approval = $request->approval;
        $model->approval_comment = $request->approval_comment;
        $model->approval_date = date('Y-m-d');
        $model->issue_date = Carbon::createFromFormat('d/m/Y', $request->issue_date)->format('Y-m-d');
        $model->completion_date = Carbon::createFromFormat('d/m/Y', $request->completion_date)->format('Y-m-d');
        $model->save();

        //  new invoice no generation
        $uniqu_id = generate_id("invoice", true);
        $code_prefix = get_option('invoice_code_prefix');
        $code_digits = get_option('digits_invoice_code');
        $uniqu_id = numer_padding($uniqu_id, $code_digits);
        $new_invoice_no = $code_prefix . $uniqu_id;

        if ($model->approval == 'Approved') {
            $transaction =  Transaction::find($model->transaction_id);
            if (!$transaction) {
                $transaction = new Transaction;
            }

            $transaction->double_benifit_account_id = $model->id;
            $transaction->tx_type = 'double benifit payment';
            $transaction->type = 'credit';
            $transaction->payment_status = 'paid';
            $transaction->member_id = $model->member_id;
            $transaction->invoice_no = $new_invoice_no;
            $transaction->tx_date = Carbon::createFromFormat('d/m/Y', $request->issue_date)->format('Y-m-d');

            $transaction->total_amt = $model->double_benifit_amt;
            $transaction->interest_rate = $model->interest_rate;
            $transaction->total_interest_amt = $model->total_interest_amt;
            $transaction->grand_total_amt = $model->grand_total_double_benifit;

            $transaction->duration = $model->double_benifit_duration;
            $transaction->duration_type = $model->double_benifit_duration_type;

            $transaction->created_by = auth()->user()->id;
            $transaction->save();

            $model->transaction_id = $transaction->id;
            $model->save();
        } else {
            $tx = Transaction::find($model->transaction_id);
            if ($tx) {
                $tx->delete();
            }

            $model->transaction_id = null;
            $model->save();
        }


        activity()->log('Account Approved.');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Double Benifit Approval Info Taken'), 'load' => true]);
    }
}
