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

        return $this->belongsToMany(Product::class, 'order_product', 'order_id', 'product_id');
    }

    public function transaction(){

        return $this->belongsTo(Transaction::class);
    }
}
