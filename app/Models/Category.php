<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'slug',
    ];

    public function products(){

        return $this->hasMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class);
    }

    public function childrens()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
