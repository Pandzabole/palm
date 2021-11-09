<?php

namespace App\Repositories;

use App\Repositories\Contracts\NewsCategoriesRepository as NewsCategoriesRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class NewsCategoriesRepository extends EloquentRepository implements NewsCategoriesRepositoryInterface
{
}
