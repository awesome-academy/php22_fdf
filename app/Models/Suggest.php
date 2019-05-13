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

    public function category(){

        return $this->belongsTo(Category::class);
    }

    public function getStatus(){
        if($this->status == config('setting.default_value_0')){

            return @trans('message.status_pending');
        }

        return @trans('message.status_done');
    }
}
