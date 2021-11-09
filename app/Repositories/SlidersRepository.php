<?php

namespace App\Repositories;

use App\Repositories\Contracts\SlidersRepository as SlidersRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class SlidersRepository extends EloquentRepository implements SlidersRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findFirst()
    {
        return $this->model->firstOrFail();
    }
}
