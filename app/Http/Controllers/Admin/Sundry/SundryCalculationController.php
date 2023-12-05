<?php

namespace App\Http\Controllers\Admin\Sundry;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\accounts\DoubleBenifitAccount;
use App\models\accounts\FdrAccount;
use App\models\sundry\Sundry;
use App\models\sundry\SundryCalculation;
use App\models\sundry\SundryInfo;
use App\models\sundry\SundryMemberInfo;
use App\models\utility\Transaction;
use Carbon\Carbon;
use Psy\Readline\Transient;
use Illuminate\Validation\ValidationException;

class SundryCalculationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::now();
        $sundry_month = $date->startOfMonth()->subMonth()->format('F-Y');

        $sundry_info = sundry_calculation();
        return view('admin.sundry.sundry-calculation.index', compact('sundry_month', 'sundry_info'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = Carbon::now();
        $sundry_month = $date->startOfMonth()->subMonth()->format('F-Y');
        $sundry_type = $request->sundry_type;
        $account_id = $request->id;
        $member_id = $request->member_id;
        // dd($member_id);
        $calculated_amt = $request->calculated_amt;
        $submitted_amt = $request->submitted_amt;
        $tx_date = date('Y-m-d');

        $sundry_prev_info = SundryCalculation::where('month', $sundry_month)->get();

        $total_amt = 0;
        if ($sundry_type == 'SHARE') {
            foreach ($sundry_prev_info as $value) {
                if ($value->share_id != null) {
                    throw  ValidationException::withMessages(['message' => 'Sundry Calculation of share for Month: ' . $sundry_month . ' has already been performed. It cannot be calculated any more.']);
                }
            }
            for ($i = 0; $i < count($account_id); $i++) {
                $model = new SundryCalculation;
                $model->share_id = $account_id[$i];
                $model->member_id = $account_id[$i];
                $model->tx_type = 'deposit';
                $model->month = $sundry_month;
                $model->calculated_amt = $calculated_amt[$i];
                $model->submitted_amt = $submitted_amt[$i];
                $model->deposit_date = $tx_date;
                $model->save();
                $total_amt += $submitted_amt[$i];
            }
        } elseif ($sundry_type == 'SAVINGS') {
            foreach ($sundry_prev_info as $value) {
                if ($value->savings_id != null) {
                    throw  ValidationException::withMessages(['message' => 'Sundry Calculation of Savings for Month: ' . $sundry_month . ' has already been performed. It cannot be calculated any more.']);
                }
            }
            for ($i = 0; $i < count($account_id); $i++) {
                $model = new SundryCalculation;
                $model->savings_id = $account_id[$i];
                $model->member_id = $member_id[$i];
                $model->tx_type = 'deposit';
                $model->month = $sundry_month;
                $model->calculated_amt = $calculated_amt[$i];
                $model->submitted_amt = $submitted_amt[$i];
                $model->deposit_date = $tx_date;
                $model->save();
                $total_amt += $submitted_amt[$i];
            }
        } elseif ($sundry_type == 'DPS') {
            foreach ($sundry_prev_info as $value) {
                if ($value->dps_id != null) {
                    throw  ValidationException::withMessages(['message' => 'Sundry Calculation of DPS for Month: ' . $sundry_month . ' has already been performed. It cannot be calculated any more.']);
                }
            }
            for ($i = 0; $i < count($account_id); $i++) {
                $model = new SundryCalculation;
                $model->dps_id = $account_id[$i];
                $model->member_id = $member_id[$i];
                $model->tx_type = 'deposit';
                $model->month = $sundry_month;
                $model->calculated_amt = $calculated_amt[$i];
                $model->submitted_amt = $submitted_amt[$i];
                $model->deposit_date = $tx_date;
                $model->save();
                $total_amt += $submitted_amt[$i];
            }
        } elseif ($sundry_type == 'DOUBLE BENEFIT') {
            foreach ($sundry_prev_info as $value) {
                if ($value->double_benifit_id != null) {
                    throw  ValidationException::withMessages(['message' => 'Sundry Calculation of Double Benefit for Month: ' . $sundry_month . ' has already been performed. It cannot be calculated any more.']);
                }
            }
            for ($i = 0; $i < count($account_id); $i++) {
                $model = new SundryCalculation;
                $model->double_benifit_id = $account_id[$i];
                $model->member_id = $member_id[$i];
                $model->tx_type = 'deposit';
                $model->month = $sundry_month;
                $model->calculated_amt = $calculated_amt[$i];
                $model->submitted_amt = $submitted_amt[$i];
                $model->deposit_date = $tx_date;
                $model->save();
                $total_amt += $submitted_amt[$i];
            }
        } elseif ($sundry_type == 'LOAN FROM MEMBER') {
            foreach ($sundry_prev_info as $value) {
                if ($value->fdr_id != null) {
                    throw  ValidationException::withMessages(['message' => 'Sundry Calculation of Loan from member for Month: ' . $sundry_month . ' has already been performed. It cannot be calculated any more.']);
                }
            }
            for ($i = 0; $i < count($account_id); $i++) {
                $model = new SundryCalculation;
                $model->fdr_id = $account_id[$i];
                $model->tx_type = 'deposit';
                $model->month = $sundry_month;
                $model->calculated_amt = $calculated_amt[$i];
                $model->submitted_amt = $submitted_amt[$i];
                $model->deposit_date = $tx_date;
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
        $tx_model->tx_type = 'sundry repay';
        $tx_model->type = 'debit';
        $tx_model->payment_status = 'paid';
        $tx_model->invoice_no = $new_invoice_no;
        $tx_model->tx_date = $tx_date;

        $tx_model->grand_total_amt = $total_amt;
        $tx_model->created_by = auth()->user()->id;
        $tx_model->save();

        activity()->log('Sundry Is Saved');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'load' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sundry_type)
    {

        $date = Carbon::now();
        $sundry_month = $date->startOfMonth()->subMonth()->format('F-Y');

        if ($sundry_type == 'SHARE') {

            $sundry_info = sundry_calculation('share');
            return view('admin.sundry.sundry-calculation.share', compact('sundry_month', 'sundry_info', 'sundry_type'));
        } elseif ($sundry_type == 'SAVINGS') {
            $sundry_info = sundry_calculation('savings');
            return view('admin.sundry.sundry-calculation.savings', compact('sundry_month', 'sundry_info', 'sundry_type'));
        } elseif ($sundry_type == 'DPS') {

            $sundry_info = sundry_calculation('dps');
            return view('admin.sundry.sundry-calculation.dps', compact('sundry_month', 'sundry_info', 'sundry_type'));
        } elseif ($sundry_type == 'DOUBLE BENEFIT') {

            $sundry_info = sundry_calculation('double_benifit');
            return view('admin.sundry.sundry-calculation.double_benifit', compact('sundry_month', 'sundry_info', 'sundry_type'));
        } elseif ($sundry_type == 'LOAN FROM MEMBER') {

            $sundry_info = sundry_calculation('loan_from_member');
            return view('admin.sundry.sundry-calculation.loan_from_member', compact('sundry_month', 'sundry_info', 'sundry_type'));
            // dd($sundry_type);
        }
    }
}
