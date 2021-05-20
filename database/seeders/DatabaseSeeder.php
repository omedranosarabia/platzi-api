<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // $this->call(CategorySeeder::class);
        // $this->call(ProductSeeder::class);
        User::factory()->count(10)->create();
        Category::factory()->count(10)->create();
        Product::factory()->count(10)->create();

    }
}
