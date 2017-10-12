<?php

use App\Models\ExtraNumber;
use Illuminate\Database\Seeder;

class ExtraNumbersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ExtraNumber::class, 4)->create();
    }
}
