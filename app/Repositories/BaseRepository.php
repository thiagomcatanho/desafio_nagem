<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;
    
    public function __construct(string $modelClass)
    {
        if (!class_exists($modelClass)) {
            throw new \Exception("Class {$modelClass} does not exist.");
        }

        $this->model = new $modelClass;

        if (!$this->model instanceof Model) {
            throw new \Exception("Class {$modelClass} must be an instance of " . Model::class);
        }
    }

    public function store($data): Model
    {
        return $this->model::create($data);
    }

    public function update($data, $id): bool
    {
        return $this->model::find($id)->update($data);
    }

    public function destroy($id): bool
    {
        return $this->model::find($id)->delete();
    }

    public function __call($method, $arguments)
    {
        if (method_exists($this->model, $method)) {
            return call_user_func_array([$this->model, $method], $arguments);
        }

        throw new \BadMethodCallException("Method {$method} does not exist on " . get_class($this->model));
    }
}
