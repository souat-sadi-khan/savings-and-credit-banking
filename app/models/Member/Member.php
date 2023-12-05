<?php

namespace App\models\Member;

use App\models\accounts\SavingsAccount;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function savings_account()
    {
        return $this->hasMany(SavingsAccount::class);
    }
}
