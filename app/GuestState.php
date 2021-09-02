<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GuestState extends Model
{
    protected $table = 'guestState';

    protected $fillable = [
        'stateName'
    ];

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }
}