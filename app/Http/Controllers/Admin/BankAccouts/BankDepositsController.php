<?php

namespace App\Http\Controllers\Admin\BankAccouts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\Datatables\Datatables;
use App\models\utility\Transaction;
use Carbon\Carbon;

class BankDepositsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.bank-transactions.bank-deposits.index');
    }


    // ajax data table 

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $model = Transaction::where('tx_type', 'bank payment')->with('bank_account')->get();
            return Datatables::of($model)
                ->addIndexColumn()
                ->editColumn('account_no', function ($model) {
                    return $model->bank_account->account_no ? $model->bank_account->account_no : '';
                })
                ->editColumn('bank_name', function ($model) {
                    return $model->bank_account->bank_name ? $model->bank_account->bank_name : '';
                })
                ->editColumn('branch_name', function ($model) {
                    return  $model->bank_account->branch_name ? $model->bank_account->branch_name : '';
                })
                ->editColumn('account_holder_name', function ($model) {
                    return $model->bank_account->account_holder_name ? $model->bank_account->account_holder_name : '';
                })
                ->editColumn('ref_no', function ($model) {
                    return $model->reference_no ? $model->reference_no : 'N/A';
                })
                ->editColumn('deposit', function ($model) {
                    return $model->grand_total_amt;
                })
                ->editColumn('tx_date', function ($model) {
                    return carbonDate($model->tx_date);
                })

                ->addColumn('action', function ($model) {
                    return view('admin.bank-transactions.bank-deposits.action', compact('model'));
                })->rawColumns(['action'])->make(true);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Transaction::findOrFail($id);
        return view('admin.bank-transactions.bank-deposits.edit', compact('model'));
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
            'deposit_amt' => 'required',
            'deposit_date' => 'required',
        ]);

        $model = Transaction::findOrFail($id);
        $model->grand_total_amt = $request->deposit_amt;
        $model->tx_date = Carbon::createFromFormat('d/m/Y', $request->deposit_date)->format('Y-m-d');
        $model->reference_no =  $request->reference_no;
        $model->save();

        activity()->log('Bank Deposit Updated');
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
        $model =  Transaction::findOrFail($id);
        $model->delete();


        activity()->log('Deleted Bank Deposit ');
        return response()->json(['success' => true, 'status' => 'success', 'message' => _lang('Data Deleted'), 'load' => true]);
    }
}
