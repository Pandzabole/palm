<?php

namespace App\Repositories;

use App\Repositories\Contracts\ClassCategoryRepository as ClassCategoryRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class ClassSubCategoryRepository extends EloquentRepository implements ClassCategoryRepositoryInterface
{
}
