<?php

namespace Tests\Api;

use App\Models\Country;
use Tests\TestCase;

class CountryControllerTest extends TestCase
{

    /** @test */
    public function should_get_paginated_countries()
    {
        $this->login();
        $structure = [
            'countries' => ['total', 'data'],
            'success'
        ];

        $this->jsonAuth('GET', '/api/countries')
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_get_paginated_countries_when_not_logged_in()
    {
        $this->json('GET', '/api/countries')
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_get_paginated_countries_with_search()
    {
        $this->login();
        $structure = [
            'countries' => ['total', 'data'],
            'success'
        ];

        $this->jsonAuth('GET', '/api/countries', ['search' => 'a'])
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_search_countries_when_not_logged_in()
    {
        $this->json('GET', '/api/countries', ['search' => 'a'])
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_not_save_country_without_name()
    {
        $this->login();
        $country = factory(Country::class)->make(['name' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/countries', $country)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_not_save_country_without_iso()
    {
        $this->login();
        $country = factory(Country::class)->make(['iso' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/countries', $country)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_create_country_with_all_data()
    {
        $this->login();
        $country = factory(Country::class)->make()->getAttributes();
        $this->jsonAuth('POST', '/api/countries', $country)
            ->assertJsonFragment(['success' => true]);
        $this->assertDatabaseHas('countries', $country);
    }

    /** @test */
    public function should_not_create_country_when_not_logged_in()
    {
        $country = factory(Country::class)->make()->getAttributes();
        $this->json('POST', '/api/countries', $country)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);

        $this->assertDatabaseMissing('countries', $country);
    }

    /** @test */
    public function should_get_country_with_id()
    {
        $this->login();
        $country = factory(Country::class)->create()->getAttributes();
        $url = '/api/countries/' . $country['id'];
        $structure = ['success', 'country'];
        $this->jsonAuth('GET', $url)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_get_country_when_not_logged_in()
    {
        $country = factory(Country::class)->create()->getAttributes();
        $url = '/api/countries/' . $country['id'];
        $this->json('GET', $url)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_update_country()
    {
        $this->login();

        $country = factory(Country::class)->create();
        $id = $country->id;

        $newCountry = factory(Country::class)->make()->getAttributes();

        $url = '/api/countries/' . $id;
        $this->jsonAuth('PUT', $url, $newCountry)
            ->assertJsonFragment(['success' => true]);

        $this->assertDatabaseHas('countries', $newCountry);
    }

    /** @test */
    public function should_not_update_country_when_not_logged_in()
    {
        $country = factory(Country::class)->create();
        $id = $country->id;

        $newCountry = factory(Country::class)->make()->getAttributes();

        $url = '/api/countries/' . $id;
        $this->json('PUT', $url, $newCountry)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);

        $this->assertDatabaseMissing('countries', $newCountry);
    }

    /** @test */
    public function should_delete_country()
    {
        $this->login();
        $country = factory(Country::class)->create()->getAttributes();
        $url = '/api/countries/' . $country['id'];

        $this->jsonAuth('DELETE', $url)
            ->assertJsonFragment(['success' => true]);
        $this->assertDatabaseMissing('countries', $country);
    }

    /** @test */
    public function should_not_delete_country_when_not_logged_in()
    {
        $country = factory(Country::class)->create()->getAttributes();
        $url = '/api/countries/' . $country['id'];
        $this->json('DELETE', $url)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }
}
