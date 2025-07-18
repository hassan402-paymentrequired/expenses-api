<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        \App\Models\User::factory()->count(5)->create();
        $this->call(TaskSeeder::class);
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@gmailil.com',
        // ]);
    }
}
