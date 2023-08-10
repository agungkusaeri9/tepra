<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'operator',
            'username' => 'operator',
            'email' => 'operator@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'operator'
        ]);
    }
}
