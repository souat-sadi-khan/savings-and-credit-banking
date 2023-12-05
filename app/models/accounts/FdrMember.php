<?php

namespace App\models\accounts;

use Illuminate\Database\Eloquent\Model;

class FdrMember extends Model
{
    public function member()
    {
        return $this->belongsTo('App\models\Member\Member', 'member_id', 'id');
    }
}
