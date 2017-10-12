<?php
namespace App\Repositories\Currency;

use App\Models\Currency;
use App\Repositories\DbRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CurrencyRepository extends DbRepository
{

    /**
     * @var Currency
     */
    protected $model;

    public function __construct(Currency $model, Collection $criteria = null, Request $request)
    {
        $this->model = $model;
        parent::__construct($criteria, $request);
    }

}
