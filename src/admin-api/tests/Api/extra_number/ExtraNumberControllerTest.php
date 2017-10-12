<?php

namespace Tests\Api;

use App\Models\ExtraNumber;
use Tests\TestCase;

class ExtraNumberControllerTest extends TestCase
{

    /** @test */
    public function should_get_paginated_extra_numbers()
    {
        $this->login();
        $structure = [
            'extra_numbers' => ['total', 'data'],
            'success'
        ];

        $this->jsonAuth('GET', '/api/extra_numbers')
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_get_paginated_extra_numbers_when_not_logged_in()
    {
        $this->json('GET', '/api/extra_numbers')
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_get_paginated_extra_numbers_with_search()
    {
        $this->login();
        $structure = [
            'extra_numbers' => ['total', 'data'],
            'success'
        ];

        $this->jsonAuth('GET', '/api/extra_numbers', ['search' => '2'])
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_search_extra_numbers_when_not_logged_in()
    {
        $this->json('GET', '/api/extra_numbers', ['search' => '2'])
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_not_save_extra_number_without_number()
    {
        $this->login();
        $extraNumber = factory(ExtraNumber::class)->make(['number' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/extra_numbers', $extraNumber)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_create_extra_number_with_all_data()
    {
        $this->login();
        $extraNumber = factory(ExtraNumber::class)->make()->getAttributes();
        $this->jsonAuth('POST', '/api/extra_numbers', $extraNumber)
            ->assertJsonFragment(['success' => true]);
        $this->assertDatabaseHas('extra_numbers', $extraNumber);
    }

    /** @test */
    public function should_not_create_extra_number_when_not_logged_in()
    {
        $extraNumber = factory(ExtraNumber::class)->make()->getAttributes();
        $this->json('POST', '/api/extra_numbers', $extraNumber)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);

        // $this->assertDatabaseMissing('extra_numbers', $extraNumber);
    }

    /** @test */
    public function should_get_extra_number_with_id()
    {
        $this->login();
        $extraNumber = factory(ExtraNumber::class)->create()->getAttributes();
        $url = '/api/extra_numbers/' . $extraNumber['id'];
        $structure = ['success', 'extra_number'];
        $this->jsonAuth('GET', $url)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_get_extra_number_when_not_logged_in()
    {
        $extraNumber = factory(ExtraNumber::class)->create()->getAttributes();
        $url = '/api/extra_numbers/' . $extraNumber['id'];
        $this->json('GET', $url)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_update_extra_number()
    {
        $this->login();

        $extraNumber = factory(ExtraNumber::class)->create();
        $id = $extraNumber->id;

        $newExtraNumber = factory(ExtraNumber::class)->make()->getAttributes();

        $url = '/api/extra_numbers/' . $id;
        $this->jsonAuth('PUT', $url, $newExtraNumber)
            ->assertJsonFragment(['success' => true]);

        $this->assertDatabaseHas('extra_numbers', $newExtraNumber);
    }

    /** @test */
    public function should_not_update_extra_number_when_not_logged_in()
    {
        $extraNumber = factory(ExtraNumber::class)->create();
        $id = $extraNumber->id;

        $newExtraNumber = factory(ExtraNumber::class)->make()->getAttributes();

        $url = '/api/extra_numbers/' . $id;
        $this->json('PUT', $url, $newExtraNumber)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);

        // $this->assertDatabaseMissing('extra_numbers', $newExtraNumber);
    }

    /** @test */
    public function should_delete_extra_number()
    {
        $this->login();
        $extraNumber = factory(ExtraNumber::class)->create()->getAttributes();
        $url = '/api/extra_numbers/' . $extraNumber['id'];

        $this->jsonAuth('DELETE', $url)
            ->assertJsonFragment(['success' => true]);
        $this->assertDatabaseMissing('extra_numbers', $extraNumber);
    }

    /** @test */
    public function should_not_delete_extra_number_when_not_logged_in()
    {
        $extraNumber = factory(ExtraNumber::class)->create()->getAttributes();
        $url = '/api/extra_numbers/' . $extraNumber['id'];
        $this->json('DELETE', $url)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }
}
