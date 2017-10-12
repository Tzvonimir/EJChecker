<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExtraNumber;
use App\Repositories\ExtraNumber\ExtraNumberRepository;

class ExtraNumberController extends AppController
{

    /**
     * @var ExtraNumberRepository
     */
    private $extraNumbers;

    function __construct(ExtraNumberRepository $extraNumbers)
    {
        $this->extraNumbers = $extraNumbers;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        // $this->allowIf(['extra_numbers/module', 'extra_numbers/index']);
        return ['success' => true, 'extra_numbers' => $this->extraNumbers->getPaginated(10)];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreExtraNumber $request
     * @return array
     */
    public function store(StoreExtraNumber $request)
    {
        $this->allowIf(['extra_numbers/module', 'extra_numbers/store']);
        $extraNumber = $this->extraNumbers->create($request->input());
        return ['success' => !!$extraNumber];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return array
     */
    public function show($id)
    {
        $this->allowIf(['extra_numbers/module', 'extra_numbers/show']);
        $extraNumber = $this->extraNumbers->getById($id);
        return ['success' => true, 'extra_number' => $extraNumber];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreNumber $request
     * @param  int $id
     * @return array
     */
    public function update(StoreExtraNumber $request, $id)
    {
        $this->allowIf(['extra_numbers/module', 'extra_numbers/update']);
        $result = $this->extraNumbers->update($request->input(), $id);
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
        $this->allowIf(['extra_numbers/module', 'extra_numbers/destroy']);
        $result = $this->extraNumbers->delete($id);
        return ['success' => !!$result];
    }

    /**
     * Get 2 random numbers from storage.
     *
     * @return array
     */
    public function getRandom()
    {
        return ['success' => true, 'numbers' => $this->extraNumbers->getRandom()];
    }
}
