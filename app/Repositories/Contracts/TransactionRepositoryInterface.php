<?php

namespace App\Repositories\Contracts;


interface TransactionRepositoryInterface extends RepositoryInterface
{
    public function changeStatus($id, $status);

    public function getCharts();

    public function createChart($data, $type, $title, $label);

    public function storeTransaction($id, $request, $oldCart);
}
