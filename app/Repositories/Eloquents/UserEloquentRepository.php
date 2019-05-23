<?php

namespace App\Repositories\Eloquents;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface {

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return User::class;
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        if($request->has('newpassword')){
            $user->password = bcrypt($request->newpassword);
        }
        $user->save();

        return true;
    }
}
