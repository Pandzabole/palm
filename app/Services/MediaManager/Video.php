<?php

namespace App\Services\MediaManager;

use App\Services\MediaManager\Providers\VideoProvider;
use Illuminate\Http\UploadedFile;

class Video extends Media
{
    /**
     * @var VideoProvider
     */
    private $videoProvider;

    public function __construct(VideoProvider $videoProvider)
    {
        parent::__construct();

        $this->videoProvider = $videoProvider;
    }

    /**
     * @param UploadedFile $file
     * @param bool $withThumb
     * @return Video
     */
    public function createFromUploadedFile(UploadedFile $file, bool $withThumb = true): Video
    {
        $this->setInfo($file);

        if ($withThumb) {
            $this->setWithThumb(true);
            $this->generateThumb();
        }

        return $this;
    }

    /**
     * @return void
     */
    protected function generateThumb(): void
    {
        $filename = $this->getFilename();

        $this->setThumbWidth(config('media.thumb.w'));
        $this->setThumbHeight(config('media.thumb.h'));
        $this->setThumbName($filename . '-thumb.jpg');
    }

    /**
     * @return string
     */
    public function createThumb(): string
    {
        $source = $this->getSource();
        $thumbWidth = $this->getThumbWidth();
        $thumbHeight = $this->getThumbHeight();

        return $this->videoProvider->createThumb($source, $thumbWidth, $thumbHeight);
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'file_name' => $this->getFilename(),
            'directory' => $this->getDirectory(),
            'mime_type' => $this->getMimeType(),
            'extension' => $this->getExtension(),
            'size' => $this->getSize(),
            'thumb_name' => $this->getThumbName()
        ];
    }
}
