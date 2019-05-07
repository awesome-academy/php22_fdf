<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FeedBack;
use App\Models\Product;
use App\Models\User;

class StoreController extends Controller
{
    public function index(){
        return view('index')->with('categories', Category::all());
    }
}
