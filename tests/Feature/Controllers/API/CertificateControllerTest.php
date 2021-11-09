<?php

namespace Feature\Controllers\API;

use App\Models\Certificate;
use Tests\ContentTestCase;

class CertificateControllerTest extends ContentTestCase
{
    /**
     * @test
     * @return void
     */
    public function it_returns_certificates(): void
    {
        // arrange
        $dataToAssert = $this->prepareCertificatesToAssert(5);

        // act
        $response = $this->getApiJsonResponse('certificates');

        // assert
        self::assertEquals($dataToAssert, $response->getData(true));
        $response->assertSuccessful();
    }

    /**
     * @param int $count
     * @return array
     */
    private function prepareCertificatesToAssert($count = 1): array
    {
        $certificates = Certificate::factory()->count($count)->hasMedia()->create();

        return $certificates->transform(
            function ($certificate) {
                return [
                    'name' => $certificate->name,
                    'image' => $certificate->firstMediaUrl(),
                    'image_meta' => $certificate->firstMediaMeta()
                ];
            }
        )->toArray();
    }
}
