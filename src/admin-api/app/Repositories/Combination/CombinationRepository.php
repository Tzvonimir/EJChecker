<?php
namespace App\Repositories\Combination;

use Carbon\Carbon;
use App\Models\Combination;
use Illuminate\Http\Request;
use App\Repositories\DbRepository;
use Illuminate\Database\Eloquent\Collection;

class CombinationRepository extends DbRepository
{

    /**
     * @var Combination
     */
    protected $model;

    public function __construct(Combination $model, Collection $criteria = null, Request $request)
    {
        $this->model = $model;
        parent::__construct($criteria, $request);
    }

    public function findByValue($start, $to) 
    {
        try
        {
          for ($i=$start; $i <= $to; $i++) { 
              $statisticChecker = $this->model
              					  ->where('first_number', '=', $i)
                                  ->orWhere('second_number', '=', $i)
                                  ->orWhere('third_number', '=', $i)
                                  ->orWhere('fourth_number', '=', $i)
                                  ->orWhere('fifth_number', '=', $i)
                                  ->count();
              $statistic[$i]['count'] = $statisticChecker;
              $statistic[$i]['number'] = $i;
          }
          rsort($statistic);

          return ['success' => true, 'statistics' => $statistic];
        } catch(\Illuminate\Database\QueryException $ex) 
        { 
            return ['success' => false];
        }
    }

    public function checkCombination($data) 
    {
        try
        {
            $combinationCount = $this->model
            	->where(function($q) use ($data) {
                  $q->where('first_number', '=', $data['first_number']);
                  $q->orWhere('second_number', '=', $data['first_number']);
                  $q->orWhere('third_number', '=', $data['first_number']);
                  $q->orWhere('fourth_number', '=', $data['first_number']);
                  $q->orWhere('fifth_number', '=', $data['first_number']);
                })
                ->where(function($q) use ($data) {
                  $q->where('first_number', '=', $data['second_number']);
                  $q->orWhere('second_number', '=', $data['second_number']);
                  $q->orWhere('third_number', '=', $data['second_number']);
                  $q->orWhere('fourth_number', '=', $data['second_number']);
                  $q->orWhere('fifth_number', '=', $data['second_number']);
                })
                ->where(function($q) use ($data) {
                  $q->where('first_number', '=', $data['third_number']);
                  $q->orWhere('second_number', '=', $data['third_number']);
                  $q->orWhere('third_number', '=', $data['third_number']);
                  $q->orWhere('fourth_number', '=', $data['third_number']);
                  $q->orWhere('fifth_number', '=', $data['third_number']);
                })
                ->where(function($q) use ($data) {
                  $q->where('first_number', '=', $data['fourth_number']);
                  $q->orWhere('second_number', '=', $data['fourth_number']);
                  $q->orWhere('third_number', '=', $data['fourth_number']);
                  $q->orWhere('fourth_number', '=', $data['fourth_number']);
                  $q->orWhere('fifth_number', '=', $data['fourth_number']);
                })
                ->where(function($q) use ($data) {
                  $q->where('first_number', '=', $data['fifth_number']);
                  $q->orWhere('second_number', '=', $data['fifth_number']);
                  $q->orWhere('third_number', '=', $data['fifth_number']);
                  $q->orWhere('fourth_number', '=', $data['fifth_number']);
                  $q->orWhere('fifth_number', '=', $data['fifth_number']);
                })
                ->where(function($q) use ($data) {
                  $q->where('first_extra_number', '=', $data['first_extra_number']);
                  $q->orWhere('second_extra_number', '=', $data['first_extra_number']);
                })
                ->where(function($q) use ($data) {
                  $q->where('first_extra_number', '=', $data['second_extra_number']);
                  $q->orWhere('second_extra_number', '=', $data['second_extra_number']);
                })
                ->count();

                $currentCombinationCount = $this->model
                	->where(function($q) use ($data) {
                      $q->where('first_number', '=', $data['first_number']);
                      $q->orWhere('second_number', '=', $data['first_number']);
                      $q->orWhere('third_number', '=', $data['first_number']);
                      $q->orWhere('fourth_number', '=', $data['first_number']);
                      $q->orWhere('fifth_number', '=', $data['first_number']);
                    })
                    ->where(function($q) use ($data) {
                      $q->where('first_number', '=', $data['second_number']);
                      $q->orWhere('second_number', '=', $data['second_number']);
                      $q->orWhere('third_number', '=', $data['second_number']);
                      $q->orWhere('fourth_number', '=', $data['second_number']);
                      $q->orWhere('fifth_number', '=', $data['second_number']);
                    })
                    ->where(function($q) use ($data) {
                      $q->where('first_number', '=', $data['third_number']);
                      $q->orWhere('second_number', '=', $data['third_number']);
                      $q->orWhere('third_number', '=', $data['third_number']);
                      $q->orWhere('fourth_number', '=', $data['third_number']);
                      $q->orWhere('fifth_number', '=', $data['third_number']);
                    })
                    ->where(function($q) use ($data) {
                      $q->where('first_number', '=', $data['fourth_number']);
                      $q->orWhere('second_number', '=', $data['fourth_number']);
                      $q->orWhere('third_number', '=', $data['fourth_number']);
                      $q->orWhere('fourth_number', '=', $data['fourth_number']);
                      $q->orWhere('fifth_number', '=', $data['fourth_number']);
                    })
                    ->where(function($q) use ($data) {
                      $q->where('first_number', '=', $data['fifth_number']);
                      $q->orWhere('second_number', '=', $data['fifth_number']);
                      $q->orWhere('third_number', '=', $data['fifth_number']);
                      $q->orWhere('fourth_number', '=', $data['fifth_number']);
                      $q->orWhere('fifth_number', '=', $data['fifth_number']);
                    })
                    ->where(function($q) use ($data) {
                      $q->where('first_extra_number', '=', $data['first_extra_number']);
                      $q->orWhere('second_extra_number', '=', $data['first_extra_number']);
                    })
                    ->where(function($q) use ($data) {
                      $q->where('first_extra_number', '=', $data['second_extra_number']);
                      $q->orWhere('second_extra_number', '=', $data['second_extra_number']);
                    })
                    ->whereDate('created_at', '>=', new Carbon('last friday', 'Europe/Zagreb'))
                    ->count();

            $listOfNumbers = array($data['first_number'], $data['second_number'], $data['third_number'], $data['fourth_number'], $data['fifth_number']);
               
            $existingCombinations = $this->model
                ->where(function($q) use ($listOfNumbers) {
                  $q->where(function($q) use ($listOfNumbers) {
                    $q->whereIn('first_number', $listOfNumbers);
                    $q->where(function($q) use ($listOfNumbers) {
                      $q->whereIn('second_number', $listOfNumbers);
                      $q->orWhereIn('third_number', $listOfNumbers);
                      $q->orWhereIn('fourth_number', $listOfNumbers);
                      $q->orWhereIn('fifth_number', $listOfNumbers);
                    });
                  });
                  $q->orWhere(function($q) use ($listOfNumbers) {
                    $q->whereIn('second_number', $listOfNumbers);
                    $q->where(function($q) use ($listOfNumbers) {
                      $q->whereIn('third_number', $listOfNumbers);
                      $q->orWhereIn('fourth_number', $listOfNumbers);
                      $q->orWhereIn('fifth_number', $listOfNumbers);
                    });
                  });
                  $q->orWhere(function($q) use ($listOfNumbers) {
                    $q->whereIn('third_number', $listOfNumbers);
                    $q->where(function($q) use ($listOfNumbers) {
                      $q->whereIn('fourth_number', $listOfNumbers);
                      $q->orWhereIn('fifth_number', $listOfNumbers);
                    });
                  });
                  $q->orWhere(function($q) use ($listOfNumbers) {
                    $q->whereIn('fourth_number', $listOfNumbers);
                    $q->whereIn('fifth_number', $listOfNumbers);
                  });
                })
                ->whereDate('created_at', '>=', new Carbon('last friday', 'Europe/Zagreb'))
                ->limit(5)
                ->get();
                
            return [
              'success' => true,
              'combination_count' => $combinationCount,
              'current_combination_count' => $currentCombinationCount,
              'existing_combinations' => $existingCombinations
            ];
        } catch(\Illuminate\Database\QueryException $ex)
        {
            return ['success' => false];
        }
    }

}
