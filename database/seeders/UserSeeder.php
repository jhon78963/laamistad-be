<?php

namespace Database\Seeders;

use App\Auth\Infrastructure\Models\Role;
use App\Auth\Infrastructure\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::create(['description' => 'Administrador']);
        $userRole = Role::create(['description' => 'Usuario']);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123qwe123'),
            'role_id' => $adminRole->id,
        ]);

        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('123qwe123'),
            'role_id' => $userRole->id,
        ]);
    }
}
