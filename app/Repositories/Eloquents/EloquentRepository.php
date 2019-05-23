<?php

namespace App\Repositories\Eloquents;

use App\Repositories\Contracts\RepositoryInterface;

abstract class EloquentRepository implements RepositoryInterface {

    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $_model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {

        return $this->_model->all();
    }

    public function getAllWithPaginate()
    {

        return $this->_model->paginate(config('setting.default_value_page'));
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $result = $this->_model->find($id);

        return $result;
    }

    public function getBySlug($slug)
    {
        $result = $this->_model->where('slug', $slug)->first();

        return $result;
    }

    public function where($col, $condition)
    {
        $result = $this->_model->where($col, $condition)->get();

        return $result;
    }

    public function whereAdvanced($col, $operation, $condition )
    {
        $result = $this->_model->where($col, $operation, $condition)->get();

        return $result;
    }

    public function getOrderBy($col, $type)
    {
        $result = $this->_model->orderBy($col, $type)->get();

        return $result;
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {

        return $this->_model->create($attributes);
    }

    public function count()
    {

        return $this->_model->all()->count();
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->getById($id);
        if ($result) {
            $result->update($attributes);

            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->getById($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}
