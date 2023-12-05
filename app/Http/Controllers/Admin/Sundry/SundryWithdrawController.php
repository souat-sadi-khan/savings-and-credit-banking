<?php

namespace App\Http\Controllers\Admin\Sundry;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\sundry\SundryCalculation;
use App\models\utility\Transaction;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;


class SundryWithdrawController extends Controller
{


    public function index()
    {
        $date = Carbon::now();
        $sundry_month = $date->format('d-F-Y');

        $sundry_info = sundry_withdraw();
        return view('admin.sundry.sundry-withdraw.index', compact('sundry_month', 'sundry_info'));
    }



    public function store(Request $request)
    {
        $date = Carbon::now();
        $sundry_month = $date->format('F-Y');
        $sundry_type = $request->sundry_type;
        $account_id = $request->id;
        $account_no = $request->account_no;
        $member_id = $request->member_id;
        // dd($member_id);
        $calculated_amt = $request->calculated_amt;
        $submitted_amt = $request->submitted_amt;
        $tx_date = date('Y-m-d');

        $sundry_prev_info = SundryCalculation::where('month', $sundry_month)->get();

        $total_amt = 0;
        if ($sundry_type == 'SHARE') {

            for ($i = 0; $i < count($account_id); $i++) {
                if ($calculated_amt[$i] < $submitted_amt[$i]) {
                    throw  ValidationException::withMessages(['message' => 'Be Careful ! In A/C: ' . $account_no[$i] . ' Maximum Withdrawable Amt: ' . $calculated_amt[$i] . ' (Tk) But You Are Going To Withdraw: ' . $submitted_amt[$i] . ' (Tk)']);
                }
            }
            for ($i = 0; $i < count($account_id); $i++) {
                $model = new SundryCalculation;
                $model->share_id = $account_id[$i];
                $model->tx_type = 'withdraw';

                $model->calculated_amt = $calculated_amt[$i];
                $model->submitted_amt = $submitted_amt[$i];
                $model->withdraw_date = $tx_date;
                $model->save();
                $total_amt += $submitted_amt[$i];
            }
        } elseif ($sundry_type == 'SAVINGS') {

            for ($i = 0; $i < count($account_id); $i++) {
                if ($calculated_amt[$i] < $submitted_amt[$i]) {
                    throw  ValidationException::withMessages(['message' => 'Be Careful ! In A/C: ' . $account_no[$i] . ' Maximum Withdrawable Amt: ' . $calculated_amt[$i] . ' (Tk) But You Are Going To Withdraw: ' . $submitted_amt[$i] . ' (Tk)']);
                }
            }
            for ($i = 0; $i < count($account_id); $i++) {
                $model = new SundryCalculation;
                $model->savings_id = $account_id[$i];
                $model->tx_type = 'withdraw';

                $model->calculated_amt = $calculated_amt[$i];
                $model->submitted_amt = $submitted_amt[$i];
                $model->withdraw_date = $tx_date;
                $model->save();
                $total_amt += $submitted_amt[$i];
            }
        } elseif ($sundry_type == 'DPS') {

            for ($i = 0; $i < count($account_id); $i++) {
                if ($calculated_amt[$i] < $submitted_amt[$i]) {
                    throw  ValidationException::withMessages(['message' => 'Be Careful ! In A/C: ' . $account_no[$i] . ' Maximum Withdrawable Amt: ' . $calculated_amt[$i] . ' (Tk) But You Are Going To Withdraw: ' . $submitted_amt[$i] . ' (Tk)']);
                }
            }
            for ($i = 0; $i < count($account_id); $i++) {
                $model = new SundryCalculation;
                $model->dps_id = $account_id[$i];
                $model->tx_type = 'withdraw';

                $model->calculated_amt = $calculated_amt[$i];
                $model->submitted_amt = $submitted_amt[$i];
                $model->withdraw_date = $tx_date;
                $model->save();
                $total_amt += $submitted_amt[$i];
            }
        } elseif ($sundry_type == 'DOUBLE BENEFIT') {

            for ($i = 0; $i < count($account_id); $i++) {
                if ($calculated_amt[$i] < $submitted_amt[$i]) {
                    throw  ValidationException::withMessages(['message' => 'Be Careful ! In A/C: ' . $account_no[$i] . ' Maximum Withdrawable Amt: ' . $calculated_amt[$i] . ' (Tk) But You Are Going To Withdraw: ' . $submitted_amt[$i] . ' (Tk).']);
                }
            }
            for ($i = 0; $i < count($account_id); $i++) {
                $model = new SundryCalculation;
                $model->double_benifit_id = $account_id[$i];
                $model->tx_type = 'withdraw';

                $model->calculated_amt = $calculated_amt[$i];
                $model->submitted_amt = $submitted_amt[$i];
                $model->withdraw_date = $tx_date;
                $model->save();
                $total_amt += $submitted_amt[$i];
            }
        } elseif ($sundry_type == 'LOAN FROM MEMBER') {


            for ($i = 0; $i < count($account_id); $i++) {
                if ($calculated_amt[$i] < $submitted_amt[$i]) {
                    throw  ValidationException::withMessages(['message' => 'Be Careful ! In A/C: ' . $account_no[$i] . ' Maximum Withdrawable Amt: ' . $calculated_amt[$i] . ' (Tk) But You Are Going To Withdraw: ' . $submitted_amt[$i] . ' (Tk).']);
                }
            }
            for ($i = 0; $i < count($account_id); $i++) {
                $model = new SundryCalculation;
                $model->fdr_id = $account_id[$i];
                $model->tx_type = 'withdraw';

                $model->calculated_amt = $calculated_amt[$i];
                $model->submitted_amt = $submitted_amt[$i];
                $model->withdraw_date = $tx_date;
                $model->save();
                $total_amt += $submitted_amt[$i];
            }
        }

        // now save the amount to transaction table 

        //generate new invoice no
        $uniqu_id = generate_id("invoice", true);
        $code_prefix = get_option('invoice_code_prefix');
        $code_digits = get_option('digits_invoice_code');
        $uniqu_id = numer_padding($uniqu_id, $code_digits);
        $new_invoice_no = $code_prefix . $uniqu_id;

        $tx_model = new Transaction;

        // $tx_model->sundry_id = $model->id;
        $tx_model->tx_type = 'sundry payment';
        $tx_model->type = 'credit';
        $tx_model->payment_status = 'paid';
        $tx_model->invoice_no = $new_invoice_no;
        $tx_model->tx_date = $tx_date;

        $tx_model->grand_total_amt = $total_amt;
        $tx_model->created_by = auth()->user()->id;
        $tx_model->save();

        activity()->log('Sundry Is Saved');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'load' => true]);
    }




    public function show($sundry_type)
    {

        $date = Carbon::now();
        $sundry_month = $date->format('d-F-Y');

        if ($sundry_type == 'SHARE') {

            $sundry_info = sundry_withdraw('share');
            return view('admin.sundry.sundry-withdraw.share', compact('sundry_month', 'sundry_info', 'sundry_type'));
        } elseif ($sundry_type == 'SAVINGS') {
            $sundry_info = sundry_withdraw('savings');
            return view('admin.sundry.sundry-withdraw.savings', compact('sundry_month', 'sundry_info', 'sundry_type'));
        } elseif ($sundry_type == 'DPS') {

            $sundry_info = sundry_withdraw('dps');
            // dd($sundry_info);
            return view('admin.sundry.sundry-withdraw.dps', compact('sundry_month', 'sundry_info', 'sundry_type'));
        } elseif ($sundry_type == 'DOUBLE BENEFIT') {

            $sundry_info = sundry_withdraw('double_benifit');
            return view('admin.sundry.sundry-withdraw.double_benifit', compact('sundry_month', 'sundry_info', 'sundry_type'));
        } elseif ($sundry_type == 'LOAN FROM MEMBER') {

            $sundry_info = sundry_withdraw('loan_from_member');
            return view('admin.sundry.sundry-withdraw.loan_from_member', compact('sundry_month', 'sundry_info', 'sundry_type'));
            // dd($sundry_type);
        }
    }
}
