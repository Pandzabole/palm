<?php

namespace App\Repositories\Contracts;

use App\Models\Language;
use App\Repositories\Infrastructure\BaseRepository;

interface LanguagesRepository extends BaseRepository
{
    /**
     * Get default language
     *
     * @param $code
     * @param bool $published
     * @return Language
     */
    public function findOrGetDefault($code, $published = true): Language;
}
