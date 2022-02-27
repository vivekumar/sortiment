<?php

namespace Database\Seeders;

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
         \App\Models\User::factory(1)->create();
         \App\Models\Admin::factory()->create();
         \App\Models\Category::factory(2)->create();
         \App\Models\SubCategory::factory(5)->hasCategory(1)->create();
         \App\Models\Brand::factory(1)->create();
         \App\Models\Product::factory(2)->create();
    }
}

