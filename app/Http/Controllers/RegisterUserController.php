<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    public function postRegister(UserRegisterRequest $request){
        $user = User::create([
            'name' => $request->user_name,
            'email' => $request->user_email,
            'password' => bcrypt($request->password),
        ]);
        Auth::login($user);

        return redirect()->route('index');
    }
}
