<?php

return [
    /*
     * FFMPEG & FFProbe binaries paths, only used if you try to generate video
     * thumbnails.
     */
    'ffmpeg_path' => env('FFMPEG_PATH', '/usr/bin/ffmpeg'),
    'ffprobe_path' => env('FFPROBE_PATH', '/usr/bin/ffprobe'),
];
