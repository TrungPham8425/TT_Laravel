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
        $products = [
            [
                'name' => 'iPhone 15 Pro',
                'description' => 'Latest iPhone with advanced camera system and A17 Pro chip',
                'price' => 999.99,
                'image_url' => 'https://images.unsplash.com/photo-1592750475338-74b7b21085ab?w=400'
            ],
            [
                'name' => 'MacBook Air M2',
                'description' => 'Ultra-thin laptop with M2 chip for incredible performance',
                'price' => 1199.99,
                'image_url' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=400'
            ],
            [
                'name' => 'Samsung Galaxy S24',
                'description' => 'Android flagship with AI features and stunning display',
                'price' => 899.99,
                'image_url' => 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=400'
            ],
            [
                'name' => 'Sony WH-1000XM5',
                'description' => 'Premium noise-cancelling headphones with exceptional sound quality',
                'price' => 349.99,
                'image_url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400'
            ],
            [
                'name' => 'iPad Air',
                'description' => 'Versatile tablet perfect for work and entertainment',
                'price' => 599.99,
                'image_url' => 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=400'
            ],
            [
                'name' => 'Dell XPS 13',
                'description' => 'Premium Windows laptop with InfinityEdge display',
                'price' => 1299.99,
                'image_url' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=400'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
