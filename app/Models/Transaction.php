<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'payment',
        'message',
        'status',
    ];

    public function order(){

        return $this->hasMany(Order::class);
    }
}
