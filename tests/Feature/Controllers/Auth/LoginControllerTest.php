<?php

namespace Feature\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\ContentTestCase;

class LoginControllerTest extends ContentTestCase
{
    /**
     * @param string|null $name
     * @param array $data
     * @param int|string $dataName
     *
     * @internal This method is not covered by the backward compatibility promise for PHPUnit
     */
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->withContent = false;
    }

    /**
     * @test
     */
    public function it_logs_in_successfully(): void
    {
        // arrange
        Auth::logout();
        $user = User::factory()->create();
        $data = [
            'email' => $user->email,
            'password' => 'password',
        ];

        // act
        $response = $this->post('/login', $data);

        // assert
        self::assertTrue(Auth::check());
        $response->assertRedirect(route('dashboard'));
    }

    /**
     * @test
     */
    public function it_fails_to_login_wrong_credentials(): void
    {
        // arrange
        Auth::logout();
        $user = User::factory()->create();
        $data = [
            'email' => $user->email,
            'password' => '',
        ];

        // act
        $response = $this->post('/login', $data);

        // assert
        self::assertFalse(Auth::check());
        $response->assertSessionHasErrors(['password']);
    }

    /**
     * @test
     */
    public function it_logs_out_and_redirects_successfully(): void
    {
        // act
        $response = $this->post('/logout');

        // assert
        self::assertFalse(Auth::check());
        $response->assertRedirect(route('home'));
    }

    /**
     * @test
     */
    public function it_access_admin_if_authenticated(): void
    {
        // act
        $this->withSession(['db_language' => $this->schemas['testing_content']]);
        $response = $this->get('/admin');

        // assert
        self::assertTrue(Auth::check());
        $response->assertSuccessful();
    }

    /**
     * @test
     */
    public function it_redirects_to_login_if_not_authenticated(): void
    {
        // arrange
        Auth::logout();

        // act
        $response = $this->get('/admin');

        // assert
        self::assertFalse(Auth::check());
        $response->assertRedirect(route('login'));
    }
}
