<?php

namespace App\Repositories;

use App\Repositories\Contracts\RichTextContentRepository as RichTextRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class RichTextContentRepository extends EloquentRepository implements RichTextRepositoryInterface
{
}
