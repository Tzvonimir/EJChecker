<?php

namespace App\Repositories\AppConfiguration;

use App\Models\AppConfiguration;
use App\Repositories\DbRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AppConfigurationRepository extends DbRepository
{

    /**
     * @var AppConfiguration
     */
    protected $model;

    public function __construct(AppConfiguration $model, Collection $criteria = null, Request $request)
    {
        $this->model = $model;
        parent::__construct($criteria, $request);
    }
}