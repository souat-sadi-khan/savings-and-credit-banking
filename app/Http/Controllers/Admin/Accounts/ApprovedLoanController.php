<?php

namespace App\Http\Controllers\Admin\Accounts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\accounts\LoanAccount;
use App\models\accounts\LoanConfirmation;
use App\models\utility\Transaction;

class ApprovedLoanController extends Controller
{

    public function index()
    {
        return view('admin.accounts.approved-loan.index');
    }

    //  ajax data table for showing data  in tabel 
    public function datatable(Request $request)
    {
        // dd('sohag');
        if ($request->ajax()) {
            $model = LoanAccount::where('approval', 'Approved')->get();
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
                    return view('admin.accounts.approved-loan.action', compact('model'));
                })
                ->rawColumns(['action', 'member', 'business', 'loan', 'image'])->make(true);
        }
    }

    public function show($uuid)
    {
        $loan_info = LoanAccount::where('uuid', $uuid)->firstOrFail();
        $transaction_info = Transaction::where('loan_account_id', $loan_info->id)->where('tx_type', 'loan repay')->get();
        $due_and_payment_status = current_payment_status('loan', $loan_info->id);


        $loan_confirmation = LoanConfirmation::where('loan_account_id', $loan_info->id)->latest()->first();
        // dd($loan_confirmation);
        return view('admin.accounts.approved-loan.show', compact('loan_info', 'loan_confirmation', 'transaction_info', 'due_and_payment_status'));
    }

    public function verification_info($uuid)
    {
        $loan_info = LoanAccount::where('uuid', $uuid)->firstOrFail();

        $loan_confirmation = LoanConfirmation::where('loan_account_id', $loan_info->id)->latest()->first();
        // dd($loan_confirmation); 
        return view('admin.accounts.approved-loan.show', compact('loan_info', 'loan_confirmation'));
    }
}
