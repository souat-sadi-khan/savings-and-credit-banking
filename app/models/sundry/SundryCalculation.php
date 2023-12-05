<?php

namespace App\models\sundry;

use Illuminate\Database\Eloquent\Model;

class SundryCalculation extends Model
{
    public function member()
    {
        return $this->belongsTo('App\models\Member\Member', 'member_id', 'id');
    }

    public function dps_acc()
    {
        return $this->belongsTo('App\models\accounts\DpsAccount', 'dps_id', 'id');
    }


    public function savings_acc()
    {
        return $this->belongsTo('App\models\accounts\SavingsAccount', 'savings_id', 'id');
    }


    public function share_acc()
    {
        return $this->belongsTo('App\models\Member\Member', 'share_id', 'id');
    }

    public function double_benifit_acc()
    {
        return $this->belongsTo('App\models\accounts\DoubleBenifitAccount', 'double_benifit_id', 'id');
    }

    public function loan_from_member_acc()
    {
        return $this->belongsTo('App\models\accounts\FdrAccount', 'fdr_id', 'id');
    }
}
