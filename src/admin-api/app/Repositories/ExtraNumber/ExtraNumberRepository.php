<?php
namespace App\Repositories\ExtraNumber;

use App\Models\ExtraNumber;
use App\Repositories\DbRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ExtraNumberRepository extends DbRepository
{

    /**
     * @var Number
     */
    protected $model;

    public function __construct(ExtraNumber $model, Collection $criteria = null, Request $request)
    {
        $this->model = $model;
        parent::__construct($criteria, $request);
    }

    public function getRandom() {
    	return $this->model->inRandomOrder()->limit(2)->get();
    }

}
