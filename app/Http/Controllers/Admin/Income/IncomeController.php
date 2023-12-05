<?php

namespace App\Http\Controllers\Admin\Income;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\employee\Employee;
use App\models\income\Income;
use Yajra\Datatables\Datatables;
use App\models\utility\IncomeCategory;
use App\models\utility\Transaction;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Psy\Readline\Transient;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = IncomeCategory::all();

        return view('admin.income.income-list.index', compact('model'));
    }

    // ajax data table
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $model = Income::all();
            return Datatables::of($model)
                ->addIndexColumn()
                ->editColumn('income_categoty', function ($model) {
                    return $model->income_category ? $model->income_category->name : '';
                })
                ->editColumn('income_for', function ($model) {
                    return $model->exp_for ? $model->exp_for->name : '';
                })
                ->editColumn('status', function ($model) {
                    if ($model->payment_status == 'Due') {
                        return '<span class="badge badge-danger">' . $model->payment_status . '</span>';
                    } else if ($model->payment_status == 'Partial') {
                        return '<span class="badge badge-warning">' . $model->payment_status . '</span>';
                    } else {
                        return '<span class="badge badge-success">' . $model->payment_status . '</span>';
                    }
                })
                ->editColumn('date', function ($model) {
                    return carbonDate($model->income_date);
                })
                ->addColumn('action', function ($model) {
                    return view('admin.income.income-list.action', compact('model'));
                })->rawColumns(['action', 'status'])->make(true);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('Fahmida');

        $employees = Employee::all();
        $income_categories = IncomeCategory::where('status', 'Active')->get();
        return view('admin.income.income-list.create', compact('employees', 'income_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'income_category_id' => 'required',
            'income_amt' => 'required',
            'paid_amt' => 'required',
            'due_amt' => 'required',
            'income_date' => 'required',
        ]);

        $due = $request->income_amt - $request->paid_amt;

        if ($due < 0) {
            throw  ValidationException::withMessages(['message' => "Be Careful! Payment Cannot Be Greater Than The income. "]);
        }

        if ($due == 0) {
            $payment_status = 'Paid';
        } else if ($due ==  $request->income_amt) {
            $payment_status = "Due";
        } else {
            $payment_status = 'Partial';
        }

        $model = new Income;

        $model->income_category_id = $request->income_category_id;
        $model->reference_no = $request->reference_no;
        $model->income_note = $request->income_note;
        $model->income_amt = $request->income_amt;
        $model->paid_amt = $request->paid_amt;
        $model->due_amt = $due;
        $model->income_date = Carbon::createFromFormat('d/m/Y', $request->income_date)->format('Y-m-d');
        $model->payment_status = $payment_status;
        // $model->income_document = $request->status;
        $model->save();



        // generate new invoice no
        $uniqu_id = generate_id("invoice", true);
        $code_prefix = get_option('invoice_code_prefix');
        $code_digits = get_option('digits_invoice_code');
        $uniqu_id = numer_padding($uniqu_id, $code_digits);
        $new_invoice_no = $code_prefix . $uniqu_id;

        // now insert the Income to transaction table 
        $transaction = new Transaction;
        $transaction->tx_type = 'income';
        $transaction->type = 'credit';
        $transaction->payment_status =  $payment_status;
        $transaction->invoice_no =   $new_invoice_no;
        $transaction->reference_no =  $request->reference_no;
        $transaction->tx_date =  Carbon::createFromFormat('d/m/Y', $request->income_date)->format('Y-m-d');
        $transaction->grand_total_amt =  $request->paid_amt;
        $transaction->income_category_id =  $request->income_category_id;
        $transaction->income_id =  $model->id;

        $transaction->created_by =  auth()->user()->id;
        $transaction->save();

        activity()->log('Added Income ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'load' => true]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Income::findOrFail($id);
        $employees = Employee::all();
        $income_categories = IncomeCategory::where('status', 'Active')->get();

        return view('admin.income.income-list.edit', compact('model', 'income_categories', 'employees'));
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
        $request->validate([
            'income_category_id' => 'required',
            'income_amt' => 'required',
            'paid_amt' => 'required',
            'due_amt' => 'required',
            'income_date' => 'required',
        ]);

        $due = $request->income_amt - $request->paid_amt;

        if ($due < 0) {
            throw  ValidationException::withMessages(['message' => "Be Careful! Payment Cannot Be Greater Than The income. "]);
        }

        if ($due == 0) {
            $payment_status = 'Paid';
        } else if ($due ==  $request->income_amt) {
            $payment_status = "Due";
        } else {
            $payment_status = 'Partial';
        }

        $model = Income::findOrFail($id);
        $model->income_category_id = $request->income_category_id;
        $model->reference_no = $request->reference_no;
        $model->income_note = $request->income_note;

        $model->income_amt = $request->income_amt;
        $model->paid_amt = $request->paid_amt;
        $model->due_amt = $due;
        $model->income_date = Carbon::createFromFormat('d/m/Y', $request->income_date)->format('Y-m-d');
        $model->payment_status = $payment_status;
        $model->save();


        // now update the Income to transaction table 
        $transaction = Transaction::where('income_id', $model->id)->first();

        $transaction->payment_status =  $payment_status;
        $transaction->reference_no =  $request->reference_no;
        $transaction->tx_date =  Carbon::createFromFormat('d/m/Y', $request->income_date)->format('Y-m-d');
        $transaction->grand_total_amt =  $request->paid_amt;
        $transaction->income_category_id =  $request->income_category_id;
        $transaction->created_by =  auth()->user()->id;
        $transaction->save();


        activity()->log('Updated Income ');
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
        $model = Income::findOrFail($id);

        $model->delete();
        // Activity Log
        activity()->log('Deleted a Income Type ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    }

    public function pay($id)
    {
        $model = Income::findOrFail($id);
        return view('admin.income.income-list.pay', compact('model'));
    }

    public function submit_pay(Request $request, $id)
    {
        $request->validate([
            'new_pay' => 'required',
            'payment_date' => 'required',
        ]);

        $model = Income::findOrFail($id);
        $transaction  =  new Transaction;

        $current_due = $model->due_amt;
        $current_total_paid = $model->paid_amt;

        $new_pay = $request->new_pay;
        $new_due = $current_due - $new_pay;
        $new_paid_amt = $current_total_paid + $new_pay;

        if ($new_due < 0) {
            throw  ValidationException::withMessages(['message' => "Be Careful! Payment Cannot Be Greater Than The Due. "]);
        }


        if ($new_due == 0) {
            $payment_status = 'Paid';
        } else if ($new_due ==  $model->income_amt) {
            $payment_status = "Due";
        } else {
            $payment_status = 'Partial';
        }

        $model->paid_amt = $new_paid_amt;
        $model->due_amt = $new_due;
        $model->payment_status = $payment_status;
        $model->save();


        // generate new invoice no
        $uniqu_id = generate_id("invoice", true);
        $code_prefix = get_option('invoice_code_prefix');
        $code_digits = get_option('digits_invoice_code');
        $uniqu_id = numer_padding($uniqu_id, $code_digits);
        $new_invoice_no = $code_prefix . $uniqu_id;

        // now insert the Income to transaction table 
        $transaction = new Transaction;
        $transaction->tx_type = 'income';
        $transaction->type = 'credit';
        $transaction->payment_status =  $payment_status;
        $transaction->invoice_no =   $new_invoice_no;
        $transaction->reference_no =  $request->reference_no;
        $transaction->tx_date =  Carbon::createFromFormat('d/m/Y', $request->payment_date)->format('Y-m-d');
        $transaction->grand_total_amt =  $request->new_pay;
        $transaction->income_category_id =  $model->income_category_id;
        $transaction->income_id =  $model->id;

        $transaction->created_by =  auth()->user()->id;
        $transaction->save();



        activity()->log('Updated Income ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated'), 'load' => true]);
    }
}
