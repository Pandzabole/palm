<?php

namespace App\Repositories\Contracts;

use App\Repositories\Infrastructure\BaseRepository;

interface PagesRepository extends BaseRepository
{
    /**
     * @param string $pageSlug
     * @param $components
     * @return mixed
     */
    public function getWithComponents(string $pageSlug, $components = null);
}
