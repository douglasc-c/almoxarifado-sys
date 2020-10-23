<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin Intergalaxy',
            'email' => 'admin@intergalaxy.dev',
            'password' => Hash::make('admin'),
            'token' => 'CMakockOPck3p1',
        ]);
        
        DB::table('users')->insert([
            'name' => 'Usuario Intergalaxy',
            'email' => 'user@intergalaxy.dev',
            'password' => Hash::make('user'),
            'token' => 'CMakockOPck3p2',
        ]);

    }
}
