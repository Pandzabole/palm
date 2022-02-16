<?php

namespace App\Repositories;

use App\Repositories\Contracts\ReviewRepository as ReviewRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class ReviewRepository  extends EloquentRepository implements ReviewRepositoryInterface
{
}
