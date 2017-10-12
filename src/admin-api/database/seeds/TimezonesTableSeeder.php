<?php

use App\Models\Timezone;
use Illuminate\Database\Seeder;

class TimezonesTableSeeder extends Seeder
{

    public function run()
    {
        factory(Timezone::class, 3)->create();
    }
}
