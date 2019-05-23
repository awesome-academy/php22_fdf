<?php

namespace App\Repositories\Eloquents;

use App\Models\Category;
use App\Models\User;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class CategoryEloquentRepository extends EloquentRepository implements CategoryRepositoryInterface {

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Category::class;
    }

    public function getCategoryChildrens()
    {
        $categories = Category::where('parent_id', '>', config('setting.default_value_0'))->pluck('name', 'id')->toArray();

        return $categories;
    }
    public function getCategory()
    {
        $categories = Category::pluck('name', 'id');

        return $categories;
    }
}
