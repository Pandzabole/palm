<?php

namespace App\Repositories;

use App\Models\Language;
use App\Repositories\Contracts\LanguagesRepository as LanguagesRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LanguagesRepository extends EloquentRepository implements LanguagesRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function findOrGetDefault($code, $published = true): Language
    {
        try {
            $language = $this->findOneBy(['short' => $code, 'published' => $published]);
        } catch (ModelNotFoundException $exception) {
            $language = $this->findOneBy(['default' => true]);
        }

        return $language;
    }
}
