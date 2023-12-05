<?php

namespace App\models\accounts;

use Illuminate\Database\Eloquent\Model;

class DpsAccount extends Model
{
    public function member()
    {
        return $this->belongsTo('App\models\Member\Member');
    }

    public function identity_provider()
    {
        return $this->belongsTo('App\models\Member\Member');
    }

    public function user()
    {
        return $this->belongsTo('App\models\User', 'created_by', 'id');
    }

    public function approved()
    {
        return $this->belongsTo('App\models\User', 'approved_by', 'id');
    }

    public function transaction()
    {
        return $this->belongsTo('App\models\utility\Transaction', 'transaction_id', 'id');
    }
}
