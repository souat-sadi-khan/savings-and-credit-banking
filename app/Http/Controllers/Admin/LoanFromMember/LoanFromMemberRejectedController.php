<?php

namespace App\Http\Controllers\Admin\LoanFromMember;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\accounts\SavingsAccount;
use App\models\accounts\FdrAccount;
use App\models\service_type\FdrType;
use App\models\Member\Member;
use App\models\utility\Transaction;
use Illuminate\Support\Carbon;


class LoanFromMemberRejectedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.loan_from_member.rejected.index');
    }

    //  ajax data table for showing data  in tabel 
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $model = FdrAccount::where('approval', 'Refused')->with('fdrMember')->get();
            // dd($model);
            return Datatables::of($model)
                ->addIndexColumn()
                ->editColumn('member', function ($model) {
                    $memb = '<div class="row">';
                    $i = 0;
                    foreach ($model->fdrMember as $mem_info) {
                        $i++;
                        $total_no_of_member =  count($model->fdrMember);
                        $member_details = $mem_info->member;
                        // dd($total_no_of_member);
                        $div_no = $total_no_of_member > 1 ? 6 : 12;
                        $memb .= '<div class="col-md-' . $div_no . '"><span class="text-danger">Member 0' . $i .
                            '</span><br>Name: ' . $member_details->name_in_bangla .
                            '<br>Father:' . $member_details->father_name .
                            '<br>Phone: ' . $member_details->contact_number .
                            '<br>Address:' . $member_details->present_address_line_1 .
                            '<br>Gender: ' . $member_details->gender . '</div>';
                    }
                    $memb .= '</div>';
                    return $memb;
                })


                ->editColumn('loan_info', function ($model) {
                    return 'ID: ' . $model->prefix . numer_padding($model->code, get_option('digits_loan_from_member_code')) . '<br>Loan Amount: ' . $model->loan_amt . ' (Taka)<br>Duration: ' . $model->loan_duration . ' (' . $model->loan_duration_type . ')<br>Interest: ' . $model->interest_rate . ' (%)<br>Interest: ' . $model->total_interest_amt . ' (Taka)<br>Grand Total: ' . $model->grand_total_amt . ' (Taka)<br>Rejected: ' . carbonDate($model->created_at) . '<br>Rejected By: ' . $model->user->name;
                })

                ->editColumn('nomenee', function ($model) {
                    return (($model->nomenee_name1 ? ('Name: ' . $model->nomenee_name1 . '<br>Relation: ' . $model->nomenee_relation_with_member1 . '<br>Persent: ' . $model->nomenee_part_asset1 . ' (%)') : ''));
                })

                ->addColumn('action', function ($model) {
                    return view('admin.loan_from_member.rejected.action', compact('model'));
                })
                ->rawColumns(['action', 'member', 'nomenee', 'loan_info'])->make(true);
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
        $account_information = FdrAccount::where('uuid', $uuid)->with('fdrMember')->firstOrFail();
        return view('admin.loan_from_member.rejected.show', compact('account_information'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {

        $model = FdrAccount::where('uuid', $uuid)->with('fdrMember')->firstOrFail();

        $accounts = SavingsAccount::all();
        $member_ids = [];
        foreach ($accounts as $account) {
            $member_ids[] = $account->member_id;
        }
        $members = Member::whereIn('id', $member_ids)->get();
        $fdr_types = FdrType::where('status', "Active")->get();

        return view('admin.loan_from_member.rejected.edit', compact('model', "members", 'fdr_types'));
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

        $round = $request->round ? 1 : 0;

        $model =  FdrAccount::where('uuid', $uuid)->firstOrFail();
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

        activity()->log('Updated Loan From Member Account ');
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
        $model = FdrAccount::findOrFail($id);
        $model->delete();
        // Activity Log
        activity()->log('Account Deleted.');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    }

    // the following function is for DPS Application Approval
    public function approve($uuid)
    {
        // dd($uuid);
        $account_information = FdrAccount::where('uuid', $uuid)->with('fdrMember')->firstOrFail();
        return view('admin.loan_from_member.rejected.approve', compact('account_information'));
    }

    // the following function is for adding DPS Application Approval
    public function add_approve(Request $request, $uuid)
    {
        $request->validate([

            'receipt_no' => 'required',
            'issue_date' => 'required',
            'completion_date' => 'required',
        ]);
        $model = FdrAccount::where('uuid', $uuid)->firstOrFail();

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

        if ($request->approval == 'Approved') {
            $transaction =  Transaction::find($model->transaction_id);
            if (!$transaction) {
                $transaction = new Transaction;
            }

            $transaction->fdr_account_id = $model->id;
            $transaction->tx_type = 'fdr payment';
            $transaction->type = 'credit';
            $transaction->payment_status = 'paid';
            $transaction->member_id = $model->member_id;
            $transaction->invoice_no = $new_invoice_no;
            $transaction->tx_date = $model->issue_date;

            $transaction->total_amt = $model->loan_amt;
            $transaction->interest_rate = $model->interest_rate;
            $transaction->total_interest_amt = $model->total_interest_amt;
            $transaction->grand_total_amt = $model->grand_total_double_benifit;

            $transaction->duration = $model->double_benifit_duration;
            $transaction->duration_type = $model->grand_total_amt;

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
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Approval Info Taken'), 'load' => true]);
    }

    public function get_completation_date(Request $request)
    {
        $date  = Carbon::createFromFormat('d/m/Y', $request->issue_date);

        if ($request->duration_type == 'Year') {
            $completation_date = $date->addYears($request->loan_duration);
        } else {
            $completation_date = $date->addMonths($request->loan_duration);
        }
        $completation_date = $completation_date->format('d/m/Y');
        return response()->json(['completation_date' => $completation_date]);
    }
}
