<?php
namespace App\Repositories\Country;

use App\Models\Country;
use App\Repositories\DbRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CountryRepository extends DbRepository
{

    /**
     * @var Country
     */
    protected $model;

    public function __construct(Country $model, Collection $criteria = null, Request $request)
    {
        $this->model = $model;
        parent::__construct($criteria, $request);
    }

}
