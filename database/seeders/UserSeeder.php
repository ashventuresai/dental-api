<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): array
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => 'SuperAdmin123',
                'role' => 'super admin',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => 'Admin123', //
                'role' => 'admin',
            ],
            [
                'name' => 'Asyraf',
                'email' => 'asyraf@gmail.com',
                'password' => 'Asyraf123', //
                'role' => 'doctor',
            ],
            [
                'name' => 'Doctor',
                'email' => 'doctor@gmail.com',
                'password' => 'Doctor123', //
                'role' => 'doctor',
            ],
            [
                'name' => 'Staff',
                'email' => 'staff@gmail.com',
                'password' => 'Staff123', //
                'role' => 'staff',
            ],
            [
                'name' => 'Patient',
                'email' => 'patient@gmail.com',
                'password' => 'Patient123', //
                'role' => 'patient',
            ],
        ];

        $createdUsers = [];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => bcrypt($userData['password']),
                ]
            );

            $user->assignRole($userData['role']);

            if (!isset($createdUsers[$userData['role']])) {
                $createdUsers[$userData['role']] = [];
            }

            $createdUsers[$userData['role']][] = $user;
        }

        return $createdUsers;
    }
}
