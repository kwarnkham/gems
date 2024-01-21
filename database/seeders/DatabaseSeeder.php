<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $now = now();

        DB::table('users')->insert([
            [
                'name' => 'admin',
                'password' => Hash::make('password'),
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);

        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);

        DB::table('role_user')->insert([
            [
                'user_id' => User::query()->first()->id,
                'role_id' => Role::query()->first()->id,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);

        DB::table('app_settings')->insert([
            [
                'usd_rate' => '3500',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);
    }
}
