<?php

namespace App\Repositories;

use App\Repositories\Contracts\MarketsRepository as MarketsRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;
use Illuminate\Support\Facades\DB;

class MarketsRepository extends EloquentRepository implements MarketsRepositoryInterface
{
}
