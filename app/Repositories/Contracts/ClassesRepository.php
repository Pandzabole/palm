<?php

namespace App\Repositories\Contracts;

use App\Repositories\Infrastructure\BaseRepository;

interface ClassesRepository extends BaseRepository
{
    /**
     * @param string $request
     * @return mixed
     */
    public function searchData(
        string $request
    );
}
