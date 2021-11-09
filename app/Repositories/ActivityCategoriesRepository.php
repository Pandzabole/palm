<?php

namespace App\Repositories;

use App\Repositories\Contracts\ActivityCategoriesRepository as ActivityCategoriesRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class ActivityCategoriesRepository extends EloquentRepository implements ActivityCategoriesRepositoryInterface
{
}
