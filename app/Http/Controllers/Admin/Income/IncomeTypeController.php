<?php

namespace App\Http\Controllers\Admin\Income;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\utility\IncomeCategory;

class IncomeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = IncomeCategory::all();
        return view('admin.income.income-type.index', compact('model'));
    }

    // ajax data table
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $model = IncomeCategory::all();
            return Datatables::of($model)
                ->addIndexColumn()

                ->editColumn('status', function ($model) {
                    return $model->status == "Active" ? '<span class="badge badge-success">' . $model->status . '</span>' : '<span class="badge badge-danger">' . $model->status . '</span>';
                })
                ->addColumn('action', function ($model) {
                    return view('admin.income.income-type.action', compact('model'));
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
        return view('admin.income.income-type.create');
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

        $model = new IncomeCategory;

        $model->name = $request->name;
        $model->code = $request->code;
        $model->description = $request->description;
        $model->status = $request->status;
        $model->save();

        activity()->log('Added income Type ');
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
        $model = IncomeCategory::findOrFail($id);

        return view('admin.income.income-type.edit', compact('model'));
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
        $model = IncomeCategory::findOrFail($id);
        $model->name = $request->name;
        $model->code = $request->code;
        $model->description = $request->description;
        $model->status = $request->status;
        $model->save();

        activity()->log('Updated income Type ');
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
        $model = IncomeCategory::findOrFail($id);

        $model->delete();
        // Activity Log
        activity()->log('Deleted a income Type ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    }
}
