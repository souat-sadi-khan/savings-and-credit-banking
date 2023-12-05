<?php

namespace App\Http\Controllers\Admin\Expense;

use App\ExpenseCategory as AppExpenseCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\employee\Employee;
use App\models\expense\Expense;
use Yajra\Datatables\Datatables;
use App\models\utility\ExpenseCategory;
use App\models\utility\Transaction;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $model = ExpenseCategory::all();

        return view('admin.expense.expense-list.index', compact('model'));
    }

    // ajax data table
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $model = Expense::all();
            return Datatables::of($model)
                ->addIndexColumn()
                ->editColumn('expense_categoty', function ($model) {
                    return $model->expense_category ? $model->expense_category->name : '';
                })
                ->editColumn('expense_for', function ($model) {
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
                    return carbonDate($model->expense_date);
                })
                ->addColumn('action', function ($model) {
                    return view('admin.expense.expense-list.action', compact('model'));
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
        $employees = Employee::all();
        $expense_categories = ExpenseCategory::where('status', 'Active')->get();
        return view('admin.expense.expense-list.create', compact('employees', 'expense_categories'));
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
            'expense_category_id' => 'required',
            'expense_amt' => 'required',
            'paid_amt' => 'required',
            'due_amt' => 'required',
            'expense_for' => 'required',
            'expense_date' => 'required',
        ]);

        $due = $request->expense_amt - $request->paid_amt;

        if ($due < 0) {
            throw  ValidationException::withMessages(['message' => "Be Careful! Payment Cannot Be Greater Than The Expense. "]);
        }

        if ($due == 0) {
            $payment_status = 'Paid';
        } else if ($due ==  $request->expense_amt) {
            $payment_status = "Due";
        } else {
            $payment_status = 'Partial';
        }

        $model = new Expense;

        $model->expense_category_id = $request->expense_category_id;
        $model->reference_no = $request->reference_no;
        $model->expense_note = $request->expense_note;
        $model->expense_amt = $request->expense_amt;
        $model->paid_amt = $request->paid_amt;
        $model->due_amt = $due;
        $model->expense_for = $request->expense_for;
        $model->expense_date = Carbon::createFromFormat('d/m/Y', $request->expense_date)->format('Y-m-d');
        $model->payment_status = $payment_status;
        // $model->expense_document = $request->status;
        $model->save();



        // generate new invoice no
        $uniqu_id = generate_id("invoice", true);
        $code_prefix = get_option('invoice_code_prefix');
        $code_digits = get_option('digits_invoice_code');
        $uniqu_id = numer_padding($uniqu_id, $code_digits);
        $new_invoice_no = $code_prefix . $uniqu_id;

        // now insert the expense to transaction table 
        $transaction = new Transaction;
        $transaction->tx_type = 'expense';
        $transaction->type = 'debit';
        $transaction->payment_status =  $payment_status;
        $transaction->invoice_no =   $new_invoice_no;
        $transaction->reference_no =  $request->reference_no;
        $transaction->tx_date =  Carbon::createFromFormat('d/m/Y', $request->expense_date)->format('Y-m-d');
        $transaction->grand_total_amt =  $request->paid_amt;
        $transaction->expense_category_id =  $request->expense_category_id;
        $transaction->expense_id =  $model->id;
        $transaction->expense_for =  $model->expense_for;
        $transaction->created_by =  auth()->user()->id;
        $transaction->save();

        activity()->log('Added Expense ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'load' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Expense::findOrFail($id);
        $employees = Employee::all();
        $expense_categories = ExpenseCategory::where('status', 'Active')->get();

        return view('admin.expense.expense-list.edit', compact('model', 'expense_categories', 'employees'));
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
            'expense_category_id' => 'required',
            'expense_amt' => 'required',
            'paid_amt' => 'required',
            'due_amt' => 'required',
            'expense_for' => 'required',
            'expense_date' => 'required',
        ]);

        $due = $request->expense_amt - $request->paid_amt;

        if ($due < 0) {
            throw  ValidationException::withMessages(['message' => "Be Careful! Payment Cannot Be Greater Than The Expense. "]);
        }

        if ($due == 0) {
            $payment_status = 'Paid';
        } else if ($due ==  $request->expense_amt) {
            $payment_status = "Due";
        } else {
            $payment_status = 'Partial';
        }

        $model = Expense::findOrFail($id);
        $model->expense_category_id = $request->expense_category_id;
        $model->reference_no = $request->reference_no;
        $model->expense_note = $request->expense_note;

        $model->expense_amt = $request->expense_amt;
        $model->paid_amt = $request->paid_amt;
        $model->due_amt = $due;
        $model->expense_for = $request->expense_for;
        $model->expense_date = Carbon::createFromFormat('d/m/Y', $request->expense_date)->format('Y-m-d');
        $model->payment_status = $payment_status;
        $model->save();


        // now update the expense to transaction table 
        $transaction = Transaction::where('expense_id', $model->id)->first();

        $transaction->payment_status =  $payment_status;
        $transaction->reference_no =  $request->reference_no;
        $transaction->tx_date =  Carbon::createFromFormat('d/m/Y', $request->expense_date)->format('Y-m-d');
        $transaction->grand_total_amt =  $request->paid_amt;
        $transaction->expense_category_id =  $request->expense_category_id;
        $transaction->expense_for =  $model->expense_for;
        $transaction->created_by =  auth()->user()->id;
        $transaction->save();


        activity()->log('Updated Expense ');
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
        $model = Expense::findOrFail($id);

        $model->delete();
        // Activity Log
        activity()->log('Deleted a Expense Type ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    }


    public function pay($id)
    {
        $model = Expense::findOrFail($id);
        return view('admin.expense.expense-list.pay', compact('model'));
    }

    public function submit_pay(Request $request, $id)
    {
        $request->validate([
            'new_pay' => 'required',
            'payment_date' => 'required',
        ]);

        $model = Expense::findOrFail($id);
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

        // now insert the Expemse to transaction table 
        $transaction = new Transaction;
        $transaction->tx_type = 'expense';
        $transaction->type = 'debit';
        $transaction->payment_status =  $payment_status;
        $transaction->invoice_no =   $new_invoice_no;
        $transaction->reference_no =  $request->reference_no;
        $transaction->tx_date =  Carbon::createFromFormat('d/m/Y', $request->payment_date)->format('Y-m-d');
        $transaction->grand_total_amt =  $request->new_pay;
        $transaction->expense_category_id =  $model->expense_category_id;
        $transaction->expense_id =  $model->id;
        $transaction->expense_for =  $model->expense_for;

        $transaction->created_by =  auth()->user()->id;
        $transaction->save();



        activity()->log('Updated Expense ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated'), 'load' => true]);
    }
}
