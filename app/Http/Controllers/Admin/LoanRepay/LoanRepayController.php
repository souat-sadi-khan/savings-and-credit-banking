<?php

namespace App\Http\Controllers\Admin\LoanRepay;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\accounts\LoanAccount;
use App\models\Member\Member;
use App\models\utility\Transaction;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class LoanRepayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.loan-repay.index');
    }



    public function store(Request $request)
    {

        $request->validate([
            'member_id' => 'required',
            'loan_id' => 'required',
            'no_of_paying_installment' => 'required',
            'total_repay' => 'required',
            'repay_interest' => 'required',
            'repay_loan' => 'required',
            'total_due' => 'required',
            'interest_due' => 'required',
            'loan_due' => 'required',
            'payment_method' => 'required',
        ]);
        // backend calculation
        $loan_info = LoanAccount::where('id', $request->loan_id)->with('loan_confirmation')->latest()->first();

        $loan_information = $loan_info->loan_confirmation;
        $transaction_info = Transaction::where('loan_account_id', $request->loan_id)->where('tx_type', 'loan payment')->first();

        $due_and_payment_status = current_payment_status('loan', $request->loan_id);

        // validating if the no of paying installment is less than the due installment no or no

        if ($request->no_of_paying_installment > $due_and_payment_status['due_installment_no']) {
            throw  ValidationException::withMessages(['message' => 'Remember: Due Installment No is ' . $request->no_of_paying_installment]);
        } else if ($request->no_of_paying_installment < $due_and_payment_status['due_installment_no']) {

            $total_interest_amt = $loan_information->installment_interest * $request->no_of_paying_installment;

            $total_repay_amt = $request->total_repay;
            $total_loan_amt = $total_repay_amt - $total_interest_amt;
            if ($total_loan_amt < 0) {
                throw  ValidationException::withMessages(['message' => 'You have to pay atleast' . $loan_information->installment_interest . ' Taka. For no of installments: ' . $request->no_of_paying_installment]);
            }
            $grand_total_amt = $total_repay_amt;
        } else if ($request->no_of_paying_installment == $due_and_payment_status['due_installment_no']) {
            // if paying installment no is equal to the due installment no then the dues will be the values that to be paid 
            $total_loan_amt = $due_and_payment_status['due_total'];
            $total_interest_amt = $due_and_payment_status['due_interest'];
            $grand_total_amt = $due_and_payment_status['due_grand_total'];

            if ($grand_total_amt < $request->total_repay) {
                throw  ValidationException::withMessages(['message' => 'This the last payment. You have to pay ' . $grand_total_amt]);
            }
        }

        // generate new invoice no
        $uniqu_id = generate_id("invoice", true);
        $code_prefix = get_option('invoice_code_prefix');
        $code_digits = get_option('digits_invoice_code');
        $uniqu_id = numer_padding($uniqu_id, $code_digits);
        $new_invoice_no = $code_prefix . $uniqu_id;

        $model = new Transaction;

        $model->loan_account_id = $request->loan_id;
        $model->tx_type = 'loan repay';
        $model->type = 'credit';
        $model->payment_status = 'partial';
        $model->member_id = $request->member_id;
        $model->invoice_no = $new_invoice_no;
        $tx_date = Carbon::createFromFormat('d/m/Y', $request->tx_date)->format('Y-m-d');
        $model->tx_date = $tx_date;
        $model->total_amt = $total_loan_amt;
        $model->total_interest_amt = $total_interest_amt;
        $model->installment_no = $loan_info->installment_no;
        $model->grand_total_amt = $grand_total_amt;
        $model->per_installment_amt = $loan_information->installment_total;
        $model->no_of_paying_installment = $request->no_of_paying_installment;
        $model->duration = $loan_information->duration;
        $model->duration_type = $loan_information->duration_type;
        $model->installment_duration = $loan_information->installment_duration;
        $model->installment_duration_type = $loan_information->installment_duration_type;

        $model->payment_method = $request->payment_method;
        $model->mob_banking_name = $request->mob_banking_name;
        $model->mob_account_holder = $request->mob_account_holder;
        $model->sending_mob_no = $request->sending_mob_no;
        $model->receiving_mob_no = $request->receiving_mob_no;
        $model->mob_tx_id = $request->mob_tx_id;
        $mob_payment_date = $request->mob_payment_date ? Carbon::createFromFormat('d/m/Y', $request->mob_payment_date)->format('Y-m-d') : null;
        $model->mob_payment_date = $mob_payment_date;
        $model->bank_name = $request->bank_name;
        $model->account_holder = $request->account_holder;
        $model->account_no = $request->account_no;
        $model->check_no = $request->check_no;

        $check_active_date = $request->check_active_date ? Carbon::createFromFormat('d/m/Y', $request->check_active_date)->format('Y-m-d') : null;

        $check_active_date =  $request->check_active_date ? Carbon::createFromFormat('d/m/Y', $request->check_active_date)->format('Y-m-d') : null;
        $model->check_active_date = $check_active_date;
        $model->additional_note = $request->additional_note;
        $model->parent_id = $transaction_info->id;
        $model->created_by = auth()->user()->id;
        $model->save();

        // now update the loan payment of this loan 

        $due_and_payment_status = current_payment_status('loan', $request->loan_id);

        if ($due_and_payment_status['due_grand_total'] > 0) {
            $transaction_info->payment_status = 'partial';
        } else {
            $transaction_info->payment_status = 'paid';
        }
        $transaction_info->save();

        activity()->log('Loan Repay added');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'load' => true]);
    }



    // Get select2 members  
    public function search_member(Request $request)
    {
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
    public function get_loan_account(Request $request)
    {
        $loans = LoanAccount::where('member_id', $request->member_id)->where('approval', 'Approved')->where('status', 'Active')->get();
        $options = ' <option value="">Please Select One ..</option>';
        if ($loans) {
            foreach ($loans as  $loan) {
                $options .= '<option value="' . $loan->id . '">' . $loan->prefix . numer_padding($loan->code, get_option("digits_loan_account_code")) . ' (' . carbonDate($loan->approval_date) . ')</option>';
            }
        }

        return response()->json(['options' => $options]);
    }

    public function get_loan_info(Request $request)
    {

        $loan_info = LoanAccount::where('id', $request->loan_id)->with('loan_confirmation', 'member')->latest()->first();

        $loan_information = $loan_info->loan_confirmation;
        $member_information = $loan_info->member;
        $transaction_info = Transaction::where('loan_account_id', $request->loan_id)->where('tx_type', 'loan repay')->get();

        $due_and_payment_status = current_payment_status('loan', $request->loan_id);

        $previous_payment_records = view('admin.loan-repay.prev_pay_record', compact('loan_information', 'member_information', 'transaction_info', 'due_and_payment_status'))->render();

        return response()->json(['loan_information' => $loan_information, 'due_and_payment_status' => $due_and_payment_status, 'previous_payment_records' => $previous_payment_records]);
    }
}
