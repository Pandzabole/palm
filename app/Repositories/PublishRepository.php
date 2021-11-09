<?php

namespace App\Repositories;

use App\Repositories\Contracts\PublishRepository as PublishRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class PublishRepository extends EloquentRepository implements PublishRepositoryInterface
{
}
