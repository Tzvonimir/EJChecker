<?php

namespace App\Http\Controllers;

use App\Http\Requests\Request;
use App\Repositories\User\UserRepository;

class UserController extends AppController
{

    /**
     * @var UserRepository
     */
    private $users;

    function __construct(UserRepository $users)
    {
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index()
    {
        $this->allowIf(['users/module', 'users/index']);
        return ['success' => true, 'users' => $this->users->getPaginated()];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return array
     */
    public function store(Request $request)
    {
        $this->allowIf(['users/module', 'users/store']);
        $user = $this->users->create($request->input());
        return ['success' => !!$user];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return array
     */
    public function show($id)
    {
        $this->allowIf(['users/module', 'users/show']);
        $user = $this->users->getById($id);
        return ['success' => true, 'user' => $user];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  int $id
     * @return array
     */
    public function update(Request $request, $id)
    {
        $this->allowIf(['users/module', 'users/update']);
        $result = $this->users->update($request->input(), $id);
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
        $this->allowIf(['users/module', 'users/destroy']);
        $result = $this->users->delete($id);
        return ['success' => !!$result];
    }

    /**
     * Returns default language for a logged in user.
     * TODO rewrite for language_id
     */
    public function default_language()
    {
        return ['success' => true, 'default_language' => 'hr'];
    }
}
