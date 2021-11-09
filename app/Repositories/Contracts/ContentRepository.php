<?php

namespace App\Repositories\Contracts;

use App\Models\Content\Content;
use App\Repositories\Infrastructure\BaseRepository;

interface ContentRepository extends BaseRepository
{
    /**
     * Delete content and decrement sortable fields
     *
     * @param Content $content
     * @param array $data
     */
    public function deleteContentWithSortable(Content $content, array $data);
}
