<?php

namespace App\Repositories\Contracts;

use App\Repositories\Infrastructure\BaseRepository;
use Illuminate\Database\Eloquent\Model;

interface StaticComponentsRepository extends BaseRepository
{
    /**
     * @param string $id
     */
    public function findOneById(string $id);

    /**
     * @param Model $model
     * @param array $data
     */
    public function update(Model $model, array $data);
}
