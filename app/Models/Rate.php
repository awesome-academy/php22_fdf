<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
    ];

    public function  product(){

        return $this->belongsTo(Product::class);
    }

    public function  user(){

        return $this->belongsTo(Product::class);
    }
}
