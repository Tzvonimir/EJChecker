<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'email' => 'warriorkitty@warriorkitty.com',
            'password' => bcrypt('secret'),
            'first_name' => 'Davor',
            'last_name' => 'Lozić'
        ];

        /** @var User $user */
        $afterUserAdd = function ($user) {
            /* add roles */
            $user->roles()->save(Role::all()->random(1)->first());
        };

        /* default user */
        factory(User::class)->create($user)->each($afterUserAdd);

        /* users */
        factory(User::class, 50)->create()->each($afterUserAdd);

    }
}
