<?php

namespace App\Repositories;

use App\Repositories\Contracts\ProductsRepository as ProductsRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class ProductsRepository extends EloquentRepository implements ProductsRepositoryInterface
{
}
