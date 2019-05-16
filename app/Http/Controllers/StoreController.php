<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FeedBack;
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
        $feedbacks = FeedBack::where('product_id', $product->id)->get();

        return view('single')->with('categories', Category::with('products')->get())
                                   ->with('category', $category)
                                   ->with('popular_products', $popular_products)
                                   ->with('product', $product)
                                   ->with('feedbacks', $feedbacks);
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

    public function feedback($id , $rating, Request $request)
    {
        $content = $request->input( 'content' );
        $feedback = FeedBack::create([
            'user_id' => Auth::id(),
            'product_id' => $id,
            'content' => $content,
            'rating' => $rating,
        ]);

        try {
            $product = Product::findOrFail($id);
            $product->rating = $product->rating();
            $product->save();
        } catch (\Exception $e) {

        }
        return response()->json([
            'user_name' => Auth::user()->name,
            'feedback' => $feedback,
        ]);
    }
}
