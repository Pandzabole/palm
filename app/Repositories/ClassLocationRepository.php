<?php

namespace App\Repositories;

use App\Repositories\Contracts\ClassLocationRepository as ClassLocationRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class ClassLocationRepository extends EloquentRepository implements ClassLocationRepositoryInterface
{
}
