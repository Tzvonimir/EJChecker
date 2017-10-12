<?php
namespace App\Repositories\Media;

use App\Models\Media;
use App\Repositories\DbRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class MediaRepository extends DbRepository
{

    /**
     * @var MatterStatus
     */
    protected $model;

    public function __construct(Media $model, Collection $criteria = null, Request $request)
    {
        $this->model = $model;
        parent::__construct($criteria, $request);
    }

}
