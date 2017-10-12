<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTimezone;
use App\Repositories\Timezone\TimezoneRepository;

class TimezoneController extends AppController
{

    /**
     * @var TimezoneRepository
     */
    private $timezones;

    function __construct(TimezoneRepository $timezones)
    {
        $this->timezones = $timezones;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $this->allowIf(['timezones/module', 'timezones/index']);
        return ['success' => true, 'timezones' => $this->timezones->getPaginated()];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TimezoneRepository $request
     * @return array
     */
    public function store(StoreTimezone $request)
    {
        $this->allowIf(['timezones/module', 'timezones/store']);
        $timezone = $this->timezones->create($request->input());
        return ['success' => !!$timezone];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return array
     */
    public function show($id)
    {
        $this->allowIf(['timezones/module', 'timezones/show']);
        $timezone = $this->timezones->getById($id);
        return ['success' => true, 'timezone' => $timezone];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TimezoneRepository $request
     * @param  int $id
     * @return array
     */
    public function update(StoreTimezone $request, $id)
    {
        $this->allowIf(['timezones/module', 'timezones/update']);
        $result = $this->timezones->update($request->input(), $id);
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
        $this->allowIf(['timezones/module', 'timezones/destroy']);
        $result = $this->timezones->delete($id);
        return ['success' => !!$result];
    }
}
