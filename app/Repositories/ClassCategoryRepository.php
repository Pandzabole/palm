<?php

namespace App\Repositories;

use App\Repositories\Contracts\ClassCategoryRepository as ClassCategoryRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class ClassCategoryRepository extends EloquentRepository implements ClassCategoryRepositoryInterface
{
}
