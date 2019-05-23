<?php

namespace App\Repositories\Contracts;


interface ProductRepositoryInterface extends RepositoryInterface
{
    public function storeImage($request, $product, $check);

    public function trashed();

    public function kill($id);
}
