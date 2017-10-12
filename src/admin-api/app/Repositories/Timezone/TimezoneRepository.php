<?php

namespace App\Repositories\Timezone;

use App\Models\Timezone;
use App\Repositories\DbRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TimezoneRepository extends DbRepository
{

    /**
     * @var Timezone
     */
    protected $model;

    public function __construct(Timezone $model, Collection $criteria = null, Request $request)
    {
        $this->model = $model;
        parent::__construct($criteria, $request);
    }
}