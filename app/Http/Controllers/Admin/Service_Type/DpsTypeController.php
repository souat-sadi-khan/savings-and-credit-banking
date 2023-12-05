<?php

namespace App\Http\Controllers\Admin\Service_Type;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\service_type\DpsType;
use Illuminate\Validation\Rule;

class DpsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = DpsType::all();
        return view('admin.dps-type.index', compact('model'));
    }

    // ajax data table
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $model = DpsType::all();
            return Datatables::of($model)
                ->addIndexColumn()
                ->editColumn('rate', function ($model) {
                    return $model->rate . ' %';
                })
                ->editColumn('duration', function ($model) {
                    return $model->duration . ' ' . $model->duration_type;
                })
                ->editColumn('installment_period', function ($model) {
                    return $model->installment_period . ' ' . $model->installment_period_type;
                })
                ->editColumn('status', function ($model) {
                    return $model->status == "Active" ? '<span class="badge badge-success">' . $model->status . '</span>' : '<span class="badge badge-danger">' . $model->status . '</span>';
                })
                ->addColumn('action', function ($model) {
                    return view('admin.dps-type.action', compact('model'));
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
        return view('admin.dps-type.create');
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
            'installment_period' => 'required',
            'installment_period_type' => 'required',
            'status' => 'required',
        ]);


        $model = new DpsType;

        $model->service_name = $request->service_name;
        $model->rate = $request->rate;
        $model->duration = $request->duration;
        $model->duration_type = $request->duration_type;
        $model->installment_period = $request->installment_period;
        $model->installment_period_type = $request->installment_period_type;
        $model->status = $request->status;
        $model->save();

        activity()->log('Added DPS Type ');
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
        $model = DpsType::findOrFail($id);

        return view('admin.dps-type.edit', compact('model'));
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
            'installment_period' => 'required',
            'installment_period_type' => 'required',
            'status' => 'required',
        ]);
        $model = DpsType::findOrFail($id);

        $model->service_name = $request->service_name;
        $model->rate = $request->rate;
        $model->duration = $request->duration;
        $model->duration_type = $request->duration_type;
        $model->installment_period = $request->installment_period;
        $model->installment_period_type = $request->installment_period_type;
        $model->status = $request->status;

        $model->save();

        activity()->log('Updated DPS Type ');
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
        $model = DpsType::findOrFail($id);

        $model->delete();
        // Activity Log
        activity()->log('Deleted a Loan Type ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    }
}
