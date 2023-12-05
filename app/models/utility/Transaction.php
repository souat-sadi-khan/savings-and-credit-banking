<?php

namespace App\models\utility;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public function member()
    {
        return $this->belongsTo('App\models\Member\Member');
    }
    public function savings_ac()
    {
        return $this->belongsTo('App\models\accounts\SavingsAccount', 'savings_account_id', 'id');
    }
    public function dps_ac()
    {
        return $this->belongsTo('App\models\accounts\DpsAccount', 'dps_account_id', 'id');
    }

    public function bank_account()
    {
        return $this->belongsTo('App\models\bank_accounts\BankAccount', 'bank_account_id', 'id');
    }

    public function savings_acc()
    {
        return $this->belongsTo('App\models\accounts\SavingsAccount', 'savings_account_id', 'id');
    }

    public function loan_acc()
    {
        return $this->belongsTo('App\models\accounts\LoanAccount', 'loan_account_id', 'id');
    }

    public function double_benifit_acc()
    {
        return $this->belongsTo('App\models\accounts\DoubleBenifitAccount', 'double_benifit_account_id', 'id');
    }

    public function fdr_acc()
    {
        return $this->belongsTo('App\models\accounts\FdrAccount', 'fdr_account_id', 'id');
    }



    public function expense_inf()
    {
        return $this->belongsTo('App\models\expense\Expense', 'expense_id', 'id');
    }

    public function expense_category_inf()
    {
        return $this->belongsTo('App\models\utility\ExpenseCategory', 'expense_category_id', 'id');
    }

    public function income_category_inf()
    {
        return $this->belongsTo('App\models\utility\IncomeCategory', 'income_category_id', 'id');
    }
}
