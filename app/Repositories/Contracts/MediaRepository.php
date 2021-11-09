<?php

namespace App\Repositories\Contracts;

use App\Models\Media;
use App\Repositories\Infrastructure\BaseRepository;
use Illuminate\Database\Eloquent\Model;

interface MediaRepository extends BaseRepository
{
    /**
     * @param Media $media
     * @param Model $resource
     * @return mixed
     */
    public function attachResource(Media $media, Model $resource);

    /**
     * @param Media $media
     * @param Model $resource
     * @return mixed
     */
    public function detachResource(Media $media, Model $resource);

    /**
     * @param Media $media
     * @param Model $resource
     * @param null $mediaId
     * @return mixed
     */
    public function updateResource(Media $media, Model $resource, $mediaId = null);

    /**
     * @return mixed
     */
    public function findVideos();

    /**
     * @return mixed
     */
    public function findImages();
}
