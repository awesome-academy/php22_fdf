<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'discount',
        'slug',
        'rating',
    ];

    public function category(){

        return $this->belongsTo(Catetory::class);
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
