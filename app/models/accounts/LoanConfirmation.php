<?php

namespace App\models\accounts;

use Illuminate\Database\Eloquent\Model;

class LoanConfirmation extends Model
{
    public function member(){
        return $this->belongsTo('App\models\Member\Member');
    }

     public function user(){
        return $this->belongsTo('App\models\User','created_by','id');
    }

     public function verified(){
        return $this->belongsTo('App\models\User','verified_by','id');
    }

     public function approved(){
        return $this->belongsTo('App\models\User','approved_by','id');
    }

     public function loan_account(){
        return $this->belongsTo(LoanAccount::class,'loan_account_id','id');
    }
}
