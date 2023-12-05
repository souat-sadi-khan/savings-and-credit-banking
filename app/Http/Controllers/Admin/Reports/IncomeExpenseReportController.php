<?php

namespace App\Http\Controllers\Admin\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\utility\ExpenseCategory;
use App\models\utility\IncomeCategory;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use App\models\utility\Transaction;

class IncomeExpenseReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.income-expense-report.index');
    }


    public function store(Request $request)
    {
        $report_type =  $request->report_type;
        // dd($report_type);
        // $report_head =  $request->report_head;
        // dd($report_type);
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

        if ($report_type == 'INCOME GENERAL REPORT') {
            // calculating all incomes
            $total = 0;
            $income_cat_model = IncomeCategory::all();

            foreach ($income_cat_model as $income_cats) {
                $head_amt[$income_cats->name] = Transaction::where('income_category_id', $income_cats->id)->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $total += $head_amt[$income_cats->name];
            }
            return view('admin.reports.income-expense-report.general_report', compact('report_type', 'organization', 'dates', 'head_amt', 'total'));
        } elseif ($report_type == 'EXPENSE GENERAL REPORT') {
            // now get expenses that are 
            $total = 0;
            $expense_cat_model = ExpenseCategory::all();

            foreach ($expense_cat_model as $expense_cats) {
                $head_amt[$expense_cats->name] = Transaction::where('expense_category_id', $expense_cats->id)->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $total += $head_amt[$expense_cats->name];
            }
            return view('admin.reports.income-expense-report.general_report', compact('report_type', 'organization', 'dates', 'head_amt', 'total'));
        } elseif ($report_type == 'HEAD WISE INCOME REPORT') {
            $report_head_id = $request->head_id;

            $head_name = IncomeCategory::find($report_head_id)->name;
            $tx_info = Transaction::where('income_category_id', $report_head_id)->whereBetween('tx_date', [$start_date, $end_date])->get();
            $total = Transaction::where('income_category_id', $report_head_id)->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');

            return view('admin.reports.income-expense-report.head_wise_report', compact('report_type', 'organization', 'dates', 'head_name', 'tx_info', 'total'));
        } elseif ($report_type == 'HEAD WISE EXPENSE REPORT') {
            $report_head_id = $request->head_id;

            $head_name = ExpenseCategory::find($report_head_id)->name;
            $tx_info = Transaction::where('expense_category_id', $report_head_id)->whereBetween('tx_date', [$start_date, $end_date])->get();
            $total = Transaction::where('expense_category_id', $report_head_id)->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');

            return view('admin.reports.income-expense-report.head_wise_report', compact('report_type', 'organization', 'dates', 'head_name', 'tx_info', 'total'));
        } elseif ($report_type == "INCOME VS EXPENSE REPORT") {
            // calculating all incomes
            $total_income = 0;
            $income_cat_model = IncomeCategory::all();

            foreach ($income_cat_model as $income_cats) {
                $income_head_amt[$income_cats->name] = Transaction::where('income_category_id', $income_cats->id)->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $total_income += $income_head_amt[$income_cats->name];
            }

            $total_expense = 0;
            $expense_cat_model = ExpenseCategory::all();

            foreach ($expense_cat_model as $expense_cats) {
                $expense_head_amt[$expense_cats->name] = Transaction::where('expense_category_id', $expense_cats->id)->whereBetween('tx_date', [$start_date, $end_date])->sum('grand_total_amt');
                $total_expense += $expense_head_amt[$expense_cats->name];
            }
            $total_income_count = count($income_head_amt);
            $total_expense_count = count($expense_head_amt);
            $max_row = $total_income_count > $total_expense_count ? $total_income_count : $total_expense_count;

            return view('admin.reports.income-expense-report.income_vs_expense_report', compact('report_type', 'organization', 'dates', 'income_head_amt', 'total_income', 'expense_head_amt', 'total_expense', 'total_income_count', 'total_expense_count', 'max_row', 'income_cat_model', 'expense_cat_model'));
        }
    }

    // in the following function the modal for selecting date will be opened
    public function edit($report_type)
    {
        // dd($report_type);
        if ($report_type == 'HEAD WISE INCOME REPORT') {
            $heads = IncomeCategory::all();
            return view('admin.reports.income-expense-report.report_form', compact('report_type', 'heads'));
        } elseif ($report_type == 'HEAD WISE EXPENSE REPORT') {
            $heads = ExpenseCategory::all();
            return view('admin.reports.income-expense-report.report_form', compact('report_type', 'heads'));
        }
        return view('admin.reports.income-expense-report.report_form', compact('report_type'));
    }
}
