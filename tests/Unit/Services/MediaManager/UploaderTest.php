<?php

namespace Unit\Services\MediaManager;

use App\Services\MediaManager\Image;
use App\Services\MediaManager\Uploader;
use App\Services\MediaManager\Video;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploaderTest extends TestCase
{
    /**
     * @test
     * @covers \App\Services\MediaManager\Uploader::saveOriginal
     */
    public function it_saves_original_image_on_disk(): void
    {
        // arrange
        $imageMock = $this->createMock(Image::class);
        $uploadedFileMock = $this->createMock(UploadedFile::class);

        // assert
        $imageMock->expects(self::once())->method('getSource')->willReturn($uploadedFileMock);
        $imageMock->expects(self::once())->method('getDirectory')->willReturn('');
        $imageMock->expects(self::once())->method('getOriginalFilename')->willReturn('');
        $uploadedFileMock->expects(self::once())->method('storePubliclyAs')->with('', '', ['disk' => 'public']);

        // act
        $uploader = new Uploader();
        $uploader->saveOriginal($imageMock);
    }

    /**
     * @test
     * @covers \App\Services\MediaManager\Uploader::saveOriginal
     */
    public function it_saves_original_video_on_disk(): void
    {
        // arrange
        $videoMock = $this->createMock(Video::class);
        $uploadedFileMock = $this->createMock(UploadedFile::class);

        // assert
        $videoMock->expects(self::once())->method('getSource')->willReturn($uploadedFileMock);
        $videoMock->expects(self::once())->method('getDirectory')->willReturn('');
        $videoMock->expects(self::once())->method('getOriginalFilename')->willReturn('');
        $uploadedFileMock->expects(self::once())->method('storePubliclyAs');

        // act
        $uploader = new Uploader();
        $uploader->saveOriginal($videoMock);
    }

    /**
     * @test
     * @covers \App\Services\MediaManager\Uploader::saveThumb
     */
    public function it_saves_thumb_from_original_image_on_disk(): void
    {
        // arrange
        $videoMock = $this->createMock(Video::class);

        // assert
        $videoMock->expects(self::once())->method('createThumb')->willReturn('');
        $videoMock->expects(self::once())->method('getDirectory')->willReturn('');
        $videoMock->expects(self::once())->method('getThumbName')->willReturn('');
        Storage::shouldReceive('disk')->with('public')->once()->andReturnSelf();
        Storage::shouldReceive('put')->once();

        // act
        $uploader = new Uploader();
        $uploader->saveThumb($videoMock);
    }

    /**
     * @test
     * @covers \App\Services\MediaManager\Uploader::saveResponsive
     * @dataProvider getResponsiveDetails
     * @param $responsiveDetails
     */
    public function it_saves_responsive_from_original_image_on_disk($responsiveDetails): void
    {
        // arrange
        $imageMock = $this->createMock(Image::class);
        $count = count($responsiveDetails);

        // assert
        $imageMock->expects(self::once())->method('getResponsiveDetails')->willReturn($responsiveDetails);
        $imageMock->expects(self::once())->method('getDirectory')->willReturn('');
        $imageMock->expects(self::exactly($count))->method('createResponsive')->willReturn('');
        Storage::shouldReceive('disk')->with('public')->times($count)->andReturnSelf();
        Storage::shouldReceive('put')->times($count);

        // act
        $uploader = new Uploader();
        $uploader->saveResponsive($imageMock);
    }

    /**
     * @return array
     */
    public function getResponsiveDetails(): array
    {
        return [
            'no_data' => [
                'data' => []
            ],
            'one_responsive' => [
                'data' => [
                    [
                        'width' => '1000',
                        'height' => '0',
                        'file_name' => ''
                    ]
                ]
            ],
            'more_than_one_responsive' => [
                'data' => [
                    [
                        'width' => '1000',
                        'height' => '0',
                        'file_name' => ''
                    ],
                    [
                        'width' => '800',
                        'height' => '0',
                        'file_name' => ''
                    ],
                    [
                        'width' => '600',
                        'height' => '0',
                        'file_name' => ''
                    ],
                ]
            ],
        ];
    }
}
