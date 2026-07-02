<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Asyraf',
                'email' => 'asyraf@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$i9emKnDak89sPlBzSQqW3O5CVkKf.pq/S9Nw02Q5yDBcc97qMc6Tq', // Asyraf123
                'remember_token' => null,
                'created_at' => '2026-06-18 18:19:21',
                'updated_at' => '2026-06-18 18:19:21',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$1JhfDE35VYc1a6M3LPnDm.Jl2G701IfrqS3jzyz7S.KqEBFnGG9mC', // Admin123
                'remember_token' => null,
                'created_at' => '2026-06-18 18:43:20',
                'updated_at' => '2026-06-18 18:43:20',
            ],
            [
                'name' => 'Staff',
                'email' => 'staff@gmail.com',
                'email_verified_at' => null,
                'password' => '$2y$12$f8zfFq/93q3iYUF1N2jAfusfLBBG1DSZ2ukYAbmixKqUnfbfScUa.', // Staff123
                'remember_token' => null,
                'created_at' => '2026-06-18 18:49:52',
                'updated_at' => '2026-06-18 18:49:52',
            ],
        ]);
    }
}
