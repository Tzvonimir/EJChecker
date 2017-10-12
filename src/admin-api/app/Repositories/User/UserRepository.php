<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\DbRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRepository extends DbRepository
{

    /*
     * @var User
     */
    protected $model;

    public function __construct(User $model, Collection $criteria = null, Request $request)
    {
        $this->model = $model;
        parent::__construct($criteria, $request);
    }

    public function create($data = [])
    {
    	if(isset($data['password'])) {
    		$data['password'] = Hash::make($data['password']);
    	}
        parent::create($data);
    }
}
