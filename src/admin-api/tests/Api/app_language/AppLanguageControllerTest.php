<?php

namespace Tests\Api;

use App\Models\AppLanguage;
use Tests\TestCase;

class AppLanguageControllerTest extends TestCase
{

    /** @test */
    public function should_get_paginated_app_languages()
    {
        $this->login();
        $structure = [
            'app_languages' => ['total', 'data'],
            'success'
        ];

        $this->jsonAuth('GET', '/api/app_languages')
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_get_paginated_app_languages_when_not_logged_in()
    {
        $this->json('GET', '/api/app_languages')
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_get_paginated_app_languages_with_search()
    {
        $this->login();
        $structure = [
            'app_languages' => ['total', 'data'],
            'success'
        ];

        $this->jsonAuth('GET', '/api/app_languages', ['search' => 'a'])
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_search_app_languages_when_not_logged_in()
    {
        $this->json('GET', '/api/app_languages', ['search' => 'a'])
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_not_save_app_language_without_name()
    {
        $this->login();
        $app_language = factory(AppLanguage::class)->make(['name' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/app_languages', $app_language)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }


    /** @test */
    public function should_create_app_language_with_all_data()
    {
        $this->login();
        $app_language = factory(AppLanguage::class)->make()->getAttributes();
        $this->jsonAuth('POST', '/api/app_languages', $app_language)
            ->assertJsonFragment(['success' => true]);
        $this->assertDatabaseHas('app_languages', $app_language);
    }

    /** @test */
    public function should_not_create_app_language_when_not_logged_in()
    {
        $app_language = factory(AppLanguage::class)->make()->getAttributes();
        $this->json('POST', '/api/app_languages', $app_language)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);

        $this->assertDatabaseMissing('app_languages', $app_language);
    }

    /** @test */
    public function should_get_app_language_with_id()
    {
        $this->login();
        $app_language = factory(AppLanguage::class)->create()->getAttributes();
        $url = '/api/app_languages/' . $app_language['id'];
        $structure = ['success', 'app_languages'];
        $this->jsonAuth('GET', $url)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_get_app_language_when_not_logged_in()
    {
        $app_language = factory(AppLanguage::class)->create()->getAttributes();
        $url = '/api/app_languages/' . $app_language['id'];
        $this->json('GET', $url)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_update_app_language()
    {
        $this->login();

        $app_language = factory(AppLanguage::class)->create();
        $id = $app_language->id;

        $newAppLanguage = factory(AppLanguage::class)->make()->getAttributes();

        $url = '/api/app_languages/' . $id;
        $this->jsonAuth('PUT', $url, $newAppLanguage)
            ->assertJsonFragment(['success' => true]);

        $this->assertDatabaseHas('app_languages', $newAppLanguage);
    }

    /** @test */
    public function should_not_update_app_language_when_not_logged_in()
    {
        $app_language = factory(AppLanguage::class)->create();
        $id = $app_language->id;

        $newAppLanguage = factory(AppLanguage::class)->make()->getAttributes();

        $url = '/api/app_languages/' . $id;
        $this->json('PUT', $url, $newAppLanguage)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);

        $this->assertDatabaseMissing('app_languages', $newAppLanguage);
    }

    /** @test */
    public function should_delete_app_language()
    {
        $this->login();
        $app_language = factory(AppLanguage::class)->create()->getAttributes();
        $url = '/api/app_languages/' . $app_language['id'];

        $this->jsonAuth('DELETE', $url)
            ->assertJsonFragment(['success' => true]);
        $this->assertDatabaseMissing('app_languages', $app_language);
    }

    /** @test */
    public function should_not_delete_app_language_when_not_logged_in()
    {
        $app_language = factory(AppLanguage::class)->create()->getAttributes();
        $url = '/api/app_languages/' . $app_language['id'];
        $this->json('DELETE', $url)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

}
