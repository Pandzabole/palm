<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

class MediaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Media::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws FileNotFoundException
     */
    public function definition(): array
    {
        Storage::fake();
        static $position = 0;

        $image = UploadedFile::fake()->image('photo1.jpg');
        $uid = $this->faker->uuid;
        $width = $this->faker->randomDigit;
        $extension = $image->guessClientExtension();

        $position++;

        return [
            'size' => $image->getSize(),
            'mime_type' => $image->getClientMimeType(),
            'extension' => $extension,
            'directory' => $uid,
            'file_name' => $uid,
            'thumb_name' => $uid . '-thumb.' . $extension,
            'file_blob' => base64_encode($image->get()),
            'config' => $position % 2 ? 'desktop' : 'mobile',
            'responsive_images' => [
                [
                    'width' => $width,
                    'height' => $this->faker->randomDigit,
                    'file_name' => $uid . '-' . $width . '.' . $extension,
                ]
            ]
        ];
    }

    /**
     * Indicate that the media is video.
     *
     * @param bool $test
     * @return MediaFactory
     */
    public function video($test = true): MediaFactory
    {
        if ($test) {
            Storage::fake();
        }

        $video = new UploadedFile(config('seeder.video_url'), 'name', 'video/mp4', 0, $test);

        $uid = $this->faker->uuid;
        $extension = $video->guessClientExtension();

        if (!$test) {
            $video->storeAs($uid, $uid . '.' . $extension, ['disk' => 'public']);
        }

        return $this->state([
            'size' => $video->getSize(),
            'mime_type' => $video->getClientMimeType(),
            'extension' => $extension,
            'directory' => $uid,
            'file_name' => $uid,
            'config' => 'video',
            'thumb_name' => $uid . '-thumb.' . $extension,
            'file_blob' => null,
            'responsive_images' => null,
        ]);
    }

    /**
     * Indicate that the media is desktop image.
     *
     * @param bool $test
     * @return MediaFactory
     */
    public function desktop($test = true): MediaFactory
    {
        return $this->getState('desktop', 'desktop', $test);
    }

    /**
     * Indicate that the media is mobile image.
     *
     * @param bool $test
     * @return MediaFactory
     */
    public function mobile($test = true): MediaFactory
    {
        return $this->getState('mobile', 'mobile', $test);
    }

    /**
     * @param string $config
     * @param $fileName
     * @param bool $test
     * @return MediaFactory
     */
    public function image(string $config = 'desktop', $fileName = 'desktop', $test = true): MediaFactory
    {
        return $this->getState($config, $fileName, $test);
    }

    /**
     * @param string $config
     * @param $fileName
     * @param bool $test
     * @return MediaFactory
     */
    private function getState(string $config, $fileName = null, bool $test = true): MediaFactory
    {
        $fileName = $fileName ?: $config;

        if ($test) {
            Storage::fake();
        }

        $image = new UploadedFile(config("seeder.$fileName"), $fileName, 'image/png', 0, $test);

        $uid = $this->faker->uuid;
        $extension = $image->guessClientExtension();
        $width = getimagesize($image)[0];

        $state = $this->state([
            'size' => $image->getSize(),
            'mime_type' => $image->getClientMimeType(),
            'extension' => $extension,
            'directory' => $uid,
            'file_name' => $uid,
            'thumb_name' => $uid . '-thumb.' . $extension,
            'file_blob' => base64_encode(''),
            'config' => $config,
            'responsive_images' => [
                [
                    'width' => $width,
                    'height' => $this->faker->randomDigit,
                    'file_name' => $uid . '-' . $width . '.' . $extension,
                ]
            ]
        ]);

        if (!$test) {
            $image->storeAs($uid, $uid . '.' . $extension, ['disk' => 'public']);
            $image->storeAs($uid, $uid . '-thumb.' . $extension, ['disk' => 'public']);
        }

        return $state;
    }
}
