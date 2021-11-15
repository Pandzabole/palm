<?php

namespace App\Repositories;

use App\Repositories\Contracts\ClassesRepository as ClassesRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class ClassesRepository extends EloquentRepository implements ClassesRepositoryInterface
{
}
