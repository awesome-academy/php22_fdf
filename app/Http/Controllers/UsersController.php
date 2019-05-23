<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Http\Requests\NewUserRequest;
use App\Http\Requests\ProfileUserRequest;
use Session;

class UsersController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
       $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getAllWithPaginate();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewUserRequest $request)
    {
        $attribute = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'address' => '',
            'phone' => '',
            'is_admin' => true,
        ];
        $users = $this->userRepository->create($attribute);

        Session::flash('success', @trans('message.success.user.create_user'));

        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = $this->userRepository->getById($id);
            $transactions = $user->transactions;
        } catch (\Exception $e) {

            return redirect()->route('admin.user.index');
        }

        return view('admin.users.detail')->with('transactions', $transactions)
                                               ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $user = $this->userRepository->getById($id);
        } catch (\Exception $e) {

            return redirect()->route('admin.user.index');
        }

        return view('admin.users.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUserRequest $request)
    {
        if( $user = $this->userRepository->updateProfile($request)){
            Session::flash('success', @trans('message.success.user.update_user'));
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if( $user = $this->userRepository->delete($id)){
            Session::flash('success', @trans('message.success.user.delete_user'));

            return redirect()->route('admin.user.index');
        }

        return redirect()->route('users');
    }
}
