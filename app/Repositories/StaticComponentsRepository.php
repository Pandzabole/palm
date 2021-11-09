<?php

namespace App\Repositories;

use App\Repositories\Contracts\StaticComponentsRepository as StaticRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class StaticComponentsRepository extends EloquentRepository implements StaticRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findOneById(string $id)
    {
        return parent::findOneById($id)->childInstance();
    }

    /**
     * @inheritDoc
     */
    public function update($model, $data)
    {
        $model = parent::findOneById($model->id);

        return tap($model)->update($data);
    }
}
