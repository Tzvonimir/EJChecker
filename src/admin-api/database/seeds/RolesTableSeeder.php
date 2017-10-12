<?php

use App\Util\Permission;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Administrator',
            'User',
            'Guest'
        ];
        Permission::addRoles($roles);
    }
}
