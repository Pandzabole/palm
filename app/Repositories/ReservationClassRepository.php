<?php

namespace App\Repositories;

use App\Repositories\Contracts\ReservationClassRepository as ReservationClassRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class ReservationClassRepository extends EloquentRepository implements ReservationClassRepositoryInterface
{
}
