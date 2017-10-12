<?php

namespace Tests\Api;

use App\Models\Combination;
use Tests\TestCase;

class CombinationControllerTest extends TestCase
{

    /** @test */
    public function should_get_paginated_combinations()
    {
        $this->login();
        $structure = [
            'combinations' => ['total', 'data'],
            'success'
        ];

        $this->jsonAuth('GET', '/api/combinations')
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_get_paginated_combinations_when_not_logged_in()
    {
        $this->json('GET', '/api/combinations')
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_get_paginated_combinations_with_search()
    {
        $this->login();
        $structure = [
            'combinations' => ['total', 'data'],
            'success'
        ];

        $this->jsonAuth('GET', '/api/combinations', ['search' => '2'])
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_search_combinations_when_not_logged_in()
    {
        $this->json('GET', '/api/combinations', ['search' => '2'])
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_not_save_combination_without_first_number()
    {
        $this->login();
        $combination = factory(Combination::class)->make(['first_number' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/combinations', $combination)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_not_save_combination_without_second_number()
    {
        $this->login();
        $combination = factory(Combination::class)->make(['second_number' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/combinations', $combination)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_not_save_combination_without_third_number()
    {
        $this->login();
        $combination = factory(Combination::class)->make(['third_number' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/combinations', $combination)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_not_save_combination_without_fourth_number()
    {
        $this->login();
        $combination = factory(Combination::class)->make(['fourth_number' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/combinations', $combination)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_not_save_combination_without_fifth_number()
    {
        $this->login();
        $combination = factory(Combination::class)->make(['fifth_number' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/combinations', $combination)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_not_save_combination_without_first_extra_number()
    {
        $this->login();
        $combination = factory(Combination::class)->make(['first_extra_number' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/combinations', $combination)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_not_save_combination_without_second_extra_number()
    {
        $this->login();
        $combination = factory(Combination::class)->make(['second_extra_number' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/combinations', $combination)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_create_combination_with_all_data()
    {
        $this->login();
        $combination = factory(Combination::class)->make()->getAttributes();
        $this->jsonAuth('POST', '/api/combinations', $combination)
            ->assertJsonFragment(['success' => true]);
        $this->assertDatabaseHas('combinations', $combination);
    }

    /** @test */
    public function should_not_create_combination_when_not_logged_in()
    {
        $combination = factory(Combination::class)->make()->getAttributes();
        $this->json('POST', '/api/combinations', $combination)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);

        $this->assertDatabaseMissing('combinations', $combination);
    }

    /** @test */
    public function should_get_combination_with_id()
    {
        $this->login();
        $combination = factory(Combination::class)->create()->getAttributes();
        $url = '/api/combinations/' . $combination['id'];
        $structure = ['success', 'combination'];
        $this->jsonAuth('GET', $url)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

    /** @test */
    public function should_not_get_combination_when_not_logged_in()
    {
        $combination = factory(Combination::class)->create()->getAttributes();
        $url = '/api/combinations/' . $combination['id'];
        $this->json('GET', $url)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_update_combination()
    {
        $this->login();

        $combination = factory(Combination::class)->create();
        $id = $combination->id;

        $newCombination = factory(Combination::class)->make()->getAttributes();

        $url = '/api/combinations/' . $id;
        $this->jsonAuth('PUT', $url, $newCombination)
            ->assertJsonFragment(['success' => true]);

        $this->assertDatabaseHas('combinations', $newCombination);
    }

    /** @test */
    public function should_not_update_combination_when_not_logged_in()
    {
        $combination = factory(Combination::class)->create();
        $id = $combination->id;

        $newCombination = factory(Combination::class)->make()->getAttributes();

        $url = '/api/combinations/' . $id;
        $this->json('PUT', $url, $newCombination)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);

        $this->assertDatabaseMissing('combinations', $newCombination);
    }

    /** @test */
    public function should_delete_combination()
    {
        $this->login();
        $combination = factory(Combination::class)->create()->getAttributes();
        $url = '/api/combinations/' . $combination['id'];

        $this->jsonAuth('DELETE', $url)
            ->assertJsonFragment(['success' => true]);
        $this->assertDatabaseMissing('combinations', $combination);
    }

    /** @test */
    public function should_not_delete_combination_when_not_logged_in()
    {
        $combination = factory(Combination::class)->create()->getAttributes();
        $url = '/api/combinations/' . $combination['id'];
        $this->json('DELETE', $url)
            ->assertJsonFragment([
                'success' => false,
                'reason' => 'not_logged_in'
            ]);
    }

    /** @test */
    public function should_check_combination_with_all_data()
    {
        $structure = [
            'success',
            'combination_count',
            'current_combination_count'
        ];

        $combination = factory(Combination::class)->make()->getAttributes();
        $this->jsonAuth('POST', '/api/open/combinations/check_combination', $combination)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
        $this->assertDatabaseHas('combinations', $combination);
    }

    /** @test */
    public function should_not_check_combination_without_first_number()
    {
        $combination = factory(Combination::class)->make(['first_number' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/open/combinations/check_combination', $combination)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_not_check_combination_without_second_number()
    {
        $combination = factory(Combination::class)->make(['second_number' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/open/combinations/check_combination', $combination)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_not_check_combination_without_third_number()
    {
        $combination = factory(Combination::class)->make(['third_number' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/open/combinations/check_combination', $combination)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_not_check_combination_without_fourth_number()
    {
        $combination = factory(Combination::class)->make(['fourth_number' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/open/combinations/check_combination', $combination)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_not_check_combination_without_fifth_number()
    {
        $combination = factory(Combination::class)->make(['fifth_number' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/open/combinations/check_combination', $combination)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_not_check_combination_without_first_extra_number()
    {
        $combination = factory(Combination::class)->make(['first_extra_number' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/open/combinations/check_combination', $combination)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_not_check_combination_without_second_extra_number()
    {
        $combination = factory(Combination::class)->make(['second_extra_number' => null])->toArray();
        $structure = ['success', 'errors'];
        $this->jsonAuth('POST', '/api/open/combinations/check_combination', $combination)
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => false]);
    }

    /** @test */
    public function should_find_statistic()
    {
        $structure = [
            'statistics',
            'success'
        ];

        $this->jsonAuth('GET', '/api/open/combinations/get_statistics')
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }

        /** @test */
    public function should_get_all_winning_combinations()
    {
        $this->login();
        $structure = [
            'combinations',
            'success'
        ];

        $this->jsonAuth('GET', '/api/open/combinations/get_winning_combinations')
            ->assertJsonStructure($structure)
            ->assertJsonFragment(['success' => true]);
    }
}
