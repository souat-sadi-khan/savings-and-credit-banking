<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    public function zone_areas(){
    	return $this->hasMany(ZoneArea::class);
    }
}
