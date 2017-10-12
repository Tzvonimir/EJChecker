<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ActionsTableSeeder::class);
        $this->call(TimezonesTableSeeder::class);
        $this->call(AppLanguagesTableSeeder::class);
        $this->call(AppConfigurationsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(CitiesTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(NumbersTableSeeder::class);
        $this->call(ExtraNumbersTableSeeder::class);
        $this->call(MediaTableSeeder::class);
        $this->call(CombinationsTableSeeder::class);
    }
}
