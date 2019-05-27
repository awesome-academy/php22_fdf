<?php

namespace App\Repositories\Contracts;

interface SuggestRepositoryInterface extends RepositoryInterface
{
    public function changeStatus($id, $status);

    public function countSuggest();
}
