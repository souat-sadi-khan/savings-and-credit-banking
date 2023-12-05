<?php

namespace App\Http\Controllers\Admin\Service_Type;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\service_type\FdrType;
use Illuminate\Validation\Rule;

class FdrTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = FdrType::all();
        return view('admin.fdr-type.index', compact('model'));
    }

    // ajax data table
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $model = FdrType::all();
            return Datatables::of($model)
                ->addIndexColumn()
                ->editColumn('rate', function ($model) {
                    return $model->rate . ' %';
                })
                ->editColumn('duration', function ($model) {
                    return $model->duration . ' ' . $model->duration_type;
                })
                ->editColumn('status', function ($model) {
                    return $model->status == "Active" ? '<span class="badge badge-success">' . $model->status . '</span>' : '<span class="badge badge-danger">' . $model->status . '</span>';
                })
                ->addColumn('action', function ($model) {
                    return view('admin.fdr-type.action', compact('model'));
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
        return view('admin.fdr-type.create');
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
            'service_name' => 'required',
            'rate' => 'required|numeric',
            'duration' => 'required|numeric',
            'duration_type' => 'required',
            'status' => 'required',
        ]);


        $model = new FdrType;

        $model->service_name = $request->service_name;
        $model->rate = $request->rate;
        $model->duration = $request->duration;
        $model->duration_type = $request->duration_type;
        $model->status = $request->status;
        $model->save();

        activity()->log('Added Loan Type ');
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
        $model = FdrType::findOrFail($id);

        return view('admin.fdr-type.edit', compact('model'));
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
            'service_name' => 'required',
            'rate' => 'required|numeric',
            'duration' => 'required|numeric',
            'duration_type' => 'required',
            'status' => 'required',
        ]);
        $model = FdrType::findOrFail($id);
        $model->service_name = $request->service_name;
        $model->rate = $request->rate;
        $model->duration = $request->duration;
        $model->duration_type = $request->duration_type;
        $model->status = $request->status;
        $model->save();

        activity()->log('Updated Loan Type ');
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
        $model = FdrType::findOrFail($id);

        $model->delete();
        // Activity Log
        activity()->log('Deleted a Loan Type ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    }
}
