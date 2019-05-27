<?php

namespace App\Repositories\Eloquents;

use App\Models\Suggest;
use App\Repositories\Contracts\SuggestRepositoryInterface;

class SuggestEloquentRepository extends EloquentRepository implements SuggestRepositoryInterface {

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Suggest::class;
    }

    public function countSuggest()
    {
        $count = $this->whereAdvanced('status', '>', 0)->count();

        return $count;
    }

    public function changeStatus($id, $status)
    {

        $suggest = $this->getById($id);
        if ( $status == config('setting.default_value_0')){
            $suggest->status = config('setting.default_value_1');
        }else {
            $suggest->status = config('setting.default_value_0');
        }
        $suggest->save();

        return true;
    }
}
