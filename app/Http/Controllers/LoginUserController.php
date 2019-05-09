<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    public function postLogin(UserLoginRequest $request){
        $login = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($login)) {

            return redirect('index');
        } else {

            return redirect()->back()->with('status', @trans('message.fail.login'));
        }
    }
}
