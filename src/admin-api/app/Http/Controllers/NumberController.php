<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNumber;
use App\Repositories\Number\NumberRepository;

class NumberController extends AppController
{

    /**
     * @var NumberRepository
     */
    private $numbers;

    function __construct(NumberRepository $numbers)
    {
        $this->numbers = $numbers;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        // $this->allowIf(['numbers/module', 'numbers/index']);
        return ['success' => true, 'numbers' => $this->numbers->getPaginated(50)];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreNumber $request
     * @return array
     */
    public function store(StoreNumber $request)
    {
        $this->allowIf(['numbers/module', 'numbers/store']);
        $number = $this->numbers->create($request->input());
        return ['success' => !!$number];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return array
     */
    public function show($id)
    {
        $this->allowIf(['numbers/module', 'numbers/show']);
        $number = $this->numbers->getById($id);
        return ['success' => true, 'number' => $number];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreNumber $request
     * @param  int $id
     * @return array
     */
    public function update(StoreNumber $request, $id)
    {
        $this->allowIf(['numbers/module', 'numbers/update']);
        $result = $this->numbers->update($request->input(), $id);
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
        $this->allowIf(['numbers/module', 'numbers/destroy']);
        $result = $this->numbers->delete($id);
        return ['success' => !!$result];
    }

    /**
     * Get 5 random numbers from storage.
     *
     * @return array
     */
    public function getRandom()
    {
        return ['success' => true, 'numbers' => $this->numbers->getRandom()];
    }
}
