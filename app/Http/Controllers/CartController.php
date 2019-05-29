<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    private $categoryRepository;
    private $productRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, ProductRepositoryInterface $productRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->productRepository = $productRepository;
    }

    public function index(){

        return view('cart')->with('categories', $this->categoryRepository->getAll());
    }

    public function update($id, Request $request){
        try {
            $product =  $this->productRepository->getById($id);
            $quantity = $request->input('quantity');
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            $cart->add($product, $id , $quantity );
            $request->session()->put('cart', $cart);

            return $this->responseAjax($cart->totalQty, $cart->totalPrice, $product, $product->images[config('setting.default_value_0')]->url, $cart->items);
        } catch (\Exception $e) {

        }
    }

    public function destroy($id){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if ( count($cart->items) > config('setting.default_value_0')) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart', $cart);
        }

        return $this->responseAjax($cart->totalQty, $cart->totalPrice, null, null, $cart);
    }

    public function responseAjax($totalQty, $totalPrice, $product, $image, $cart){

        return response()->json([
            'totalQty' => $totalQty,
            'totalPrice' => $totalPrice,
            'product' => $product,
            'image' => $image,
            'cart' => $cart,
        ]);
    }
}
