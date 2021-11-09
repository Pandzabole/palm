<?php

namespace App\Repositories;

use App\Repositories\Contracts\MiscInformationRepository as MiscInformationRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class MiscInformationRepository extends EloquentRepository implements MiscInformationRepositoryInterface
{
}
