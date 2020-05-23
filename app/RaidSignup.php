<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaidSignup extends Model
{
    protected $guarded = ['note'];

    public function raid()
    {
        return $this->belongsTo(Raid::class);
    }
}
