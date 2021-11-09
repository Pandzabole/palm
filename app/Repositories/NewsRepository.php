<?php

namespace App\Repositories;

use App\Models\News;
use App\Repositories\Contracts\NewsRepository as NewsRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;
use Illuminate\Database\Eloquent\Builder;

class NewsRepository extends EloquentRepository implements NewsRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findOneHighlighted(): ?News
    {
        return $this->findOneBy(['highlighted' => true]);
    }

    /**
     *
     * {@inheritDoc}
     */
    public function findByCategorySlug(
        $categorySlug = null,
        $limit = 5,
        $paginate = false,
        $criteria = '',
        string $orderParam = 'created_at',
        string $orderType = 'desc'
    ) {
        $query = $this->model;
        if ($criteria) {
            /** @var Builder $query */
            $query = $query->where('description', 'like', "%$criteria%")->orWhere('title', 'like', "%$criteria%");
        }

        $query = $query->orderBy($orderParam, $orderType);

        if ($categorySlug) {
            $query = $query->whereHas(
                'categories',
                static function ($query) use ($categorySlug) {
                    $query->where('news_categories.slug', '=', $categorySlug);
                }
            );
        }

        return $paginate ? $query->paginate($limit) : $query->get();
    }
}
