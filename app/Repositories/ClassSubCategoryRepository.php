<?php

namespace App\Repositories;

use App\Repositories\Contracts\ClassSubCategoryRepository as ClassSubCategoryRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class ClassSubCategoryRepository extends EloquentRepository implements ClassSubCategoryRepositoryInterface
{
}
