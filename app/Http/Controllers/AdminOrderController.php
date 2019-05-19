<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use App\Notifications\NewStatusOrder;
use Notification;

class AdminOrderController extends Controller
{
    public function index(){
        $transactions = Transaction::orderBy('created_at', 'desc')->get();

        return view('admin.orders.index')->with('transactions', $transactions);
    }

    public function changeStatus($id, $status){
        try {
            $transaction = Transaction::findOrFail($id);
            $transaction->status = $status;
            $transaction->save();
            if( Notification::send($transaction->user, new NewStatusOrder($transaction))){
                return back();
            }
        } catch (\Exception $e) {

            return response()->json([
                'mess' => @trans('message.status_change_fail')
            ]);
        }

        return response()->json([
            'mess' => @trans('message.status_change')
        ]);
    }

}
