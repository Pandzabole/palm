<?php

namespace App\Repositories;

use App\Repositories\Contracts\ActivitiesRepository as ActivitiesRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class ActivitiesRepository extends EloquentRepository implements ActivitiesRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function findByCategorySlug(
        $categorySlug = null,
        $limit = 5,
        $paginate = false,
        array $criteria = [],
        string $orderParam = 'created_at',
        string $orderType = 'desc'
    )
    {
        $query = $this->model;
        if (!empty($criteria)) {
            $query = $query->where(...$criteria);
        }
        $query = $query->orderBy($orderParam, $orderType);

        if ($categorySlug) {
            $query = $query->whereHas('categories', static function ($query) use ($categorySlug) {
                $query->where('activity_categories.slug', '=', $categorySlug);
            });
        }

        return $paginate ? $query->paginate($limit) : $query->get();
    }
}
