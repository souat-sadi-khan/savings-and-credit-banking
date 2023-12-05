<?php

namespace App\models\accounts;

use Illuminate\Database\Eloquent\Model;

class FdrAccount extends Model
{
    public function fdrMember()
    {
        return $this->hasMany(FdrMember::class, 'fdr_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo('App\models\User', 'created_by', 'id');
    }

    public function approved()
    {
        return $this->belongsTo('App\models\User', 'approved_by', 'id');
    }
}
