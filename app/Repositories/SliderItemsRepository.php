<?php

namespace App\Repositories;

use App\Repositories\Contracts\SliderItemsRepository as SliderItemsRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class SliderItemsRepository extends EloquentRepository implements SliderItemsRepositoryInterface
{
}
