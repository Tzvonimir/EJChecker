<?php

namespace Tests\Api;

use App\Models\Number;
use Tests\TestCase;

class NumberControllerTest extends TestCase
{

    /** @test */
    public function should_get_paginated_numbers()
    {
        $this->login();
        $structure = [
            'numbers' => ['total', 'data'],
            'success'
        ];

        $this->jsonAuth('GET', '/api/numbers')
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_get_paginated_numbers_when_not_logged_in()
    {
        $this->json('GET', '/api/numbers')
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_get_paginated_numbers_with_search()
    {
        $this->login();
        $structure = [
            'numbers' => ['total', 'data'],
            'success'
        ];

        $this->jsonAuth('GET', '/api/numbers', ['search' => '2'])
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_search_numbers_when_not_logged_in()
    {
        $this->json('GET', '/api/numbers', ['search' => '2'])
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_not_save_number_without_number()
    {
        $this->login();
        $number = factory(Number::class)->make(['number' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/numbers', $number)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_create_number_with_all_data()
    {
        $this->login();
        $number = factory(Number::class)->make()->getAttributes();
        $this->jsonAuth('POST', '/api/numbers', $number)
            ->assertJsonFragment(['success' => true]);
        $this->assertDatabaseHas('numbers', $number);
    }

    /** @test */
    public function should_not_create_number_when_not_logged_in()
    {
        $number = factory(Number::class)->make()->getAttributes();
        $this->json('POST', '/api/numbers', $number)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);

        // $this->assertDatabaseMissing('numbers', $number);
    }

    /** @test */
    public function should_get_number_with_id()
    {
        $this->login();
        $number = factory(Number::class)->create()->getAttributes();
        $url = '/api/numbers/' . $number['id'];
        $structure = ['success', 'number'];
        $this->jsonAuth('GET', $url)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_get_number_when_not_logged_in()
    {
        $number = factory(Number::class)->create()->getAttributes();
        $url = '/api/numbers/' . $number['id'];
        $this->json('GET', $url)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_update_number()
    {
        $this->login();

        $number = factory(Number::class)->create();
        $id = $number->id;

        $newNumber = factory(Number::class)->make()->getAttributes();

        $url = '/api/numbers/' . $id;
        $this->jsonAuth('PUT', $url, $newNumber)
            ->assertJsonFragment(['success' => true]);

        $this->assertDatabaseHas('numbers', $newNumber);
    }

    /** @test */
    public function should_not_update_number_when_not_logged_in()
    {
        $number = factory(Number::class)->create();
        $id = $number->id;

        $newNumber = factory(Number::class)->make()->getAttributes();

        $url = '/api/numbers/' . $id;
        $this->json('PUT', $url, $newNumber)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);

        // $this->assertDatabaseMissing('numbers', $newNumber);
    }

    /** @test */
    public function should_delete_number()
    {
        $this->login();
        $number = factory(Number::class)->create()->getAttributes();
        $url = '/api/numbers/' . $number['id'];

        $this->jsonAuth('DELETE', $url)
            ->assertJsonFragment(['success' => true]);
        $this->assertDatabaseMissing('numbers', $number);
    }

    /** @test */
    public function should_not_delete_number_when_not_logged_in()
    {
        $number = factory(Number::class)->create()->getAttributes();
        $url = '/api/numbers/' . $number['id'];
        $this->json('DELETE', $url)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }
}
