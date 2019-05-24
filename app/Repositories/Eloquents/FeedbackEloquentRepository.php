<?php

namespace App\Repositories\Eloquents;

use App\Models\FeedBack;
use App\Repositories\Contracts\FeedbackRepositoryInterface;


class FeedbackEloquentRepository extends EloquentRepository implements FeedbackRepositoryInterface {

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return FeedBack::class;
    }

    public function calStar($product_id)
    {
        return $this->_model->where('product_id', $product_id)->avg('rating');
    }

}
