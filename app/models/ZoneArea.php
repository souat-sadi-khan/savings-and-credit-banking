<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ZoneArea extends Model
{
    public $timestamps = false;

    public function zone(){
    	return $this->belongsTo(Zone::class);
    }

    public function area(){
    	return $this->belongsTo(Area::class);
    }
}
