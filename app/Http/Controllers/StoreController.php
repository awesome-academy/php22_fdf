<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class StoreController extends Controller
{
    public function index(){
        return view('index')->with('categories', Category::with('products')->get())
                                  ->with('products', Product::with('category')->paginate(config('setting.default_value_page')));
    }

    public function singleProduct($slug){
        try {
            $product = Product::where('slug', $slug )->first();
            $category = Category::findOrFail($product->category_id);
        } catch (\Exception $e) {
            Session::flash('fail', $e);

            return redirect()->back();
        }
        $popular_products = Product::where('rating', '>' , config('setting.default_value_star'));

        return view('single')->with('categories', Category::with('products')->get())
                                   ->with('category', $category)
                                   ->with('popular_products', $popular_products)
                                   ->with('product', $product);
    }

    public function singleCategory($slug){
        try {
            $category = Category::where('slug', $slug )->first();
            $products = $category->products;
        } catch (\Exception $e) {
            Session::flash('fail', $e);

            return redirect()->back();
        }

        return view('category')->with('categories', Category::with('products')->get())
                                     ->with('category', $category)
                                     ->with('products', $products);

    }

}
