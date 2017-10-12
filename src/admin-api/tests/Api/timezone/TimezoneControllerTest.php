<?php

namespace Tests\Api;

use App\Models\Timezone;
use Tests\TestCase;

class TimezoneControllerTest extends TestCase
{

    /** @test */
    public function should_get_paginated_timezones()
    {
        $this->login();
        $structure = [
            'timezones' => ['total', 'data'],
            'success'
        ];

        $this->jsonAuth('GET', '/api/timezones')
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_get_paginated_timezones_when_not_logged_in()
    {
        $this->json('GET', '/api/timezones')
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_get_paginated_timezones_with_search()
    {
        $this->login();
        $structure = [
            'timezones' => ['total', 'data'],
            'success'
        ];

        $this->jsonAuth('GET', '/api/timezones', ['search' => 'd'])
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_search_timezones_when_not_logged_in()
    {
        $this->json('GET', '/api/timezones', ['search' => 'a'])
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_not_save_timezone_without_name()
    {
        $this->login();
        $timezone = factory(Timezone::class)->make(['name' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/timezones', $timezone)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }


    /** @test */
    public function should_create_timezone_with_all_data()
    {
        $this->login();
        $timezone = factory(Timezone::class)->make()->getAttributes();
        $this->jsonAuth('POST', '/api/timezones', $timezone)
            ->assertJsonFragment(['success' => true]);
        $this->assertDatabaseHas('timezones', $timezone);
    }

    /** @test */
    public function should_not_create_timezone_when_not_logged_in()
    {
        $timezone = factory(Timezone::class)->make()->getAttributes();
        $this->json('POST', '/api/timezones', $timezone)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);

        $this->assertDatabaseMissing('timezones', $timezone);
    }

    /** @test */
    public function should_get_timezone_with_id()
    {
        $this->login();
        $timezone = factory(Timezone::class)->create()->getAttributes();
        $url = '/api/timezones/' . $timezone['id'];
        $structure = ['success', 'timezone'];
        $this->jsonAuth('GET', $url)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_get_timezone_when_not_logged_in()
    {
        $timezone = factory(Timezone::class)->create()->getAttributes();
        $url = '/api/timezones/' . $timezone['id'];
        $this->json('GET', $url)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_update_timezone()
    {
        $this->login();

        $timezone = factory(Timezone::class)->create();
        $id = $timezone->id;

        $newTimezone = factory(Timezone::class)->make()->getAttributes();

        $url = '/api/timezones/' . $id;
        $this->jsonAuth('PUT', $url, $newTimezone)
            ->assertJsonFragment(['success' => true]);

        $this->assertDatabaseHas('timezones', $newTimezone);
    }

    /** @test */
    public function should_not_update_timezone_when_not_logged_in()
    {
        $timezone = factory(Timezone::class)->create();
        $id = $timezone->id;

        $newTimezone = factory(Timezone::class)->make()->getAttributes();

        $url = '/api/timezones/' . $id;
        $this->json('PUT', $url, $newTimezone)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);

        $this->assertDatabaseMissing('timezones', $newTimezone);
    }

    /** @test */
    public function should_delete_timezone()
    {
        $this->login();
        $timezone = factory(Timezone::class)->create()->getAttributes();
        $url = '/api/timezones/' . $timezone['id'];

        $this->jsonAuth('DELETE', $url)
            ->assertJsonFragment(['success' => true]);
        $this->assertDatabaseMissing('timezones', $timezone);
    }

    /** @test */
    public function should_not_delete_timezone_when_not_logged_in()
    {
        $timezone = factory(Timezone::class)->create()->getAttributes();
        $url = '/api/timezones/' . $timezone['id'];
        $this->json('DELETE', $url)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

}
