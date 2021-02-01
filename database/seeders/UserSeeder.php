<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'uuid' => Uuid::uuid4(),
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'uuid' => Uuid::uuid4(),
            'name' => 'Fulano',
            'email' => 'fulano@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
