<?php

namespace App\Http\Controllers\Admin\Reports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class FinancialYearReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reports.financial-year-report.index');
    }

    public function edit($report_type)
    {

        $organization['name'] = get_option('company_name');
        $organization['address'] = get_option('address');
        $organization['phone'] = get_option('phone');
        $organization['email'] = get_option('email');

        $end_year = date('Y');
        $start_year = $end_year - 1;

        $end_date = Carbon::createFromFormat('Y-m-d', $end_year . '-06-30')->format('Y-m-d');
        $start_date = Carbon::createFromFormat('Y-m-d', $start_year . '-07-01')->format('Y-m-d');

        $prev_year_end_date = Carbon::createFromFormat('Y-m-d', $end_year - 1 . '-06-30')->format('Y-m-d');
        $prev_year_start_date = Carbon::createFromFormat('Y-m-d', $start_year - 1 . '-07-01')->format('Y-m-d');

        $financial_year = Carbon::createFromFormat('Y-m-d', $end_date)->format('d M, Y') . ' - Closing Year';

        if ($report_type == 'RESIDUAL DOCUMENT') {
            dd($report_type);
        } else if ($report_type == 'PROFIT AND LOSS CALCULATION') {
            // create the financial year start and end date

            $porfit_loss = profit_loss_calculation($start_date, $end_date);


            // now calculate previous years net profit

            $prev_years_profit = profit_loss_calculation($prev_year_start_date, $prev_year_end_date)['after_allocations']['Net Profit After Allocation'];

            $porfit_loss['after_allocations']["Previous Year's Profit"] = $prev_years_profit;
            $porfit_loss['after_allocations']["Current Year's Profit Distribution"] = $prev_years_profit;

            $incomes = $porfit_loss['incomes'];
            $expenses = $porfit_loss['expenses'];
            $before_allcations = $porfit_loss['before_allcations'];
            $allocation_calculations = $porfit_loss['allocation_calculations'];
            $after_allocations = $porfit_loss['after_allocations'];

            // $porfit_loss['financial_year'];
            // dd($after_allocations);

            return view('admin.reports.financial-year-report.profit_loss', compact('report_type', 'incomes', 'expenses', 'before_allcations', 'allocation_calculations', 'after_allocations', 'financial_year', 'organization'));
        } else if ($report_type == 'TRIAL BALANCE') {

            $trial_balanc = trial_balance($start_date, $end_date, $prev_year_start_date, $prev_year_end_date);
            // variable separation for simplicity
            $debit = $trial_balanc['debit'];
            $credit = $trial_balanc['credit'];
            $opening = $trial_balanc['opening'];
            $total_debit = $trial_balanc['total_debit'];
            $total_credit = $trial_balanc['total_credit'];

            return view('admin.reports.financial-year-report.trial_balance', compact('report_type', 'organization', 'financial_year', 'debit', 'credit', 'opening', 'total_debit', 'total_credit'));
        }
    }
}
