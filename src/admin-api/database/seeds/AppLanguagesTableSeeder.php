<?php

use App\Models\AppLanguage;
use Illuminate\Database\Seeder;

class AppLanguagesTableSeeder extends Seeder
{

    public function run()
    {
        factory(AppLanguage::class, 3)->create();
    }
}
