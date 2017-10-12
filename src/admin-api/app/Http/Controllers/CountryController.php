<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountry;
use App\Repositories\Country\CountryRepository;

class CountryController extends AppController
{

    /**
     * @var CountryRepository
     */
    private $countries;

    function __construct(CountryRepository $countries)
    {
        $this->countries = $countries;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $this->allowIf(['countries/module', 'countries/index']);
        return ['success' => true, 'countries' => $this->countries->getPaginated()];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCountry $request
     * @return array
     */
    public function store(StoreCountry $request)
    {
        $this->allowIf(['countries/module', 'countries/store']);
        $country = $this->countries->create($request->input());
        return ['success' => !!$country];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return array
     */
    public function show($id)
    {
        $this->allowIf(['countries/module', 'countries/show']);
        $country = $this->countries->getById($id);
        return ['success' => true, 'country' => $country];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreCountry $request
     * @param  int $id
     * @return array
     */
    public function update(StoreCountry $request, $id)
    {
        $this->allowIf(['countries/module', 'countries/update']);
        $result = $this->countries->update($request->input(), $id);
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
        $this->allowIf(['countries/module', 'countries/destroy']);
        $result = $this->countries->delete($id);
        return ['success' => !!$result];
    }
}
