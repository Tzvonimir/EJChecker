<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppConfiguration;
use App\Repositories\AppConfiguration\AppConfigurationRepository;

class AppConfigurationController extends AppController
{
    /**
     * @var AppConfigurationRepository
     */
    private $appConfigurations;

    function __construct(AppConfigurationRepository $appConfigurations)
    {
        $this->appConfigurations = $appConfigurations;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $this->allowIf(['app_configurations/module', 'app_configurations/index']);
        return ['success' => true, 'app_configurations' => $this->appConfigurations->getPaginated()];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAppConfiguration $request
     * @return array
     */
    public function store(StoreAppConfiguration $request)
    {
        $this->allowIf(['app_configurations/module', 'app_configurations/store']);
        $appConfigurations = $this->appConfigurations->create($request->input());
        return ['success' => !!$appConfigurations];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return array
     */
    public function show($id)
    {
        $this->allowIf(['app_configurations/module', 'app_configurations/show']);
        $appConfigurations = $this->appConfigurations->getById($id);
        return ['success' => true, 'app_configuration' => $appConfigurations];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreAppConfiguration $request
     * @param  int $id
     * @return array
     */
    public function update(StoreAppConfiguration $request, $id)
    {
        $this->allowIf(['app_configurations/module', 'app_configurations/update']);
        $result = $this->appConfigurations->update($request->input(), $id);
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
        $this->allowIf(['app_configurations/module', 'app_configurations/destroy']);
        $result = $this->appConfigurations->delete($id);
        return ['success' => !!$result];
    }
}
