<?php

namespace App\models\expense;

use App\models\utility\ExpenseCategory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public function expense_category()
    {
        return $this->belongsTo(ExpenseCategory::class, 'expense_category_id', 'id');
    }
    public function exp_for()
    {
        return $this->belongsTo('App\models\employee\Employee', 'expense_for', 'id');
    }
}
