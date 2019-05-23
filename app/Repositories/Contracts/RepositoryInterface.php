<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function getAll();

    public function getAllWithPaginate();

    public function getById($id);

    public function getBySlug($slug);

    public function where($col, $condition);

    public function whereAdvanced($col, $operation, $condition );

    public function getOrderBy($col, $type);

    public function count();

    public function create(array $attribute);

    public function update($id, array $attribute);

    public function delete($id);
}
