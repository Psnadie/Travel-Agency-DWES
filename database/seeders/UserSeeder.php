<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario admin
        DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@vacaciones.com',
            'password' => bcrypt('password'),
            'rol' => 'admin',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Usuario advanced
        DB::table('users')->insert([
            'name' => 'Usuario Advanced',
            'email' => 'advanced@vacaciones.com',
            'password' => bcrypt('password'),
            'rol' => 'advanced',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Usuario cliente
        DB::table('users')->insert([
            'name' => 'Cliente Demo',
            'email' => 'cliente@vacaciones.com',
            'password' => bcrypt('password'),
            'rol' => 'user',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}