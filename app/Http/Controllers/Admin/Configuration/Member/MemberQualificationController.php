<?php

namespace App\Http\Controllers\Admin\Configuration\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Member\Member;
use App\models\Member\MemberQualification;

class MemberQualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->model_id;
        $models = MemberQualification::where('member_id', $id)->get();
        return view('admin.member.list.ajax.qualification_info', compact('models', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // find the member ID
        $member_id = request()->id;
        $model = new MemberQualification;
        return view('admin.member.list.qualification-history.create', compact('member_id', 'model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member_id = $request->member_id;
        $model =  Member::findOrFail($member_id);
        $exam_name = count($request->exam_name);
        
        $request->validate([
            'exam_name' => 'required',
            'institute_name' => 'required',
            'board' => 'required',
            'year' => 'required',
            'result' => 'required',
            ]);
            for ($i=0; $i < $exam_name ; $i++) {
                $data = new MemberQualification;
                $data['exam_name'] = $request->exam_name[$i];
                $data['institute_name'] = $request->institute_name[$i];
                $data['board'] = $request->board[$i];
                $data['year'] = $request->year[$i];
                $data['result'] = $request->result[$i];
                $data['member_id'] = $member_id;
                $data->save();
        }

        // Activity Log
        activity()->log('Created Member Qualification Info  - ' . $model->name_in_bangla);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'goto' => route('admin.member-list.edit', $model->uuid)]);
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
        $model = MemberQualification::findOrFail($id);
        return view('admin.member.list.qualification-history.edit', compact('model'));
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
            'exam_name' => 'required',
            'institute_name' => 'required',
            'board' => 'required',
            'year' => 'required',
            'result' => 'required',
        ]);
            $data = MemberQualification::findOrFail($id);
            $data['exam_name'] = $request->exam_name;
            $data['institute_name'] = $request->institute_name;
            $data['board'] = $request->board;
            $data['year'] = $request->year;
            $data['result'] = $request->result;
            $data->save();

        // Activity Log
        activity()->log('Updated a Member Qualification Information ');
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
        // find the model & delete
        $model = MemberQualification::findOrFail($id);
        $model->delete();

        // make activity log & return
        activity()->log('Deleted a Member Qualification Information ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    }
}
