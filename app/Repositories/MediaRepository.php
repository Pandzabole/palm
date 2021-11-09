<?php

namespace App\Repositories;

use App\Models\Media;
use App\Repositories\Contracts\MediaRepository as MediaRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;
use Illuminate\Database\Eloquent\Model;

class MediaRepository extends EloquentRepository implements MediaRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function attachResource(Media $media, Model $resource): void
    {
        $resource->media()->save($media);
    }

    /**
     * {@inheritDoc}
     */
    public function detachResource(Media $media, Model $resource): void
    {
        $resource->media()->detach($media);
    }

    /**
     * {@inheritDoc}
     */
    public function updateResource(Media $media, Model $resource, $mediaId = null): void
    {
        if ($mediaId) {
            $resource->media()->detach($mediaId);
        }
        $resource->media()->save($media);
    }

    /**
     * {@inheritDoc}
     */
    public function findVideos()
    {
        return $this->model->where('mime_type', 'like', 'video/%')->get();
    }

    /**
     * {@inheritDoc}
     */
    public function findImages()
    {
        return $this->model->where('mime_type', 'like', 'image/%')->get();
    }
}
