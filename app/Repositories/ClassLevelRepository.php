<?php

namespace App\Repositories;

use App\Repositories\Contracts\ClassLevelRepository as ClassLevelRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class ClassLevelRepository extends EloquentRepository implements ClassLevelRepositoryInterface
{

}
