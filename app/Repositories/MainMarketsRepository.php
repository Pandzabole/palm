<?php

namespace App\Repositories;

use App\Repositories\Contracts\MainMarketsRepository as MainMarketsRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class MainMarketsRepository extends EloquentRepository implements MainMarketsRepositoryInterface
{
}
