<?php

namespace App\Http\Controllers;

use App\Models\Suggest;
use Illuminate\Http\Request;
use Session;

class SuggestController extends Controller
{
    public function index(){
        return view('admin.suggest.index')->with('suggests', Suggest::paginate(config('setting.default_value_page')));
    }

    public function changeStatus($id, $status){
        try {
            $suggest = Suggest::findOrFail($id);
            if ( $status == config('setting.default_value_0')){
                $suggest->status = config('setting.default_value_1');
            }else {
                $suggest->status = config('setting.default_value_0');
            }
            $suggest->save();
        } catch (\Exception $e){
            Session::flash('fail', @trans('message.fail.suggest'));

            return redirect()->route('admin.suggest');
        }
        Session::flash('success', @trans('message.success.suggest'));

        return redirect()->route('admin.suggest');
    }
}
