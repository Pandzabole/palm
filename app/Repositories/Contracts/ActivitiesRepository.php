<?php

namespace App\Repositories\Contracts;

use App\Repositories\Infrastructure\BaseRepository;

interface ActivitiesRepository extends BaseRepository
{
    /**
     * @param string|null $categorySlug
     * @param int|null $limit
     * @param bool|null $paginate
     * @param array $criteria
     * @param string $orderParam
     * @param string $orderType
     */
    public function findByCategorySlug(
        $categorySlug = null,
        $limit = 5,
        $paginate = false,
        array $criteria = [],
        string $orderParam = 'created_at',
        string $orderType = 'desc'
    );
}
