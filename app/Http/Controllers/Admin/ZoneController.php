<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Zone;
use App\models\ZoneArea;
use App\models\Area;
use Illuminate\Validation\Rule;
use Yajra\Datatables\Datatables;

class ZoneController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $zone_areas = ZoneArea::all();
        $area_id = [];

        foreach ( $zone_areas as $id) {
            $area_id[] = $id->area_id;
        }
        $model = Area::whereNotIn('id', $area_id)->get();

        return view('admin.zone.index',compact('model'));
    }

    // ajax data table
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $model = Zone::with('zone_areas')->get();
            return Datatables::of($model)
            ->addIndexColumn()
            ->editColumn('zone_areas', function($model){
                $html = "";
                foreach ($model->zone_areas as  $zone_areas) {
                    $html .= $zone_areas->area? '<span class="badge badge-success ml-1">'. $zone_areas->area->area .'</span>': '';
                }
                return $html;
            })
            ->addColumn('action', function ($model) {
                return view('admin.zone.action', compact('model'));
            })->rawColumns(['action','zone_areas'])->make(true);
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
            'zone' => 'required',
            'area' => 'required'
        ]);
        
        
        $model_zone = new Zone;

        $model_zone->Zone = $request->zone;
        $model_zone->save();

        // dd($request->all());
        foreach ($request->area as $area_id) {
           $model_zone_area = new ZoneArea;
           $model_zone_area->zone_id = $model_zone->id;
           $model_zone_area->area_id = $area_id;
           $model_zone_area->save();

        }

        activity() -> log('Added Zone ');
        return response() -> json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'load' => true]);
        
    }

    

    public function edit($id)
    {

        // dd($id);
        $zone_areas = ZoneArea::where('zone_id', '!=', $id)->get();
        $area_id = [];

        foreach ( $zone_areas as $ar) {
            $area_id[] = $ar->area_id;
        }
        $areas = Area::whereNotIn('id', $area_id)->get();
        // dd($areas);
        $model = Zone::with('zone_areas')->where('id',$id)->first();
    //    dd($model);
        return view('admin.zone.edit', compact('model','areas'));
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
            'zone' => 'required',
            'area' => 'required'
        ]);

        $model_zone = Zone::findOrFail($id);
        
        $model_zone->Zone = $request->zone;
        $model_zone->save();

        $model = ZoneArea::where('zone_id', $id)->delete();

        // dd($request->all());
        foreach ($request->area as $area_id) {
           $model_zone_area = new ZoneArea;
           $model_zone_area->zone_id = $id;
           $model_zone_area->area_id = $area_id;
           $model_zone_area->save();

        }
        
        activity() -> log('Updated Zone ');
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
         $model = Zone::findOrFail($id);
        
        $model->delete();
        // Activity Log
        activity() -> log('Deleted a Zone ');
        return response() -> json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    
    }
}
