<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'transaction_id',
        'amount',
        'quantity',
        'status',
    ];
    public function user(){

         return $this->belongsTo(User::class);
     }

    public function product(){

        return $this->belongsTo(Product::class);
    }

    public function transaction(){

        return $this->belongsTo(Transaction::class);
    }

    public function getStatus(){
        if($this->status == config('setting.default_value_0')){

            return @trans('message.status_pending');
        }elseif ($this->status == config('setting.default_value_1')){

            return @trans('message.status_done');
        }

        return @trans('message.status_reject');
    }

}
