<?php

namespace Database\Seeders;

use App\Models\{Address, User};
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(StateSeeder::class);

        User::factory(10)
            ->has(Address::factory(), "addresses")
            ->create();
    }
}
