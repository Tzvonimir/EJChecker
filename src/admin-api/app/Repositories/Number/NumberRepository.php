<?php
namespace App\Repositories\Number;

use App\Models\Number;
use App\Repositories\DbRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class NumberRepository extends DbRepository
{

    /**
     * @var Number
     */
    protected $model;

    public function __construct(Number $model, Collection $criteria = null, Request $request)
    {
        $this->model = $model;
        parent::__construct($criteria, $request);
    }

    public function getRandom() {
    	return $this->model->inRandomOrder()->limit(5)->get();
    }

}
