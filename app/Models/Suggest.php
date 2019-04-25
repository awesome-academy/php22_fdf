<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggest extends Model
{
    protected $fillable = [
        'category_id',
        'product_name',
        'content',
        'status',
    ];

    public function user(){

        return $this->belongsTo(User::class);
    }
}
