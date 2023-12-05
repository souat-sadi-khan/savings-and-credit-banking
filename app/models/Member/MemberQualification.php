<?php

namespace App\models\Member;

use Illuminate\Database\Eloquent\Model;

class MemberQualification extends Model
{
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
