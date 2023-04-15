<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(BrandSeeder::class);
        $this->call(CallbackSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(DeliverySeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(OrderProductSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(ParamSeeder::class);
        $this->call(ParamsOptionSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(ClientSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ParamsProductSeeder::class);
        $this->call(ProductImageSeeder::class);
        $this->call(ProductProductSeeder::class);
    }
}
