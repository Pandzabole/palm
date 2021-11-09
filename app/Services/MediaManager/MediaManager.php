<?php

namespace App\Services\MediaManager;

use App\Models\Media as MediaModel;
use App\Repositories\Contracts\MediaRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class MediaManager
{
    /** @var Image $image */
    protected $image;

    /** @var Video $video */
    protected $video;

    /** @var Uploader $uploader */
    protected $uploader;

    /** @var Validator $validator */
    protected $validator;

    /** @var MediaRepository $mediaRepository */
    protected $mediaRepository;

    /**
     * MediaManager constructor.
     * @param Image $image
     * @param Video $video
     * @param Uploader $uploader
     * @param Validator $validator
     * @param MediaRepository $mediaRepository
     */
    public function __construct(
        Image $image,
        Video $video,
        Uploader $uploader,
        Validator $validator,
        MediaRepository $mediaRepository
    )
    {
        $this->image = $image;
        $this->video = $video;
        $this->uploader = $uploader;
        $this->validator = $validator;
        $this->mediaRepository = $mediaRepository;
    }

    /**
     * @param array $files
     * @param Model $model
     * @param array $existingMedia
     * @param string $imageType
     * @param bool $withResponsive
     * @param bool $withoutDetaching
     */
    public function uploadMedia(
        array $files,
        Model $model,
        array $existingMedia,
        string $imageType = "",
        bool $withoutDetaching = false,
        bool $withResponsive = false
    ): void
    {
        $newFiles = array_filter($files);
        $newMediaIds = [];

        if (!empty($newFiles)) {
            $newMediaIds = $this->uploadNewMedia($newFiles, $imageType, $withResponsive);
        }

        $mediaIds = array_filter(array_merge($newMediaIds, $existingMedia));

        if (!empty($mediaIds)) {
            $this->attachMedia($mediaIds, $model, $withoutDetaching);
        }
    }

    /**
     * @param $model
     * @param $files
     */
    public function uploadTypedMedia($model, $files): void
    {
        foreach ($files as $fileData) {
            $type = data_get($fileData, 'type');
            $file = data_get($fileData, 'file');
            $mediaId = data_get($fileData, 'existing_media');
            $media = null;

            if ($file) {
                $media = $this->uploadSingleFile($file, $type);
            }

            if ($mediaId) {
                $media = $this->mediaRepository->findOneById($mediaId);
            }

            if ($media) {
                $existingMediaId = optional($model->media()->type($type)->first())->id;
                $this->mediaRepository->updateResource($media, $model, $existingMediaId);
            }
        }
    }

    /**
     * @param array $mediaIds
     * @param Model $model
     * @param bool $withoutDetaching
     */
    public function attachMedia(array $mediaIds, Model $model, $withoutDetaching = false): void
    {
        if ($withoutDetaching) {
            $this->mediaRepository->syncWithoutDetaching($model, 'media', $mediaIds);
        } else {
            $this->mediaRepository->sync($model, 'media', $mediaIds);
        }
    }

    /**
     * @param array $files
     * @param string $imageType
     * @param bool $withResponsive
     * @return array
     */
    public function uploadNewMedia(array $files, string $imageType, bool $withResponsive = false): array
    {
        $mediaIds = [];
        foreach ($files as $file) {
            $mediaIds[] = $this->uploadSingleFile($file, $imageType, $withResponsive)->id;
        }

        return $mediaIds;
    }

    /**
     * @param $file
     * @param $imageType
     * @param bool $withResponsive
     * @return MediaModel|null
     */
    public function uploadSingleFile($file, $imageType, $withResponsive = false): ?MediaModel
    {
        $mediaInstance = $this->createMediaInstance($file, $imageType, $withResponsive);
        $media = null;

        if ($mediaInstance) {
            $this->uploader->upload($mediaInstance);
            $media = $this->mediaRepository->store($mediaInstance->toArray());
        }

        return $media;
    }

    /**
     * @param UploadedFile $file
     * @param string $imageType
     * @param bool $withResponsive
     * @return Media
     */
    public function createMediaInstance(UploadedFile $file, string $imageType = '', $withResponsive = false): ?Media
    {
        $media = null;
        $type = $this->validator->checkType($file);

        if ($type === 'image') {
            $media = $this->image->createFromUploadedFile($file, $imageType, $withResponsive);
        }

        if ($type === 'video') {
            $media = $this->video->createFromUploadedFile($file);
        }

        return $media;
    }
}
