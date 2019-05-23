<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquents\SuggestEloquentRepository;
use Session;

class SuggestController extends Controller
{
    private $suggestRepository;

    public function __construct(SuggestEloquentRepository $suggestRepository)
    {
        $this->suggestRepository = $suggestRepository;
    }
    public function index(){

        return view('admin.suggest.index')->with('suggests', $this->suggestRepository->getAllWithPaginate());
    }

    public function changeStatus($id, $status){
      if ( $this->suggestRepository->changeStatus($id, $status)){
          Session::flash('success', @trans('message.success.suggest'));

          return redirect()->route('admin.category.index');
        }
      Session::flash('fail', @trans('message.fail.suggest'));

      return redirect()->route('admin.suggest');
    }
}
