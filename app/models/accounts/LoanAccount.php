<?php

namespace App\models\accounts;

use Illuminate\Database\Eloquent\Model;

class LoanAccount extends Model
{
    public function member()
    {
        return $this->belongsTo('App\models\Member\Member');
    }

    public function user()
    {
        return $this->belongsTo('App\models\User', 'created_by', 'id');
    }

    public function savings()
    {
        return $this->belongsTo('App\models\accounts\SavingsAccount', 'savings_account_id', 'id');
    }

    public function verified()
    {
        return $this->belongsTo('App\models\User', 'verified_by', 'id');
    }

    public function approved()
    {
        return $this->belongsTo('App\models\User', 'approved_by', 'id');
    }

    public function loan_confirmation()
    {
        return $this->belongsTo(LoanConfirmation::class, 'id', 'loan_account_id');
    }

    public function zone()
    {
        return $this->belongsTo('App\models\Zone', 'zone_id', 'id');
    }

    public function area()
    {
        return $this->belongsTo('App\models\Area', 'area_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany('App\models\utility\Transaction', 'loan_account_id', 'id');
    }
}
