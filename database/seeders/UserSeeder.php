<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        User::factory()
            ->count(10)
            ->hasPosts(1)
            ->create();

        User::factory()
            ->count(10)
            ->hasPosts(5)
            ->create();

        User::factory()
            ->count(5)
            ->hasPosts(0)
            ->create();
    }
}
