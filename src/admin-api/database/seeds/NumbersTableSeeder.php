<?php

use App\Models\Number;
use Illuminate\Database\Seeder;

class NumbersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Number::class, 3)->create();
    }
}
