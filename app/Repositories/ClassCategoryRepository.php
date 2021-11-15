<?php

namespace App\Repositories;

use App\Repositories\Contracts\ClassSubCategoryRepository as ClassSubCategoryRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class ClassCategoryRepository extends EloquentRepository implements ClassSubCategoryRepositoryInterface
{
}
