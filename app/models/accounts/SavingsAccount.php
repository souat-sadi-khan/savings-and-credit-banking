<?php

namespace App\models\accounts;

use Illuminate\Database\Eloquent\Model;

class SavingsAccount extends Model
{

    public function member()
    {
        return $this->belongsTo('App\models\Member\Member');
    }

    public function user()
    {
        return $this->belongsTo('App\models\User', 'created_by', 'id');
    }
}
