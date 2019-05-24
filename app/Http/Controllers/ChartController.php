<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TransactionRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Eloquents\SuggestEloquentRepository;
use DB;
use Charts;

class ChartController extends Controller
{
    private $transactionRepository;
    private $productRepository;
    private $userRepository;
    private $suggestRepository;


    public function __construct(TransactionRepositoryInterface $transactionRepository,
                                UserRepositoryInterface $userRepository,
                                ProductRepositoryInterface $productRepository,
                                SuggestEloquentRepository $suggestRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->suggestRepository = $suggestRepository;
    }

    public function index(){

        $chart = $this->transactionRepository->getCharts();

        $totalUser = $this->userRepository->count();
        $totalProduct =$this->productRepository->count();
        $totalTransactions = $this->transactionRepository->count();
        $totalSuggest = $this->suggestRepository->countSuggest();

        return view('home', [
            'chartByMonth' => $chart['chartByMonth'],
            'chartByYear' => $chart['chartByYear'],
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
