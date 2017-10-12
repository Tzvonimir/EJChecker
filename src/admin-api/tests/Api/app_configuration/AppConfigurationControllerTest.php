<?php

namespace Tests\Api;

use App\Models\AppConfiguration;
use Tests\TestCase;

class AppConfigurationControllerTest extends TestCase
{

    /** @test */
    public function should_get_paginated_app_configurations()
    {
        $this->login();
        $structure = [
            'app_configurations' => ['total', 'data'],
            'success'
        ];

        $this->jsonAuth('GET', '/api/app_configurations')
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_get_paginated_app_configurations_when_not_logged_in()
    {
        $this->json('GET', '/api/app_configurations')
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_get_paginated_app_configurations_with_search()
    {
        $this->login();
        $structure = [
            'app_configurations' => ['total', 'data'],
            'success'
        ];

        $this->jsonAuth('GET', '/api/app_configurations', ['search' => 'a'])
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_search_app_configurations_when_not_logged_in()
    {
        $this->json('GET', '/api/app_configurations', ['search' => 'a'])
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_not_save_app_configuration_without_key()
    {
        $this->login();
        $appConfiguration = factory(AppConfiguration::class)->make(['key' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/app_configurations', $appConfiguration)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_not_save_app_configuration_without_value()
    {
        $this->login();
        $appConfiguration = factory(AppConfiguration::class)->make(['value' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/app_configurations', $appConfiguration)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_create_app_configuration_with_all_data()
    {
        $this->login();
        $appConfiguration = factory(AppConfiguration::class)->make()->getAttributes();
        $this->jsonAuth('POST', '/api/app_configurations', $appConfiguration)
            ->assertJsonFragment(['success' => true]);
        $this->assertDatabaseHas('app_configurations', $appConfiguration);
    }

    /** @test */
    public function should_not_create_app_configuration_when_not_logged_in()
    {
        $appConfiguration = factory(AppConfiguration::class)->make()->getAttributes();
        $this->json('POST', '/api/app_configurations', $appConfiguration)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);

        $this->assertDatabaseMissing('app_configurations', $appConfiguration);
    }

    /** @test */
    public function should_get_app_configuration_with_id()
    {
        $this->login();
        $appConfiguration = factory(AppConfiguration::class)->create()->getAttributes();
        $url = '/api/app_configurations/' . $appConfiguration['id'];
        $structure = ['success', 'app_configuration'];
        $this->jsonAuth('GET', $url)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_get_app_configuration_when_not_logged_in()
    {
        $appConfiguration = factory(AppConfiguration::class)->create()->getAttributes();
        $url = '/api/app_configurations/' . $appConfiguration['id'];
        $this->json('GET', $url)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_update_app_configuration()
    {
        $this->login();

        $appConfiguration = factory(AppConfiguration::class)->create();
        $id = $appConfiguration->id;

        $newAppConfiguration = factory(AppConfiguration::class)->make()->getAttributes();

        $url = '/api/app_configurations/' . $id;
        $this->jsonAuth('PUT', $url, $newAppConfiguration)
            ->assertJsonFragment(['success' => true]);

        $this->assertDatabaseHas('app_configurations', $newAppConfiguration);
    }

    /** @test */
    public function should_not_update_app_configuration_when_not_logged_in()
    {
        $appConfiguration = factory(AppConfiguration::class)->create();
        $id = $appConfiguration->id;

        $newAppConfiguration = factory(AppConfiguration::class)->make()->getAttributes();

        $url = '/api/app_configurations/' . $id;
        $this->json('PUT', $url, $newAppConfiguration)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);

        $this->assertDatabaseMissing('app_configurations', $newAppConfiguration);
    }

    /** @test */
    public function should_delete_app_configuration()
    {
        $this->login();
        $appConfiguration = factory(AppConfiguration::class)->create()->getAttributes();
        $url = '/api/app_configurations/' . $appConfiguration['id'];

        $this->jsonAuth('DELETE', $url)
            ->assertJsonFragment(['success' => true]);
        $this->assertDatabaseMissing('app_configurations', $appConfiguration);
    }

    /** @test */
    public function should_not_delete_app_configuration_when_not_logged_in()
    {
        $appConfiguration = factory(AppConfiguration::class)->create()->getAttributes();
        $url = '/api/app_configurations/' . $appConfiguration['id'];
        $this->json('DELETE', $url)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

}
