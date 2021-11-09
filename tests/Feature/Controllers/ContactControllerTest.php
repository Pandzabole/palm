<?php

namespace Tests\Feature\Controllers;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Collection;
use Tests\ContentTestCase;

class ContactControllerTest extends ContentTestCase
{
    /**
     * @test
     */
    public function it_displays_contacts_view_on_index_page(): void
    {
        // act
        $response = $this->get(route('contacts.index'));

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.contacts.index');
    }

    /**
     * @test
     */
    public function it_shows_contacts_data_on_index(): void
    {
        // arrange
        $contacts = $this->seedContacts();

        // act
        $response = $this->json('get', route('contacts.data'));
        $data = $response->getData()->data;

        // assert
        $response->assertSuccessful();
        foreach ($contacts as $key => $contact) {
            self::assertEquals($contact->name, $data[$key]->name);
            self::assertEquals($contact->email, $data[$key]->email);
            self::assertEquals($contact->description, $data[$key]->description);
        }
    }

    /**
     * @test
     */
    public function it_can_not_display_contacts_on_index_page_if_user_is_not_logged_in(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('contacts.index'));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_displays_contacts_data_on_show_page(): void
    {
        // arrange
        $contacts = $this->seedContacts(5);
        $contact = $contacts->first();

        // act
        $response = $this->get(route('contacts.show', $contact->id));
        $data = $response->viewData('contact');

        // assert
        $response->assertSuccessful();
        $response->assertViewIs('admin.contacts.show');

        self::assertEquals($contact->toArray(), $data->toArray());
    }

    /**
     * @test
     */
    public function it_can_not_display_contact_on_show_page_if_user_is_not_logged_in(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->get(route('contacts.show', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * @test
     */
    public function it_can_not_displays_non_existing_contact_on_show_page(): void
    {
        // act
        $response = $this->get(route('contacts.show', 200));

        // assert
        $response->assertStatus(404);
    }


    /**
     * @test
     */
    public function it_deletes_contact(): void
    {
        // arrange
        $contacts = $this->seedContacts(5);
        $contact = $contacts->first();

        // act
        $response = $this->delete(route('contacts.destroy', $contact->id));

        // assert
        $this->assertDatabaseMissing('contacts', ['id' => $contact->id]);
        $response->assertRedirect(route('contacts.index'));
    }

    /**
     * @test
     */
    public function it_fails_to_delete_contact_no_authorization(): void
    {
        // arrange
        $this->logoutUser();

        // act
        $response = $this->delete(route('contacts.destroy', 1));

        // assert
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * It create contacts items
     *
     * @param int $count
     * @return Collection
     */
    private function seedContacts(int $count = 1): Collection
    {
        return Contact::factory()->count($count)->create();
    }
}
