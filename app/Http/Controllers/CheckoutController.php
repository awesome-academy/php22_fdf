<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Cart;
use DB;
use Session;
use Notification;

class CheckoutController extends Controller
{
    private $transactionRepository;
    private $categoryRepository;

    public function __construct(TransactionRepositoryInterface $transactionRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function index()
    {
        if (!Session::has('cart')){
            Session::flash('info', @trans('message.success.checkout.nothing_cart'));

            return redirect()->route('index');
        }
        $categories =  $this->categoryRepository->getAll();
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $totalPrice = $cart->totalPrice;

        return view('checkout', ['totalPrice' => $totalPrice, 'cart' => $cart, 'categories' => $categories]);
    }

    public function show($id)
    {
        $categories = $this->categoryRepository->getAll();
        $transactions = $this->transactionRepository->where('user_id', $id);

        return view('order', ['transactions' => $transactions, 'categories' => $categories]);
    }

    public function store (Request $request)
    {
        $id = auth()->id();
        $oldCart = Session::get('cart');
        if ( $oldCart->totalQty == config('setting.default_value_0') || $oldCart == null){
            Session::flash('info', @trans('message.success.checkout.nothing_cart'));

            return redirect()->back();
        }

        if ($store = $this->transactionRepository->storeTransaction($id, $request, $oldCart) == true){
            Session::flash('success', @trans('message.success.checkout.success'));

            return redirect()->route('checkout.show', ['id' => $id]);
        } elseif ($store == config('setting.default_value_0')){

            return redirect()->route('cart.index');
        } else {
            Session::flash('info', @trans('message.success.checkout.error'));

            return redirect()->route('cart.index');
        }

    }
}
