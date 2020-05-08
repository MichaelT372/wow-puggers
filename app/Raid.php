<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed loot_rules
 */
class Raid extends Model
{
    protected $guarded = [
        'loot_rules', 'open', 'leader_id'
    ];

    protected $casts = [
        'soft_reserves' => 'boolean',
    ];

    protected $dates = [
        'start_at'
    ];

    protected $with = ['leader'];

    public function addSignup(RaidSignup $signup)
    {
        return $this->raiders()->save($signup);
    }

    public function leader()
    {
        return $this->hasOne(User::class, 'id', 'leader_id');
    }

    public function raiders()
    {
        return $this->hasMany(RaidSignup::class);
    }
}
