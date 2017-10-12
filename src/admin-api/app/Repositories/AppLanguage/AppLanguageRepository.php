<?php

namespace App\Repositories\AppLanguage;

use App\Models\AppLanguage;
use App\Repositories\DbRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AppLanguageRepository extends DbRepository
{

    /**
     * @var AppLanguage
     */
    protected $model;

    public function __construct(AppLanguage $model, Collection $criteria = null, Request $request)
    {
        $this->model = $model;
        parent::__construct($criteria, $request);
    }
}