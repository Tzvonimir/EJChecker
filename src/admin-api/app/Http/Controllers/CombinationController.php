<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCombination;
use App\Repositories\Combination\CombinationRepository;
use App\Models\Combination;

class CombinationController extends AppController
{

    /**
     * @var CombinationRepository
     */
    private $combinations;

    function __construct(CombinationRepository $combinations)
    {
        $this->combinations = $combinations;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        // $this->allowIf(['combinations/module', 'combinations/index']);
        return ['success' => true, 'combinations' => $this->combinations->getPaginated()];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCombination $request
     * @return array
     */
    public function store(StoreCombination $request)
    {
        $this->allowIf(['combinations/module', 'combinations/store']);
        $combination = $this->combinations->create($request->input());
        return ['success' => !!$combination];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return array
     */
    public function show($id)
    {
        $this->allowIf(['combinations/module', 'combinations/show']);
        $combination = $this->combinations->getById($id);
        return ['success' => true, 'combination' => $combination];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreCombination $request
     * @param  int $id
     * @return array
     */
    public function update(StoreCombination $request, $id)
    {
        $this->allowIf(['combinations/module', 'combinations/update']);
        $result = $this->combinations->update($request->input(), $id);
        return ['success' => !!$result];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return array
     */
    public function destroy($id)
    {
        $this->allowIf(['combinations/module', 'combinations/destroy']);
        $result = $this->combinations->delete($id);
        return ['success' => !!$result];
    }

    /**
     * Display a listing of the winning resource.
     *
     * @return array
     */
    public function getWinningCombinations()
    {
        return ['success' => true, 'combinations' => $this->combinations->findAllBy('is_winning', 1)];
    }

    /**
     * Check database for count of combinations played.
     * Store a newly created resource in storage.
     *
     * @param  StoreCombination $request
     * @return array
     */
    public function checkCombination(StoreCombination $request)
    {
        try
        {
            $combinationCount = $this->combinations->checkCombination($request->input());

            if($combinationCount['success'])
            {
                $saveCombination = $this->combinations->create($request->input());
                $combinationCount['success'] = !!$saveCombination;
            }
            
            return $combinationCount;

        } catch(\Illuminate\Database\QueryException $ex) 
        { 
            return ['success' => false];
        }
    }

    /**
     * Display list of statistics.
     *
     * @return array
     */
    public function findStatistics() 
    {
        return $this->combinations->findByValue(1, 50);
    }
}
