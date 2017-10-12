<?php

use App\Models\Combination;
use Illuminate\Database\Seeder;

class CombinationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Combination::class, 5)->create();
    }
}
