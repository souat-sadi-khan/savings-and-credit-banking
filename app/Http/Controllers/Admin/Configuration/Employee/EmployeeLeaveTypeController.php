<?php

namespace App\Http\Controllers\Admin\Configuration\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\employee\EmployeeLeaveType;

class EmployeeLeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        return view('admin.employee.leave.view');
    }
    public function index()
    {
       return view('admin.employee.leave-type.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $document = EmployeeLeaveType::where('name', '!=', config('system.default_role.admin'))->orderBy('id', 'desc')->get();
            return Datatables::of($document)
                ->addIndexColumn()
                ->editColumn('is_active',function($model){
                    return $model->is_active == 1?'Active':'Inactive';
                })
                ->addColumn('action', function ($model) {
                    return view('admin.employee.leave-type.action', compact('model'));
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
        return view('admin.employee.leave-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|unique:employee_document_types|max:255',
            'alias' => 'required|max:255',
            'description' => '',
            'is_active' => '',
        ]);

        $model = new EmployeeLeaveType;
        $model->name = $request->name;
        $model->alias = $request->alias;
        $model->is_active = $request->is_active;
        $model->description = $request->description;
        $model->save();
        // Activity Log
        activity()->log('Created a Employee Leave Type - ' . $request->name);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'goto' => route('admin.employee-leave-type.index')]);
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
        // find the data
        $model = EmployeeLeaveType::where('id', $id)->firstOrFail();
        // return
        return view('admin.employee.leave-type.edit', compact('model'));
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
        $model = EmployeeLeaveType::findOrFail($id);
        $model->name = $request->name;
         $model->alias = $request->alias;
        $model->is_active = $request->is_active;
        $model->description = $request->description;
        $model->save();

        // Activity Log
        activity()->log('Update a Employee Leave Type - ' . $request->name);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated'), 'goto' => route('admin.employee-leave-type.index')]);
    }
    

    /** 
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = EmployeeLeaveType::findOrFail($id);
        $name = $type->name;
        $type->delete();

        // Activity Log
        activity()->log('Delete a Employee Leave Type - ' . $name);

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted Successfully'), 'goto' => route('admin.employee-leave-type.index')]);
    }
}
