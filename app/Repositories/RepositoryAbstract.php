<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Validator;
use Storage;

abstract class RepositoryAbstract implements RepositoryInterface
{
    /**
     * @var string Model name
     */
    protected $modelName;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var string Table name
     */
    protected $table;

    /**
     * Construct
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Get all.
     *
     * @return Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Store.
     *
     * @param array $data
     *
     * @return
     */
    public function store($data)
    {
        return $this->model->create($data);
    }

    /**
     * Show.
     *
     * @param int $id
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function show($id)
    {
        return $this->find($id);
    }

    /**
     * Update.
     *
     * @param int $id
     * @param array $data
     *
     * @return Model
     */
    public function update($id, $data)
    {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    /**
     * Delete.
     *
     * @param Collection|array|int $ids
     *
     * @return int
     */
    public function destroy($ids)
    {
        return $this->model->destroy($ids);
    }

    /**
     * Check exist.
     *
     * @param int $id
     *
     * @return boolean
     */
    public function exist($id)
    {
        return !empty($this->find($id));
    }
}