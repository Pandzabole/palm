<?php

namespace Feature\Controllers\API;

use Tests\ContentTestCase;

class ContactControllerTest extends ContentTestCase
{
    /**
     * @test
     */
    public function it_can_not_send_contact_data_if_invalid_email(): void
    {
        // arrange
        $this->actingAsClient();
        $data = [
            'name' => 'Test Name',
            'email' => 'invalid email',
            'description' => 'Test description',
        ];

        // act
        $response = $this->getApiJsonResponse('contact', $data, 'POST');

        // assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('email');
    }

    /**
     * @test
     */
    public function it_can_not_send_contact_data_if_not_authenticated(): void
    {
        // arrange
        $data = [
            'name' => 'Test Name',
            'email' => 'test@gmail.com',
            'description' => 'Test description',
        ];

        // act
        $response = $this->getApiJsonResponse('contact', $data, 'POST');

        // assert
        $response->assertStatus(401);
    }
}
