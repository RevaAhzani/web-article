<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category; //notice
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; //notice

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Member']);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);

        $admin->assignRole('Admin');

        $member = User::create([
            'name' => 'Member',
            'email' => 'member@example.com',
            'password' => bcrypt('password'),
        ]);

        $member->assignRole('Member');
        
        Category::create(['name' => 'Social']);
        Category::create(['name' => 'Politics']);
        Category::create(['name' => 'Culture']);
    }
}
