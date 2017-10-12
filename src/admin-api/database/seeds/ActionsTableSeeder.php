<?php

use App\Util\Permission;
use Illuminate\Database\Seeder;

class ActionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = [
            /* users */
            'users/module',
            'users/index',
            'users/show',
            'users/store',
            'users/update',
            'users/destroy',

            /* countries */
            'countries/module',
            'countries/index',
            'countries/show',
            'countries/store',
            'countries/update',
            'countries/destroy',

            /* timezones */
            'timezones/module',
            'timezones/index',
            'timezones/show',
            'timezones/store',
            'timezones/update',
            'timezones/destroy',

            /* app_languages */
            'app_languages/module',
            'app_languages/index',
            'app_languages/show',
            'app_languages/store',
            'app_languages/update',
            'app_languages/destroy',

            /* app_configurations */
            'app_configurations/module',
            'app_configurations/index',
            'app_configurations/show',
            'app_configurations/store',
            'app_configurations/update',
            'app_configurations/destroy',

            /* cities */
            'cities/module',
            'cities/index',
            'cities/show',
            'cities/store',
            'cities/update',
            'cities/destroy',

            /* currencies */
            'currencies/module',
            'currencies/index',
            'currencies/show',
            'currencies/store',
            'currencies/update',
            'currencies/destroy',

            /* media */
            'media/module',
            'media/index',
            'media/show',
            'media/store',
            'media/update',
            'media/destroy',

            /* numbers */
            'numbers/module',
            'numbers/index',
            'numbers/show',
            'numbers/store',
            'numbers/update',
            'numbers/destroy',

            /* extra_numbers */
            'extra_numbers/module',
            'extra_numbers/index',
            'extra_numbers/show',
            'extra_numbers/store',
            'extra_numbers/update',
            'extra_numbers/destroy',

            /* combinations */
            'combinations/module',
            'combinations/index',
            'combinations/show',
            'combinations/store',
            'combinations/update',
            'combinations/destroy'

        ];

        $isAllowed = 1;
        Permission::addActions($actions, $isAllowed);
    }
}
