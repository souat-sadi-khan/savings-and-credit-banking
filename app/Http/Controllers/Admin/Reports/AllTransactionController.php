<?php

namespace App\Http\Controllers\Admin\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\bank_accounts\BankAccount;
use App\models\Member\Member;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use App\models\utility\Transaction;

class AllTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.all-tx-report.index');
    }


    public function store(Request $request)
    {
        $report_type =  $request->report_type;

        $start_date =  Carbon::createFromFormat('d/m/Y',  $request->start_date)->format('Y-m-d');
        $end_date =  Carbon::createFromFormat('d/m/Y',  $request->end_date)->format('Y-m-d');
        if ($start_date > $end_date) {

            throw  ValidationException::withMessages(['message' => 'Remember: Start Date Cannot Be Greater Than The End Date.']);
        }
        $dates['start_date'] = Carbon::createFromFormat('d/m/Y',  $request->start_date)->format('d-M, Y');
        $dates['end_date'] = Carbon::createFromFormat('d/m/Y',  $request->end_date)->format('d-M, Y');
        $dates['both'] = $start_date == $end_date ? false : true;

        $organization['name'] = get_option('company_name');
        $organization['address'] = get_option('address');
        $organization['phone'] = get_option('phone');
        $organization['email'] = get_option('email');


        $transaciton_info = Transaction::whereBetween('tx_date', [$start_date, $end_date])->get();
        // dd($transaciton_info);

        return view('admin.reports.all-tx-report.all_transaction_report', compact('report_type', 'organization', 'dates', 'transaciton_info'));
    }

    // in the following function the modal for selecting date will be opened
    public function edit($report_type)
    {

        return view('admin.reports.all-tx-report.report_form', compact('report_type'));
    }
}
