<?php

namespace Unit\Services\MediaManager;

use App\Services\MediaManager\Validator;
use Illuminate\Http\UploadedFile;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideDataForValidator
     * @param array $data
     */
    public function it_returns_correct_file_type(array $data): void
    {
        // arrange
        $file = $this->createMock(UploadedFile::class);
        $file->expects(self::once())->method('getClientMimeType')->willReturn($data['mime_type']);

        // act
        $validator = new Validator();
        $result = $validator->checkType($file);

        // assert
        self::assertEquals($data['type'], $result);
    }

    /**
     * @return array
     */
    public function provideDataForValidator(): array
    {
        return [
            'provide_image_data' => [
                'data' => [
                    'mime_type' => 'image/jpeg',
                    'type' => 'image'
                ]
            ],
            'provide_video_data' => [
                'data' => [
                    'mime_type' => 'video/mp4',
                    'type' => 'video'
                ]
            ],
            'provide_other_data' => [
                'data' => [
                    'mime_type' => 'application/pdf',
                    'type' => null
                ]
            ],
        ];
    }
}
