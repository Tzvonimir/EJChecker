<?php

namespace App\Repositories\Criteria\User;

use App\Models\AppModel;
use App\Repositories\Criteria\Criteria;
use App\Repositories\DbRepository as Repository;

class Active extends Criteria
{

    /**
     * @param AppModel $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        return $model->where('is_active', '=', 1);
    }
}