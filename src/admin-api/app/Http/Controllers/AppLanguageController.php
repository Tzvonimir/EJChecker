<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppLanguage;
use App\Repositories\AppLanguage\AppLanguageRepository;

class AppLanguageController extends AppController
{
    /**
     * @var AppLanguageRepository
     */
    private $appLanguages;

    function __construct(AppLanguageRepository $appLanguages)
    {
        $this->appLanguages = $appLanguages;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $this->allowIf(['app_languages/module', 'app_languages/index']);
        return ['success' => true, 'app_languages' => $this->appLanguages->getPaginated()];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreAppLanguage $request
     * @return array
     */
    public function store(StoreAppLanguage $request)
    {
        $this->allowIf(['app_languages/module', 'app_languages/store']);
        $appLanguage = $this->appLanguages->create($request->input());
        return ['success' => !!$appLanguage];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return array
     */
    public function show($id)
    {
        $this->allowIf(['app_languages/module', 'app_languages/show']);
        $appLanguage = $this->appLanguages->getById($id);
        return ['success' => true, 'app_languages' => $appLanguage];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreAppLanguage $request
     * @param  int $id
     * @return array
     */
    public function update(StoreAppLanguage $request, $id)
    {
        $this->allowIf(['app_languages/module', 'app_languages/update']);
        $result = $this->appLanguages->update($request->input(), $id);
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
        $this->allowIf(['app_languages/module', 'app_languages/destroy']);
        $result = $this->appLanguages->delete($id);
        return ['success' => !!$result];
    }
}
