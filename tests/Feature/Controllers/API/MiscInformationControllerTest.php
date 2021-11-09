<?php

namespace Feature\Controllers\API;

use App\Models\MiscInformation;
use Tests\ContentTestCase;

class MiscInformationControllerTest extends ContentTestCase
{
    /**
     * @test
     * @return void
     */
    public function it_returns_misc_information(): void
    {
        // arrange
        $quote = $this->prepareMiscInformation(MiscInformation::factory()->type('long-text')->create());
        $phones = $this->prepareMiscInformation(MiscInformation::factory()->count(3)->type('phone')->create());
        $emails = $this->prepareMiscInformation(MiscInformation::factory()->count(3)->type('email')->create());
        $socials = $this->prepareMiscInformation(MiscInformation::factory()->count(3)->type('external-link')->create());
        $addresses = $this->prepareMiscInformation(MiscInformation::factory()->count(3)->type('address')->create());

        $dataStructure = ['quote', 'phones', 'emails', 'socials', 'addresses'];
        $dataToAssert = [
            'quote' => $quote,
            'phones' => $phones,
            'emails' => $emails,
            'socials' => $socials,
            'addresses' => $addresses,
        ];

        // act
        $response = $this->getApiJsonResponse('misc-information');

        // assert
        $response->assertSuccessful();
        $response->assertJsonStructure($dataStructure);
        self::assertEquals($dataToAssert, $response->getData(true));
    }

    /**
     * @param $data
     * @return array
     */
    private function prepareMiscInformation($data): array
    {
        $preparedData = null;
        if ($data instanceof MiscInformation) {
            $preparedData = $this->prepareData($data);
        } else {
            $preparedData = $data->transform(
                function ($miscInformation) {
                    return $this->prepareData($miscInformation);
                }
            )->values()->toArray();
        }

        return $preparedData;
    }

    /**
     * @param $miscInformation
     * @return array
     */
    private function prepareData($miscInformation): array
    {
        return [
            'name' => $miscInformation->name,
            'slug' => $miscInformation->slug,
            'type' => $miscInformation->type,
            'value' => $miscInformation->value,
        ];
    }
}
