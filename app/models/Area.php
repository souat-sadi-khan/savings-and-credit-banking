<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function zone_areas(){
        return $this->hasMany(ZoneArea::class);
    }
}
