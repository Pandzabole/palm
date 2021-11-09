<?php

namespace App\Repositories;

use App\Repositories\Contracts\TextContentRepository as TextContentRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class TextContentRepository extends EloquentRepository implements TextContentRepositoryInterface
{
}
