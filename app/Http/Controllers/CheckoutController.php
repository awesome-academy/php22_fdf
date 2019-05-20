<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewOrder;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Cart;
use App\Jobs\SendNotiOrderMail;
use DB;
use Session;
use Notification;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!Session::has('cart')){
            Session::flash('info', @trans('message.success.checkout.nothing_cart'));

            return redirect()->route('index');
        }
        $categories = Category::all();
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $totalPrice = $cart->totalPrice;

        return view('checkout', ['totalPrice' => $totalPrice, 'cart' => $cart, 'categories' => $categories]);
    }

    public function show($id)
    {
        $categories = Category::all();
        $transactions = Transaction::where('user_id', $id)->get();

        return view('order', ['transactions' => $transactions, 'categories' => $categories]);
    }

    public function store (Request $request)
    {
        $id = Auth()->id();
        $oldCart = Session::get('cart');
        if ( $oldCart->totalQty == config('setting.default_value_0') || $oldCart == null){
            Session::flash('info', @trans('message.success.checkout.nothing_cart'));

            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $transaction = Transaction::create([
                'user_id' => $id,
                'amount' => $oldCart->totalPrice,
                'payment' => config('setting.default_value_0'),
                'message' => $request->message,
                'status' => config('setting.default_value_0'),
            ]);

            foreach ( $oldCart->items as $key => $item){
                $product = Product::findOrFail($key);
                if ($product->quantity >= $item['quantity']) {
                    $product->quantity -= $item['quantity'];
                    $product->save();

                    $order = Order::create([
                        'user_id' => $id,
                        'product_id' => $item['item']->id,
                        'transaction_id' => $transaction->id,
                        'amount' => $item['price'],
                        'quantity' => $item['quantity'],
                        'status' => config('setting.default_value_0'),
                    ]);
                } else {
                    Session::flash('info', @trans('message.success.checkout.outof_product') . $product->name . @trans('message.success.checkout.just_have') . $product->quantity);

                    return redirect()->route('cart.index');
                }
            }
            $request->session()->forget('cart');
            DB::commit();
            $admins = User::where('is_admin', true)->get();
            foreach ($admins as $admin){
                if( Notification::send($admin, new NewOrder($transaction))){
                    return back();
                }
                dispatch(new SendNotiOrderMail($transaction, $admin));
            }
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('info', @trans('message.success.checkout.error'));

            return redirect()->route('cart.index');
        }
        Session::flash('success', @trans('message.success.checkout.success'));

        return redirect()->route('checkout.show', ['id' => $id]);
    }
}
