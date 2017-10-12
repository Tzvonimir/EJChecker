<?php

use App\Models\AppConfiguration;
use Illuminate\Database\Seeder;

class AppConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(AppConfiguration::class, 5)->create();
    }
}
