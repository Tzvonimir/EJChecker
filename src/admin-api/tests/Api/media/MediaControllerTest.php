<?php

namespace Tests\Api;

use App\Models\Media;
use Tests\TestCase;

class MediaControllerTest extends TestCase
{

    /** @test */
    public function should_get_paginated_media()
    {
        $this->login();
        $structure = [
            'media' => ['total', 'data'],
            'success'
        ];

        $this->jsonAuth('GET', '/api/media')
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_get_paginated_media_when_not_logged_in()
    {
        $this->json('GET', '/api/media')
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_get_paginated_media_with_search()
    {
        $this->login();
        $structure = [
            'media' => ['total', 'data'],
            'success'
        ];

        $this->jsonAuth('GET', '/api/media', ['search' => 'a'])
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_search_media_when_not_logged_in()
    {
        $this->json('GET', '/api/media')
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_get_media_with_id()
    {
        $this->login();
        $media = factory(Media::class)->create()->getAttributes();
        $url = '/api/media/' . $media['id'];
        $structure = ['success', 'media'];
        $this->jsonAuth('GET', $url)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_get_media_when_not_logged_in()
    {
        $media = factory(Media::class)->create()->getAttributes();
        $url = '/api/media/' . $media['id'];
        $this->json('GET', $url)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

}

