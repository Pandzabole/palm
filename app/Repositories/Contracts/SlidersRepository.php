<?php

namespace App\Repositories\Contracts;

use App\Repositories\Infrastructure\BaseRepository;

interface SlidersRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    public function findFirst();
}
