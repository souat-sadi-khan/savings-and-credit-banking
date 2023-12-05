<?php

namespace App\Http\Controllers\Admin\Configuration\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Member\Nationality;
use App\models\Member\Occupation;
use App\models\Member\Religious;
use App\models\Member\Member;
use App\models\service_type\ShareType;
use App\models\utility\Transaction;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.member.list.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $documents = Member::query();
            return Datatables::of($documents)
                ->addIndexColumn()
                ->editColumn('code', function ($document) {
                    return $document->prefix . numer_padding($document->code, get_option('digits_member_code'));
                })
                ->addColumn('action', function ($model) {
                    return view('admin.member.list.action', compact('model'));
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

        $nationality = Nationality::all();
        $occupation = Occupation::all();
        $religious = Religious::all();
        // $share_types = ShareType::all();
        $code_prefix = get_option('member_code_prefix');
        $code_digits = get_option('digits_member_code');
        $uniqu_id = generate_id('member', false);
        $uniqu_id = numer_padding($uniqu_id, $code_digits);

        // generate or update id for share account of the member 
        $code_prefix_share = get_option('share_code_prefix');
        $code_digits_share = get_option('digits_share_code');
        $uniqu_id_share = generate_id('share', false);
        $uniqu_id_share = numer_padding($uniqu_id_share, $code_digits_share);

        // retrurn the member create page
        return view('admin.member.list.create', compact("nationality", "occupation", "religious", "code_prefix", "uniqu_id", 'code_prefix_share', 'uniqu_id_share'));
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
            'prefix' => 'required',
            'code' => 'required',
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'contact_number' => 'required|numeric',
            'gender' => 'required',
            'date_of_birth' => 'required',
            // 'share_type' => 'required',
            'share_amount' => 'required',
            'payment_method' => 'required',
        ]);
        $uuid =  Str::uuid()->toString();

        if ($request->hasFile('photo')) {
            $storagepath = $request->file('photo')->store('public/member');
            $photo = basename($storagepath);
        } else {
            $photo = '';
        }

        if ($request->hasFile('signature')) {
            $storagepath = $request->file('signature')->store('public/member');
            $signature = basename($storagepath);
        } else {
            $signature = '';
        }

        // now get share information for inserting data into database   

        // $get_share_type = ShareType::findOrFail($request->share_type);
        // $share_rate = $get_share_type->rate;
        // $interest_intervel = $get_share_type->interest_period;
        // $share_type_id = $get_share_type->id;

        $model = new Member;
        $model->uuid = $uuid;
        $model->code = $request->code;
        $model->prefix = $request->prefix;
        $model->name_in_bangla = $request->name;
        $model->date_of_birth = $request->date_of_birth;
        $model->gender = $request->gender;
        $model->contact_number = $request->contact_number;
        $model->father_name = $request->father_name;
        $model->mother_name = $request->mother_name;
        $model->nationality_id = $request->nationality;
        $model->religious_id = $request->religious;
        $model->occupation_id = $request->occupation;
        $model->referrer_id = $request->referrer_id;
        $model->photo = $photo;
        $model->signature = $signature;

        $model->present_address_line_1      =   $request->present_address_line_1;
        $model->present_address_line_2      =   $request->present_address_line_2;
        $model->present_city                =   $request->present_city;
        $model->present_state               =   $request->present_state;
        $model->present_zipcode             =   $request->present_zipcode;
        $model->present_country             =   $request->present_country;
        $model->same_as_present_address     =   $request->same_as_present_address;
        $model->permanent_address_line_1    =   $request->permanent_address_line_1;
        $model->permanent_address_line_2    =   $request->permanent_address_line_2;
        $model->permanent_state             =   $request->permanent_state;
        $model->permanent_city              =   $request->permanent_state;
        $model->permanent_zipcode           =   $request->permanent_zipcode;
        $model->permanent_country           =   $request->permanent_country;
        $model->prefix_share                =   $request->prefix_share;
        $model->code_share                  =   $request->code_share;
        // $model->share_type_id               =   $share_type_id;
        // $model->share_rate                  =   $share_rate;
        // $model->interest_intervel           =   $interest_intervel;
        $model->save();

        generate_id("member", true);
        generate_id("share", true);


        // :::::::::::  add share information to transaction table ::::::::::::::: 
        $dtobj = Carbon::createFromFormat('d/m/Y', $request->tx_date);
        $tx_date = $dtobj->format('Y-m-d');

        if ($request->payment_method == 'Bank Check') {
            $dtobj = Carbon::createFromFormat('d/m/Y', $request->check_active_date);
            $tx_date = $dtobj->format('Y-m-d');
        }

        // generate new invoice no
        $uniqu_id = generate_id("invoice", true);
        $code_prefix = get_option('invoice_code_prefix');
        $code_digits = get_option('digits_invoice_code');
        $uniqu_id = numer_padding($uniqu_id, $code_digits);
        $new_invoice_no = $code_prefix . $uniqu_id;

        $transaciton = new Transaction;

        $transaciton->share_id = $model->id; // here the member table's id is share id because I have kept share ifnormation  in this table .
        $transaciton->tx_type = 'share payment';
        $transaciton->type = 'credit';
        $transaciton->payment_status = 'paid';
        $transaciton->member_id = $model->id;
        $transaciton->invoice_no = $new_invoice_no;
        // $transaciton->interest_rate = $share_rate;
        $transaciton->grand_total_amt = $request->share_amount;
        $transaciton->payment_method = $request->payment_method;
        $transaciton->mob_banking_name = $request->mob_banking_name;
        $transaciton->mob_account_holder = $request->mob_account_holder;
        $transaciton->sending_mob_no = $request->sending_mob_no;
        $transaciton->receiving_mob_no = $request->receiving_mob_no;
        $transaciton->mob_tx_id = $request->mob_tx_id;
        $transaciton->mob_payment_date = $request->mob_payment_date;
        $transaciton->bank_name = $request->bank_name;
        $transaciton->account_holder = $request->account_holder;
        $transaciton->account_no = $request->account_no;
        $transaciton->check_no = $request->check_no;
        $transaciton->check_active_date = $request->check_active_date;
        $transaciton->tx_date = $tx_date;
        $transaciton->created_by = auth()->user()->id;
        $transaciton->save();


        activity()->log('Created an Member - ' . $request->name);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Created'), 'goto' => route('admin.member-list.index')]);
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



    // Image_Upload
    public function Image_Upload(Request $request, $id)
    {

        // Upload the file if have & delete the old file
        if ($request->hasFile('photo')) {
            $file = Member::findOrFail($id);
            if ($file->photo) {
                $file_path = public_path() . '/storage/member/' . $file->photo;
                unlink($file_path);
            }
            $storagepath = $request->file('photo')->store('public/member');
            $fileName = basename($storagepath);
        } else {
            $fileName = $request->oldimage;
        }

        $model = Member::findOrFail($id);
        $model->photo = $fileName;
        $model->save();
        // make activity log & return
        activity()->log('Updated a Employee Photo ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Image Updated'), 'load' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the model 
        $model =  Member::where('uuid', $id)->firstOrFail();

        // $code_prefix = get_option('employee_code_prefix');
        // $code_digits = get_option('digits_employee_code');
        // $uniqu_id = generate_id('employee', false);
        // $uniqu_id = numer_padding($uniqu_id, $code_digits);

        // retrurn the employee create page
        return view('admin.member.list.edit', compact('model'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    // getMember
    public function getMember()
    {
        $people = [];
        $people = Member::select('id', 'name_in_bangla')
            ->where('code', 'like', '%' . $_GET['term'] . '%')
            ->orWhere('name_in_bangla', 'like', '%' . $_GET['term'] . '%')
            ->orWhere('email', 'like', '%' . $_GET['term'] . '%')
            ->orWhere('contact_number', 'like', '%' . $_GET['term'] . '%')
            ->orWhere('name_in_english', 'like', '%' . $_GET['term'] . '%')
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json(['items' => $people]);
    }

    // basic_info
    public function basic_info(Request $request)
    {
        $model_id = $request->model_id;
        $model = Member::findOrFail($model_id);
        $nationality = Nationality::all();
        $occupation = Occupation::all();
        $religious = Religious::all();
        return view('admin.member.list.ajax.basic_info', compact("nationality", "occupation", "religious", 'model'));
    }

    // update_basic_info
    public function update_basic_info(Request $request)
    {

        // find the ID for updating the data
        $id = $request->id;

        // validate the data 
        $request->validate([
            'prefix'            =>      'required',
            'code'              =>      'required',
            'name_in_bangla'              =>      'required',
            'gender'            =>      'required',
            'father_name'       =>      'required',
            'mother_name'       =>      'required',
        ]);

        $prefix = $request->prefix;
        $code = $request->code;
        $name_in_bangla = $request->name_in_bangla;
        $name_in_english = $request->name_in_english;
        $date_of_birth = $request->date_of_birth;
        $date_of_anniversary = $request->date_of_anniversary;
        $gender = $request->gender;
        $marital_status = $request->marital_status;
        $nationality = $request->nationality;
        $religious = $request->religious;
        $occupation = $request->occupation;
        $father_name = $request->father_name;
        $mother_name = $request->mother_name;

        // find the model & update the data
        $model = Member::findOrFail($id);
        $model->prefix = $prefix;
        $model->code = $code;
        $model->name_in_bangla = $name_in_bangla;
        $model->name_in_english = $name_in_english;
        $model->date_of_birth = $date_of_birth;
        $model->date_of_anniversary = $date_of_anniversary;
        $model->gender = $gender;
        $model->marital_status = $marital_status;
        $model->nationality_id = $nationality;
        $model->religious_id = $religious;
        $model->occupation_id = $occupation;
        $model->father_name = $father_name;
        $model->mother_name = $mother_name;
        $model->save();

        activity()->log('Updated an Member Basic Information - ' . $request->name);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated Successfully'), 'load' => true]);
    }


    // contact_info
    public function contact_info(Request $request)
    {
        $model_id = $request->model_id;
        $model = Member::findOrFail($model_id);
        return view('admin.member.list.ajax.contact_info', compact('model'));
    }


    // update_contact_info
    public function update_contact_info(Request $request)
    {
        // find the ID for updating the data
        $id = $request->id;

        // validate the data 
        $request->validate([
            'contact_number'            =>      'required|numeric',
            'email'                     =>      'required|email',
            'emergency_contact_name'    =>      'required',
            'present_address_line_1'    =>      'required',
        ]);

        // find the model & update the data
        $model = Member::findOrFail($id);
        $model->contact_number              =   $request->contact_number;
        $model->alternate_contact_number    =   $request->alternate_contact_number;
        $model->email                       =   $request->email;
        $model->alternate_email             =   $request->alternate_email;
        $model->emergency_contact_name      =   $request->emergency_contact_name;
        $model->present_address_line_1      =   $request->present_address_line_1;
        $model->present_address_line_2      =   $request->present_address_line_2;
        $model->present_city                =   $request->present_city;
        $model->present_state               =   $request->present_state;
        $model->present_zipcode             =   $request->present_zipcode;
        $model->present_country             =   $request->present_country;
        $model->same_as_present_address     =   $request->same_as_present_address;
        $model->permanent_address_line_1    =   $request->permanent_address_line_1;
        $model->permanent_address_line_2    =   $request->permanent_address_line_2;
        $model->permanent_state             =   $request->permanent_state;
        $model->permanent_city              =   $request->permanent_state;
        $model->permanent_zipcode           =   $request->permanent_zipcode;
        $model->permanent_country           =   $request->permanent_country;
        $model->save();

        activity()->log('Updated an Member Contact Information - ' . $model->name);
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Updated Successfully'), 'load' => true]);
    }


    // login_info
    public function login_info(Request $request)
    {
        $id = $request->model_id;
        return view('admin.member.list.ajax.login_info', compact('id'));
    }

    // set_login_info
    public function set_login_info(Request $request, $id)
    {
        $request->validate([
            'username' => 'required', 'max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ]);

        if ($request->check == 'on') {
            $model = Member::where('id', $id)->first();
            $user_id = $model->user_id;
            if ($user_id != '') {
                $user = User::findOrFail($user_id);
                $user->username = $request->username;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->status = 'activated';
                $user->save();
            } else {
                $user = new User;
                $user->username = $request->username;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->status = 'activated';
                $user->save();

                $user_id = $user->id;
                $model = Member::findOrFail($id);
                $model->user_id = $user_id;
                $model->save();
            }
        }

        // Activity Log
        activity()->log('Make an user login system');

        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Login Information Updated'), 'load' => true]);
    }
}
