<?php

namespace App\Repositories\Eloquents;

use App\Jobs\SendNotiOrderMail;
use App\Models\Order;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\NewOrder;
use App\Notifications\NewStatusOrder;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use DB;
use Charts;
use Notification;
use Session;


class TransactionEloquentRepository extends EloquentRepository implements TransactionRepositoryInterface {

    public function getModel()
    {
        return Transaction::class;
    }

    public function getCharts()
    {
        $transactionsByMonth = $this->_model::where(DB::raw("(DATE_FORMAT(created_at, '%Y'))"), date('Y'))->get();
        $chartByMonth = $this->createChart($transactionsByMonth, 'bar', @trans('header.chart.title_month'), @trans('header.chart.label'))
            ->groupByMonth(date('Y'), true);

        $transactionsByYear = $this->_model::all();
        $chartByYear = $this->createChart($transactionsByYear, 'bar', @trans('header.chart.title_year'), @trans('header.chart.label'))
            ->groupByYear(config('setting.chart.num_year'));

        return [
            'chartByMonth' => $chartByMonth,
            'chartByYear' => $chartByYear,
        ];
    }

    public function createChart($data, $type, $title, $label)
    {
        $chart = Charts::database($data, $type, 'highcharts')
            ->title($title)
            ->elementLabel($label)
            ->dimensions(config('setting.chart.demen_high'), config('setting.chart.demen_with'))
            ->responsive(true);

        return $chart;
    }

    public function changeStatus($id, $status)
    {
        try {
            $transaction = $this->getById($id);
            $transaction->status = $status;
            $transaction->save();
            if( Notification::send($transaction->user, new NewStatusOrder($transaction))){
                return back();
            }
        } catch (\Exception $e) {

           return false;
        }

        return true;
    }

    public function storeTransaction($id, $request, $oldCart)
    {
        DB::beginTransaction();
        try {
            $data = [
                'user_id' => $id,
                'amount' => $oldCart->totalPrice,
                'payment' => config('setting.default_value_0'),
                'message' => $request->message,
                'status' => config('setting.default_value_0'),
            ];
            $transaction = $this->_model->create($data);

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

                    return 0;
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

            return false;
        }

        return true;
    }

}
