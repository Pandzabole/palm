<?php

namespace App\Repositories;

use App\Repositories\Contracts\ImageContentRepository as ImageContentRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class ImageContentRepository extends EloquentRepository implements ImageContentRepositoryInterface
{
}
