<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'homeAddress',
    ];

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    public function orderedAddresses()
    {
        return $this->getQuery()->orderBy('homeAddress', 'desc')->get();
    }
}