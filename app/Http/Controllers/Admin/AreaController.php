<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Area;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Datatables;

class AreaController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = Area::all();
        return view('admin.area.index',compact('model'));
    }

    // ajax data table
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $model = Area::all();
            return Datatables::of($model)
            ->addIndexColumn()
             
            ->addColumn('action', function ($model) {
                return view('admin.area.action', compact('model'));
            })->rawColumns(['action'])->make(true);
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'area' => 'required',
            'district' => 'required',
            'thana' => 'required',
        ]);
        
        
        $model = new Area;
        $model->area = $request->area;
        $model->district = $request->district;
        $model->thana = $request->thana;
        $model->save();

        activity() -> log('Added Area ');
        return response() -> json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'load' => true]);
        
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
        $model = Area::findOrFail($id);
       
        return view('admin.area.edit', compact('model'));
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
            'area' => 'required',
            'district' => 'required',
            'thana' => 'required',
        ]);

        $model = Area::findOrFail($id);
        $model->area = $request->area;
        $model->district = $request->district;
        $model->thana = $request->thana;
        $model->save();
        
        activity() -> log('Updated Area ');
        return response() -> json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated'), 'load' => true]);

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
         $model = Area::findOrFail($id);
        
        $model->delete();
        // Activity Log
        activity() -> log('Deleted a Area ');
        return response() -> json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    
    }
}
