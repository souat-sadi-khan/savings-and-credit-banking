<?php

namespace App\Http\Controllers\Admin\DPS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\accounts\SavingsAccount;
use App\models\accounts\DpsAccount;
use App\models\service_type\DpsType;
use App\models\Member\Member;
use App\models\utility\Transaction;


class RejectedDpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dps.rejected-dps.index');
    }

    //  ajax data table for showing data  in tabel 
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $model = DpsAccount::where('approval', 'Refused')->get();
            return Datatables::of($model)
                ->addIndexColumn()
                ->editColumn('member', function ($model) {
                    return $model->member ? ('Name: ' . $model->member->name_in_bangla . '<br>Father:' . $model->member->father_name . '<br>Phone: ' . $model->member->contact_number . '<br>Address:' . $model->member->present_address_line_1 . '<br>Gender: ' . $model->member->gender) : "";
                })

                ->editColumn('image', function ($model) {
                    return  $model->member ? '<a href="' . asset('storage/member/' . $model->member->photo) . '" target="_blank"><img  src="' . asset('storage/member/' . $model->member->photo) . '" id="" width="120" class="rounded img-thumbnail"></a>' : '';
                })

                ->editColumn('dps', function ($model) {
                    return 'ID: ' . $model->prefix . numer_padding($model->code, get_option('digits_dps_code')) . '<br>Per Month: ' . $model->per_month_dps_amt . ' (Taka)<br>Duration: ' . $model->dps_duration . ' (' . $model->dps_duration_type . ')<br>Interest: ' . $model->interest_rate . ' (%)<br> Total DPS:' . $model->total_dps_amt . ' (Taka)<br>Interest: ' . $model->total_interest_amt . ' (Taka)<br>Grand Total: ' . $model->grand_total_dps . ' (Taka)<br>Applied: ' . carbonDate($model->created_at) . '<br>Applied By: ' . $model->user->name . '<br>Rejected: ' . carbonDate($model->approval_date) . '<br>rejected By: ' . $model->approved->name;
                })

                ->editColumn('nomenee', function ($model) {
                    return (($model->nomenee_name1 ? ('<span class="text-danger">Nomenee 01</span><br>Name: ' . $model->nomenee_name1 . '<br>Relation: ' . $model->nomenee_relation_with_member1 . '<br>Persent: ' . $model->nomenee_part_asset1 . ' (%)') : '') . ($model->nomenee_name2 ? ('<br><span class="text-danger">Nomenee 02</span><br>Name: ' . $model->nomenee_name2 . '<br>Relation: ' . $model->nomenee_relation_with_member2 . '<br>Persent: ' . $model->nomenee_part_asset2 . ' (%)') : '') . ($model->nomenee_name3 ? ('<br><span class="text-danger">Nomenee 03</span><br>Name: ' . $model->nomenee_name3 . '<br>Relation: ' . $model->nomenee_relation_with_member3 . '<br>Persent: ' . $model->nomenee_part_asset3 . ' (%)') : ''));
                })

                ->addColumn('action', function ($model) {
                    return view('admin.dps.rejected-dps.action', compact('model'));
                })
                ->rawColumns(['action', 'member', 'nomenee', 'dps', 'image'])->make(true);
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
        $account_information = DpsAccount::where('uuid', $uuid)->firstOrFail();
        return view('admin.dps.rejected-dps.show', compact('account_information'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {

        $model = DpsAccount::where('uuid', $uuid)->firstOrFail();

        $accounts = SavingsAccount::all();
        $member_ids = [];
        foreach ($accounts as $account) {
            $member_ids[] = $account->member_id;
        }
        $members = Member::whereIn('id', $member_ids)->get();
        $dps_types = DpsType::where('status', "Active")->get();

        return view('admin.dps.rejected-dps.edit', compact('model', "members", 'dps_types'));
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

        $round = $request->round ? 1 : 0;

        $model =  DpsAccount::where('uuid', $uuid)->firstOrFail();

        // $model->prefix = $request->prefix;
        // $model->code = $request->code;
        // $model->member_id = $request->member_id;


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
        $model = DpsAccount::findOrFail($id);

        $model->delete();
        // Activity Log
        activity()->log('Account Deleted.');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    }

    // the following function is for DPS Application Approval
    public function approve($uuid)
    {
        // dd($uuid);
        $account_information = DpsAccount::where('uuid', $uuid)->firstOrFail();
        return view('admin.dps.rejected-dps.approve', compact('account_information'));
    }

    // the following function is for adding DPS Application Approval
    public function add_approve(Request $request, $uuid)
    {

        $request->validate([
            'issue_date' => 'required',
            'completion_date' => 'required',
        ]);

        $model = DpsAccount::where('uuid', $uuid)->firstOrFail();


        $model->approved_by = auth()->user()->id;
        $model->approval = $request->approval;
        $model->approval_comment = $request->approval_comment;
        $model->approval_date = date('Y-m-d');
        $model->issue_date = date("Y-m-d", strtotime($request->issue_date));
        $model->completion_date = date("Y-m-d", strtotime($request->completion_date));
        $model->save();

        //  Now update the transaction table 
        if ($request->approval == 'Approved') {
            $transaction =  Transaction::find($model->transaction_id);
            if (!$transaction) {
                $transaction = new Transaction;
            }

            $transaction->tx_date = date("Y-m-d", strtotime($request->issue_date));
            $transaction->per_month_dps_amt = $model->per_month_dps_amt;
            $transaction->total_amt = $model->total_dps_amt;
            $transaction->interest_rate = $model->interest_rate;
            $transaction->total_interest_amt = $model->total_interest_amt;
            $transaction->grand_total_amt = $model->grand_total_dps;
            $transaction->duration = $model->dps_duration;
            $transaction->duration_type = $model->dps_duration_type;

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

        activity()->log('Account rejected.');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('DPS Approval Info Taken'), 'load' => true]);
    }
}
