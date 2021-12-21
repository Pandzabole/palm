<?php

namespace App\Repositories;

use App\Repositories\Contracts\GendersRepository as GendersRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class GendersRepository extends EloquentRepository implements GendersRepositoryInterface
{
}
