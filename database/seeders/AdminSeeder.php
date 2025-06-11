<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'firstname' => 'System',
            'lastname' => 'Administrator',
            'email' => 'admin@email.com',
            'role' => 1,
            'password' => Hash::make('malik005'),
        ]);

        Admin::create([
            'firstname' => 'First',
            'lastname' => 'Agent',
            'email' => 'agent1@email.com',
            'role' => 2,
            'password' => Hash::make('malik005'),
        ]);

        Admin::create([
            'firstname' => 'Second',
            'lastname' => 'Agent',
            'email' => 'agent2@email.com',
            'role' => 2,
            'password' => Hash::make('malik005'),
        ]);
    }
}
