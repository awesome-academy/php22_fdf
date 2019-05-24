<?php

namespace App\Repositories\Contracts;

interface FeedbackRepositoryInterface extends RepositoryInterface
{
    public function calStar($product_id);
}
