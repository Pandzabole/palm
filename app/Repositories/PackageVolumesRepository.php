<?php

namespace App\Repositories;

use App\Models\PackageNumber;
use App\Repositories\Infrastructure\EloquentRepository;
use App\Repositories\Contracts\PackageVolumesRepository as PackageVolumeRepositoryInterface;

class PackageVolumesRepository extends EloquentRepository implements PackageVolumeRepositoryInterface
{
}
