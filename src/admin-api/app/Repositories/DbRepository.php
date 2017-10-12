<?php

namespace App\Repositories;

use App\Models\AppModel;
use App\Repositories\Criteria\Criteria;
use App\Repositories\Criteria\CriteriaInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

abstract class DbRepository implements CriteriaInterface
{

    /**
     * @var AppModel
     */
    protected $model;

    /**
     * @var Request $request
     */
    protected $request;

    /**
     * @var Collection $criteria
     */
    protected $criteria;

    /**
     * @var bool $skipCriteria
     */
    protected $skipCriteria = false;

    public function __construct(Collection $criteria, Request $request)
    {
        $this->criteria = $criteria;
        $this->request = $request;
    }

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getAll($columns = ['*'])
    {
        $this->applyCriteria();
        return $this->model->all($columns);
    }

    public function applyCriteria()
    {
        if ($this->skipCriteria === true) {
            return $this;
        }

        foreach ($this->getCriteria() as $criteria) {
            if ($criteria instanceof Criteria) {
                $this->model = $criteria->apply($this->model, $this);
            }
        }

        return $this;
    }

    public function getCriteria()
    {
        return $this->criteria;
    }

    public function getPaginated($perPage = 25, $columns = ['*'])
    {
        $this->applyCriteria();
        $query = $this->model->query();
        $params = $this->request->input();

        /* search */
        if (isset($params['search']) && count($this->model->search) > 0) {
            $fields = $this->model->search;
            $search = '%' . $params['search'] . '%';
            foreach ($fields as $f) {
                $query->orWhere($f, 'LIKE', $search);
            }
        }

        /* sort */
        if(isset($params['sort'])) {
            $sorters = json_decode($params['sort'], true);
            foreach($sorters as &$sorter) {
                $query->orderBy($sorter['property'], $sorter['direction']);
            }
        }

        return $query->paginate($perPage, $columns);
    }

    public function create($data = [])
    {
        return $this->model->create($data);
    }

    public function update($data = [], $id, $attribute = 'id')
    {
        return $this->model
          ->where($attribute, '=', $id)
          ->first()
          ->fill($data)
          ->save();
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function find($id, $columns = ['*'])
    {
        $this->applyCriteria();
        return $this->model->find($id, $columns);
    }

    public function findBy($attribute, $value, $columns = ['*'])
    {
        $this->applyCriteria();
        return $this->model->where($attribute, '=', $value)->first($columns);
    }

    public function findAllBy($attribute, $value, $columns = ['*'])
    {
        $this->applyCriteria();
        return $this->model->where($attribute, '=', $value)->get();
    }

    public function resetScope()
    {
        $this->skipCriteria(false);
        return $this;
    }

    public function skipCriteria($status = true)
    {
        $this->skipCriteria = $status;
        return $this;
    }

    public function getByCriteria(Criteria $criteria)
    {
        $this->model = $criteria->apply($this->model, $this);
        return $this;
    }

    public function pushCriteria(Criteria $criteria)
    {
        $this->criteria->push($criteria);
        return $this;
    }
}
