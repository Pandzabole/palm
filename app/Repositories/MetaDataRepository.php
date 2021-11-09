<?php

namespace App\Repositories;

use App\Repositories\Infrastructure\EloquentRepository;
use App\Repositories\Contracts\MetaDataRepository as MetaDataRepositoryInterface;

class MetaDataRepository extends EloquentRepository implements MetaDataRepositoryInterface
{
}
