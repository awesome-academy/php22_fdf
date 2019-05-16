<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Suggest;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use Charts;

class ChartController extends Controller
{
    public function index(){
        $transactionsByMonth = Transaction::where(DB::raw("(DATE_FORMAT(created_at, '%Y'))"), date('Y'))->get();
        $chartByMonth = $this->createChart($transactionsByMonth, 'bar', @trans('header.chart.title_month'), @trans('header.chart.label'))
                             ->groupByMonth(date('Y'), true);

        $transactionsByYear = Transaction::all();
        $chartByYear = $this->createChart($transactionsByYear, 'bar', @trans('header.chart.title_year'), @trans('header.chart.label'))
                            ->groupByYear(config('setting.chart.num_year'));

        $totalUser = User::all()->count();
        $totalProduct = Product::all()->count();
        $totalTransactions =$transactionsByYear->count();
        $totalSuggest = Suggest::where('status', config('setting.default_value_0'))->count();

        return view('home', [
            'chartByMonth' => $chartByMonth,
            'chartByYear' => $chartByYear,
            'totalUser' => $totalUser,
            'totalProduct' => $totalProduct,
            'totalTransactions' => $totalTransactions,
            'totalSuggest' => $totalSuggest,
        ]);
    }

    public function createChart($data, $type, $title, $label){
        $chart = Charts::database($data, $type, 'highcharts')
                        ->title($title)
                        ->elementLabel($label)
                        ->dimensions(config('setting.chart.demen_high'), config('setting.chart.demen_with'))
                        ->responsive(true);

        return $chart;
    }

}
