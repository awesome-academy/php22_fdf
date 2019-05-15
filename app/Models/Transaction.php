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

    public function getStatus(){
        if ($this->status == config('setting.default_value_0')) {

            return @trans('message.status_pending');
        } else if ($this->status == config('setting.default_value_1')) {
            return @trans('message.status_done');
        }

        return  @trans('message.status_reject');
    }
}
