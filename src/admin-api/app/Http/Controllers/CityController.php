<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCity;
use App\Repositories\City\CityRepository;

class CityController extends AppController
{

    /**
     * @var CityRepository
     */
    private $cities;

    function __construct(CityRepository $cities)
    {
        $this->cities = $cities;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $this->allowIf(['cities/module', 'cities/index']);
        return ['success' => true, 'cities' => $this->cities->getPaginated()];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCity $request
     * @return array
     */
    public function store(StoreCity $request)
    {
        $this->allowIf(['cities/module', 'cities/store']);
        $city = $this->cities->create($request->input());
        return ['success' => !!$city];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return array
     */
    public function show($id)
    {
        $this->allowIf(['cities/module', 'cities/show']);
        $city = $this->cities->getById($id);
        return ['success' => true, 'contact' => $city];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreCity $request
     * @param int $id
     * @return array
     */
    public function update(StoreCity $request, $id)
    {
        $this->allowIf(['cities/module', 'cities/update']);
        $result = $this->cities->update($request->input(), $id);
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
        $this->allowIf(['cities/module', 'cities/destroy']);
        $result = $this->cities->delete($id);
        return ['success' => !!$result];
    }
}
