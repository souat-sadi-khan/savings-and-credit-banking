<?php

namespace App\Http\Controllers\Admin\Service_Type;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\service_type\ShareType;
use Illuminate\Validation\Rule;

class ShareTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = ShareType::all();
        return view('admin.share-type.index', compact('model'));
    }

    // ajax data table
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $model = ShareType::all();
            return Datatables::of($model)
                ->addIndexColumn()
                ->editColumn('rate', function ($model) {
                    return $model->rate . ' %';
                })

                ->editColumn('status', function ($model) {
                    return $model->status == "Active" ? '<span class="badge badge-success">' . $model->status . '</span>' : '<span class="badge badge-danger">' . $model->status . '</span>';
                })

                ->addColumn('action', function ($model) {
                    return view('admin.share-type.action', compact('model'));
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
        return view('admin.share-type.create');
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
            'interest_period' => 'required',
            'status' => 'required',
        ]);


        $model = new ShareType;

        $model->service_name = $request->service_name;
        $model->rate = $request->rate;
        $model->interest_period = $request->interest_period;
        $model->status = $request->status;
        $model->save();

        activity()->log('Added Share Type ');
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
        $model = ShareType::findOrFail($id);

        return view('admin.share-type.edit', compact('model'));
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
            'interest_period' => 'required',
            'status' => 'required',
        ]);

        $model = ShareType::findOrFail($id);
        $model->service_name = $request->service_name;
        $model->rate = $request->rate;
        $model->interest_period = $request->interest_period;
        $model->status = $request->status;
        $model->save();

        activity()->log('Updated Share Type ');
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
        $model = ShareType::findOrFail($id);

        $model->delete();
        // Activity Log
        activity()->log('Deleted a Share Type ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    }
}
