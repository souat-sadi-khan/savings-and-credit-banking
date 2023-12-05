<?php

namespace App\models\income;

use App\models\utility\IncomeCategory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{

    public function income_category()
    {
        return $this->belongsTo(IncomeCategory::class, 'income_category_id', 'id');
    }
    public function exp_for()
    {
        return $this->belongsTo('App\models\employee\Employee', 'income_for', 'id');
    }
}
