<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function updateProfile(Request $request);
}
