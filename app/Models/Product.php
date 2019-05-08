<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'discount',
        'slug',
        'quantity',
        'rating',
    ];

    public function category(){

        return $this->belongsTo(Category::class);
    }

    public function rate(){

        return $this->hasMany(Rate::class);
    }

    public function feedBack(){

        return $this->hasMany(FeedBack::class);
    }

    public function images(){

        return $this->hasMany(Image::class);
    }
}
