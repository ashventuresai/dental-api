<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'guard_name' => 'web',
                'created_at' => '2026-06-18 18:19:21',
                'updated_at' => '2026-06-18 18:19:21',
            ],
            [
                'name' => 'staff',
                'guard_name' => 'web',
                'created_at' => '2026-06-18 18:19:21',
                'updated_at' => '2026-06-18 18:19:21',
            ],
            [
                'name' => 'patient',
                'guard_name' => 'web',
                'created_at' => '2026-06-18 18:19:21',
                'updated_at' => '2026-06-18 18:19:21',
            ],
        ]);
    }
}
