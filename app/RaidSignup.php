<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaidSignup extends Model
{
    protected $guarded = ['confirmed'];

    public function raid()
    {
        return $this->hasOne(Raid::class);
    }
}
