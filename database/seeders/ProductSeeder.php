<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder

{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Razer Deathadder V3 Pro',
            'price' => 549,
            'image' => '/images/DeathadderV3Pro.png',
            'type' => 'popular',
        ]);

        Product::create([
            'name' => 'Akko 3098B',
            'price' => 299,
            'image' => '/images/469_1725943111.jpg',
            'type' => 'popular',
        ]);

        Product::create([
            'name' => 'ASUS ROG Strix GeForce RTX 4070 SUPER OC',
            'price' => 4199,
            'image' => '/images/34.jpg',
            'type' => 'latest',
        ]);

        Product::create([
            'name' => 'Asus ROG Zephyrus G16',
            'price' => 13299,
            'image' => '/images/Asus_ROG_Zephyrus_G16_GA605W_01.jpg',
            'type' => 'latest',
        ]);
    }
}
