<?php

namespace App\Repositories\Criteria;

use App\Repositories\DbRepository as Repository;

abstract class Criteria
{
    public abstract function apply($model, Repository $repository);
}