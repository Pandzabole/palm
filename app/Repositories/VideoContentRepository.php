<?php

namespace App\Repositories;

use App\Repositories\Contracts\VideoContentRepository as VideoContentRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class VideoContentRepository extends EloquentRepository implements VideoContentRepositoryInterface
{
}
