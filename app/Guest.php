<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $table = 'guests';

    protected $fillable = [
        'name',
        'email'
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function gueststate()
    {
        return $this->belongsTo(GuestState::class, 'guestState_id', 'id');
    }

}