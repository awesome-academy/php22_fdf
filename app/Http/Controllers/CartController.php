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
        $quantity = $request->input('quantity');
        $checkQuantity = $this->check($id, $quantity);
        if ($checkQuantity){
            $product =  $this->productRepository->getById($id);
            $oldCart = Session::has('cart') ? Session::get('cart') : null;
            $cart = new Cart($oldCart);
            if ( $cart->add($product, $id , $quantity )){
                $request->session()->put('cart', $cart);

                return $this->responseAjax(true, $cart->totalQty, $cart->totalPrice, $product, $product->images[config('setting.default_value_0')]->url, $cart->items);
            }

            return response()->json([
                'status' => false,
            ]);
        } else {
            return response()->json([
                'status' => false,
            ]);
        }

    }

    public function checkQuantityAjax($id, Request $request){
        $quantity = $request->input('quantity');
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        if ($oldCart != null && array_key_exists($id, $oldCart->items) ) {
            $quantityInCart = $oldCart->items[$id]['quantity'];
        } else {
            $quantityInCart = config('setting.default_value_0') ;
        }
        $productOrigin = $this->productRepository->getById($id);
        $checkQuantity = $this->check($id, $quantity + $quantityInCart);
        if (!$checkQuantity){

            return response()->json([
                'status' => false,
                'quantity' => $productOrigin->quantity - $quantityInCart,
            ]);
        }

        return response()->json([
            'status' => true,
        ]);
    }

    public function check($id, $quantity){
        $product =  $this->productRepository->getById($id);
        $stock = $product->quantity;
        if ($quantity > $stock || $stock == config('setting.default_value_0')){

            return false;
        }

        return true;
    }

    public function store(Request $request){
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        foreach($oldCart->items as $key => $item){
            if ($this->check($key, $item['quantity'] )) {
                $oldCart->items[$key]['quantity'] = $request->input('number_quantity' . $key);
                $oldCart->items[$key]['price'] = $oldCart->items[$key]['quantity'] * $oldCart->items[$key]['item']->price*(1- $oldCart->items[$key]['item']->discount*0.1);
            } else {
                $product = $this->productRepository->getById($key);
                Session::flash('info', @trans('message.success.checkout.outof_product') . $item['item']->name . @trans('message.success.checkout.just_have') . $product->quantity);

                if ( $oldCart->items[$key]['quantity'] == config('setting.default_value_0')) {
                    $this->destroy($key);
                } else {
                    $oldCart->items[$key]['quantity'] = $product->quantity;
                    $oldCart->items[$key]['price'] = $product->price * $product->quantity;

                    $cart = new Cart($oldCart);
                    $cart->updateProductInCart($oldCart, $request);
                }

                return redirect()->route('cart.index');
            }
        }
        $cart = new Cart($oldCart);
        $cart->updateProductInCart($oldCart, $request);

        return redirect()->route('checkout.index');
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

        return $this->responseAjax(true, $cart->totalQty, $cart->totalPrice, null, null, $cart);
    }

    public function responseAjax($status, $totalQty, $totalPrice, $product, $image, $cart){

        return response()->json([
            'status' => $status,
            'totalQty' => $totalQty,
            'totalPrice' => $totalPrice,
            'product' => $product,
            'image' => $image,
            'cart' => $cart,
        ]);
    }
}
