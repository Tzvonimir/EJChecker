<?php

namespace App\Repositories\City;

use App\Models\City;
use App\Repositories\City\CityRepositoryInterface;
use App\Repositories\DbRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CityRepository extends DbRepository
{

    /*
     * @var City
     */
    protected $model;

    public function __construct(City $model, Collection $criteria = null, Request $request)
    {
        $this->model = $model;
        parent::__construct($criteria, $request);
    }
}
