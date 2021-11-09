<?php

namespace App\Repositories\Contracts;

use App\Repositories\Infrastructure\BaseRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface NewsRepository extends BaseRepository
{
    /**
     * @throws ModelNotFoundException
     */
    public function findOneHighlighted();

    /**
     * @param string|null $categorySlug
     * @param int|null $limit
     * @param bool|null $paginate
     * @param string|null $criteria
     * @param string $orderParam
     * @param string $orderType
     */
    public function findByCategorySlug(
        $categorySlug = null,
        $limit = 5,
        $paginate = false,
        $criteria = '',
        string $orderParam = 'created_at',
        string $orderType = 'desc'
    );
}
