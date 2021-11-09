<?php

namespace Unit\Services\MediaManager;

use App\Services\MediaManager\Image;
use App\Services\MediaManager\Providers\ImageProvider;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class ImageTest extends TestCase
{
    /** @var UploadedFile|MockObject */
    private $fileMock;

    /** @var Image|MockObject */
    private $imageMock;

    /** @var ImageProvider|MockObject */
    private $imageProviderMock;

    public function setUp(): void
    {
        parent::setUp();

        $this->fileMock = $this->createMock(UploadedFile::class);
        $this->imageProviderMock = $this->createMock(ImageProvider::class);
        $this->imageMock = $this->createPartialMock(
            Image::class,
            ['setInfo', 'generateResponsive', 'generateThumb', 'setImageType']
        );
    }

    /**
     * @test
     * @covers \App\Services\MediaManager\Image::createFromUploadedFile
     */
    public function it_creates_image_from_uploaded_file_with_image_type_thumb_and_with_responsive(): void
    {
        // assert
        $this->imageMock->expects(self::once())->method('setInfo');
        $this->imageMock->expects(self::once())->method('generateResponsive');
        $this->imageMock->expects(self::once())->method('generateThumb');
        $this->imageMock->expects(self::once())->method('setImageType');

        // act
        $result = $this->imageMock->createFromUploadedFile($this->fileMock, $imageType = "", true, true);

        // assert
        self::assertEquals($this->imageMock, $result);
    }

    /**
     * @test
     * @covers \App\Services\MediaManager\Image::createFromUploadedFile
     */
    public function it_creates_image_from_uploaded_file_with_image_type_responsive_image_and_without_thumb(): void
    {
        // assert
        $this->imageMock->expects(self::once())->method('setInfo');
        $this->imageMock->expects(self::once())->method('generateResponsive');
        $this->imageMock->expects(self::never())->method('generateThumb');
        $this->imageMock->expects(self::once())->method('setImageType');

        // act
        $result = $this->imageMock->createFromUploadedFile($this->fileMock, $imageType = "", true, false);

        // assert
        self::assertEquals($this->imageMock, $result);
    }

    /**
     * @test
     * @covers \App\Services\MediaManager\Image::createFromUploadedFile
     */
    public function it_creates_image_from_uploaded_file_width_image_type_without_responsive_and_with_thumb(): void
    {
        // assert
        $this->imageMock->expects(self::once())->method('setInfo');
        $this->imageMock->expects(self::never())->method('generateResponsive');
        $this->imageMock->expects(self::once())->method('generateThumb');
        $this->imageMock->expects(self::once())->method('setImageType');

        // act
        $result = $this->imageMock->createFromUploadedFile(
            $this->fileMock,
            $imageType = "",
            false,
            true
        );

        // assert
        self::assertEquals($this->imageMock, $result);
    }

    /**
     * @test
     * @covers \App\Services\MediaManager\Image::createFromUploadedFile
     */
    public function it_creates_image_from_uploaded_file_width_image_type_without_responsive_and_without_thumb(): void
    {
        // assert
        $this->imageMock->expects(self::once())->method('setInfo');
        $this->imageMock->expects(self::never())->method('generateResponsive');
        $this->imageMock->expects(self::never())->method('generateThumb');
        $this->imageMock->expects(self::once())->method('setImageType');

        // act
        $result = $this->imageMock->createFromUploadedFile(
            $this->fileMock,
            $imageType = "",
            false,
            false
        );

        // assert
        self::assertEquals($this->imageMock, $result);
    }

    /**
     * @test
     * @covers \App\Services\MediaManager\Image::createThumb
     * @throws FileNotFoundException
     */
    public function it_creates_thumb(): void
    {
        // assert
        $this->fileMock->expects(self::once())->method('get')->willReturn('');

        $this->imageProviderMock->expects(self::once())
            ->method('createThumb')
            ->with('', 1, 1)->willReturn('imageBlob');

        // arrange
        $image = new Image($this->imageProviderMock);

        $image->setSource($this->fileMock);
        $image->setThumbWidth(1);
        $image->setThumbHeight(1);

        // act
        $result = $image->createThumb();

        // assert
        self::assertSame('imageBlob', $result);
    }

    /**
     * @test
     * @covers \App\Services\MediaManager\Image::createResponsive
     * @throws FileNotFoundException
     */
    public function it_creates_responsive(): void
    {
        // assert
        $this->fileMock->expects(self::once())->method('get')->willReturn('');

        $this->imageProviderMock->expects(self::once())
            ->method('createResponsive')
            ->with('', 1, 1)->willReturn('imageBlob');

        // arrange
        $image = new Image($this->imageProviderMock);
        $image->setSource($this->fileMock);

        // act
        $result = $image->createResponsive(1, 1);

        // assert
        self::assertSame('imageBlob', $result);
    }

    /**
     * @test
     */
    public function it_returns_image_array(): void
    {
        // arrange
        $imageMock = $this->createPartialMock(
            Image::class,
            [
                'getFilename',
                'getDirectory',
                'getMimeType',
                'getExtension',
                'getSize',
                'getThumbName',
                'getResponsiveDetails',
                'getImageType',
            ]
        );

        // assert
        $imageMock->expects(self::once())->method('getFilename')->willReturn('');
        $imageMock->expects(self::once())->method('getDirectory')->willReturn('');
        $imageMock->expects(self::once())->method('getMimeType')->willReturn('');
        $imageMock->expects(self::once())->method('getExtension')->willReturn('');
        $imageMock->expects(self::once())->method('getSize')->willReturn(1);
        $imageMock->expects(self::once())->method('getThumbName')->willReturn('');
        $imageMock->expects(self::once())->method('getResponsiveDetails')->willReturn([]);
        $imageMock->expects(self::once())->method('getImageType')->willReturn('');


        // act
        $result = $imageMock->toArray();

        self::assertIsArray($result);
        self::assertArrayHasKey('file_name', $result);
        self::assertArrayHasKey('directory', $result);
        self::assertArrayHasKey('mime_type', $result);
        self::assertArrayHasKey('extension', $result);
        self::assertArrayHasKey('size', $result);
        self::assertArrayHasKey('thumb_name', $result);
        self::assertArrayHasKey('responsive_images', $result);
    }
}
