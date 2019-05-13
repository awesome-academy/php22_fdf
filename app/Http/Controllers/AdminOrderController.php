<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(){
        $orders = Order::paginate(config('setting.default_value_page'));

        return view('admin.orders.index', compact('orders', $orders));
    }

}
