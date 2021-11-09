<?php

namespace App\Services\MediaManager\Providers;

use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFMpeg;
use FFMpeg\Media\Video;

class VideoProvider
{
    private $imageProvider;

    /**
     * VideoProvider constructor.
     *
     * @param ImageProvider $imageProvider
     */
    public function __construct(ImageProvider $imageProvider)
    {
        $this->imageProvider = $imageProvider;
    }

    /**
     * @param string $path
     * @return Video
     */
    public function openVideo(string $path): Video
    {
        $ffmpeg = $this->createVideo();

        return $ffmpeg->open($path);
    }

    /**
     * @return FFMpeg
     */
    private function createVideo(): FFMpeg
    {
        return FFMpeg::create([
            'ffmpeg.binaries' => config('media-library.ffmpeg_path'),
            'ffprobe.binaries' => config('media-library.ffprobe_path'),
        ]);
    }

    /**
     * @param string $path
     * @param int $time
     * @return string
     */
    public function getFrame(string $path, int $time): string
    {
        return $this->openVideo($path)
            ->frame(TimeCode::fromSeconds($time))
            ->save('', false, true);
    }

    /**
     * @param string $file
     * @param int $width
     * @param int $height
     * @param int $time
     * @return string
     */
    public function createThumb(string $file, int $width, int $height, int $time = 1): string
    {
        $base64Frame = $this->getFrame($file, $time);
        $compressedBase64Frame = $this->imageProvider->imageCompression($base64Frame);

        return $this->imageProvider->createThumb($compressedBase64Frame, $width, $height);
    }
}
