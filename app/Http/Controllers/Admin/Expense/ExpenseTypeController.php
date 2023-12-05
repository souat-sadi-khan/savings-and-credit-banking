<?php

namespace App\Http\Controllers\Admin\Expense;

use App\ExpenseCategory as AppExpenseCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\utility\ExpenseCategory;
use Illuminate\Validation\Rule;

class ExpenseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $model = ExpenseCategory::all();
        return view('admin.expense.expense-type.index', compact('model'));
    }

    // ajax data table
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $model = ExpenseCategory::all();
            return Datatables::of($model)
                ->addIndexColumn()

                ->editColumn('status', function ($model) {
                    return $model->status == "Active" ? '<span class="badge badge-success">' . $model->status . '</span>' : '<span class="badge badge-danger">' . $model->status . '</span>';
                })
                ->addColumn('action', function ($model) {
                    return view('admin.expense.expense-type.action', compact('model'));
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
        return view('admin.expense.expense-type.create');
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
            'name' => 'required',
            'code' => 'required',
            'status' => 'required',
        ]);

        // dd($request->description);

        $model = new ExpenseCategory;

        $model->name = $request->name;
        $model->asset = 'Yes';
        $model->code = $request->code;
        $model->description = $request->description;
        $model->status = $request->status;
        $model->save();

        activity()->log('Added Expense Type ');
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
        $model = ExpenseCategory::findOrFail($id);

        return view('admin.expense.expense-type.edit', compact('model'));
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
            'name' => 'required',
            'code' => 'required',
            'status' => 'required',
        ]);
        $model = ExpenseCategory::findOrFail($id);
        $model->name = $request->name;
        $model->code = $request->code;
        $model->description = $request->description;
        $model->status = $request->status;
        $model->save();

        activity()->log('Updated Expense Type ');
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
        $model = ExpenseCategory::findOrFail($id);

        $model->delete();
        // Activity Log
        activity()->log('Deleted a Expense Type ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    }
}
