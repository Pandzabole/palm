<?php

namespace App\Repositories;

use App\Models\PackageNumber;
use App\Repositories\Infrastructure\EloquentRepository;
use App\Repositories\Contracts\PackageNumbersRepository as PackageNumberRepositoryInterface;

class PackageNumbersRepository extends EloquentRepository implements PackageNumberRepositoryInterface
{
}
