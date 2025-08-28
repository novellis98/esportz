<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.it',
            'email_verified_at' => now(),
            'role' => 'admin',
            'password' => Hash::make('admin1234'),
            'remember_token' => Str::random(10),
        ]);
        $this->call(CategorySeeder::class);
        $this->call(ClothingCategorySeeder::class);
        $this->call(PersonCategorySeeder::class);
        $this->call(ArticleSeeder::class);
    }
}
