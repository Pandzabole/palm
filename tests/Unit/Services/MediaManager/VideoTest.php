<?php

namespace Tests\Unit\Services\MediaManager;

use App\Services\MediaManager\Video;
use App\Services\MediaManager\Providers\VideoProvider;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class VideoTest extends TestCase
{
    /** @var UploadedFile|MockObject  */
    private $fileMock;

    /** @var Video|MockObject  */
    private $videoMock;

    public function setUp(): void
    {
        parent::setUp();

        $this->fileMock = $this->createMock(UploadedFile::class);
        $this->videoMock = $this->createPartialMock(Video::class, ['setInfo', 'generateThumb', 'createThumb']);
    }

    /**
     * @test
     * @covers \App\Services\MediaManager\Video::createFromUploadedFile
     */
    public function it_creates_video_from_uploaded_file_with_thumb(): void
    {
        // assert
        $this->videoMock->expects(self::once())->method('setInfo');
        $this->videoMock->expects(self::once())->method('generateThumb');

        // act
        $result = $this->videoMock->createFromUploadedFile($this->fileMock);

        // assert
        self::assertEquals($this->videoMock, $result);
    }

    /**
     * @test
     * @covers \App\Services\MediaManager\Video::createFromUploadedFile
     */
    public function it_creates_video_from_uploaded_file_without_thumb(): void
    {
        // assert
        $this->videoMock->expects(self::once())->method('setInfo');
        $this->videoMock->expects(self::never())->method('generateThumb');

        // act
        $result = $this->videoMock->createFromUploadedFile($this->fileMock, false);

        // assert
        self::assertEquals($this->videoMock, $result);
    }

    /**
     * @test
     * @covers \App\Services\MediaManager\Video::createThumb
     */
    public function it_create_thumb_from_video_caption(): void
    {
        // arrange
        $providerMock = $this->createMock(VideoProvider::class);
        $fileMock = $this->createMock(UploadedFile::class);

        // assert
        $providerMock->expects(self::once())
            ->method('createThumb')
            ->with('', 1, 1)
            ->willReturn('');

        // act
        $video = new Video($providerMock);

        $video->setSource($fileMock);
        $video->setThumbWidth(1);
        $video->setThumbHeight(1);

        $result = $video->createThumb();

        // assert
        self::assertSame('', $result);
    }

    /**
     * @test
     */
    public function it_returns_video_array(): void
    {
        // arrange
        $videoMock = $this->createPartialMock(
            Video::class,
            [
                'getFilename',
                'getDirectory',
                'getMimeType',
                'getExtension',
                'getSize',
                'getThumbName',
            ]
        );

        // assert
        $videoMock->expects(self::once())->method('getFilename')->willReturn('');
        $videoMock->expects(self::once())->method('getDirectory')->willReturn('');
        $videoMock->expects(self::once())->method('getMimeType')->willReturn('');
        $videoMock->expects(self::once())->method('getExtension')->willReturn('');
        $videoMock->expects(self::once())->method('getSize')->willReturn(1);
        $videoMock->expects(self::once())->method('getThumbName')->willReturn('');

        // act
        $result = $videoMock->toArray();

        self::assertIsArray($result);
        self::assertArrayHasKey('file_name', $result);
        self::assertArrayHasKey('directory', $result);
        self::assertArrayHasKey('mime_type', $result);
        self::assertArrayHasKey('extension', $result);
        self::assertArrayHasKey('size', $result);
        self::assertArrayHasKey('thumb_name', $result);
    }
}
