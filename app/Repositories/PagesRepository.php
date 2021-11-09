<?php

namespace App\Repositories;

use App\Repositories\Contracts\PagesRepository as PagesRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class PagesRepository extends EloquentRepository implements PagesRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getWithComponents($pageSlug, $components = null)
    {
        if ($components) {
            $relationships = is_array($components) ? $components : [$components];
            foreach ($relationships as $relationship) {
                abort_if(!array_key_exists($relationship, $this->model->morphRelationships), 404);
            }
        } else {
            $relationships = array_keys($this->model->morphRelationships);
        }

        return $this->findOneBy(['slug' => $pageSlug], $relationships);
    }
}
