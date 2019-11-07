<?php

namespace App\Repositories;

use App\Models\Model;

class AbstractBaseRepository {

    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function instance(): Model {
        return $this->model;
    }

    public function find($field, $value) {
        return $this->model->where($field, $value)->first();
    }

    public function findAll($field, $value) {
        return $this->model->where($field, $value)->get();
    }

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function update(Model $context, array $data) {
        return $context->update($data);
    }

    public function delete(Model $context) {
        return $context->delete();
    }

    public function deleteItems(array $items) {
        return $this->model->whereIn('uuid', $items)->delete();
    }

    public function deleteByField($field, $value) {
        return $this->model->where($field, $value)->delete();
    }
}
