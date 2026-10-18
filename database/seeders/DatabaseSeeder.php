<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users (default accounts: user, admin, supplier with password: 'password')
        $users = [
            [
                'user_id' => 7,
                'name' => 'Default User',
                'username' => 'user',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 8,
                'name' => 'Default Admin',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 9,
                'name' => 'Default Supplier',
                'username' => 'supplier',
                'email' => 'supplier@example.com',
                'password' => Hash::make('password'),
                'role' => 'supplier',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];
        DB::table('users')->insert($users);

        // 2. Seed Categories
        $categories = [
            ['category_id' => 7, 'category_name' => 'Sports', 'category_image' => 'kategori1717487871.jpeg', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 8, 'category_name' => 'Casual', 'category_image' => 'kategori1717487878.jpeg', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 9, 'category_name' => 'Formal', 'category_image' => 'kategori1717490832.jpeg', 'created_at' => now(), 'updated_at' => now()]
        ];
        DB::table('categories')->insert($categories);

        // 3. Seed Sizes
        $sizes = [
            ['size_id' => 1, 'size_value' => 38],
            ['size_id' => 2, 'size_value' => 39],
            ['size_id' => 3, 'size_value' => 40],
            ['size_id' => 4, 'size_value' => 41],
            ['size_id' => 5, 'size_value' => 42],
            ['size_id' => 6, 'size_value' => 43],
            ['size_id' => 7, 'size_value' => 44],
            ['size_id' => 8, 'size_value' => 45],
        ];
        DB::table('sizes')->insert($sizes);

        // 4. Seed Products
        $productsFile = __DIR__ . '/products_array.php';
        if (file_exists($productsFile)) {
            $rawProducts = require $productsFile;
            $products = [];
            foreach ($rawProducts as $p) {
                $products[] = [
                    'product_id' => $p[0],
                    'category_id' => $p[1],
                    'product_name' => $p[2],
                    'product_price' => $p[3],
                    'product_image' => $p[4],
                    'product_description' => $p[5],
                    'product_status' => (bool)$p[6],
                    'created_at' => $p[7] ?? now(),
                    'updated_at' => now()
                ];
            }
            DB::table('products')->insert($products);
        }

        // 5. Seed Product Sizes
        $productSizesFile = __DIR__ . '/product_sizes_array.php';
        if (file_exists($productSizesFile)) {
            $rawProductSizes = require $productSizesFile;
            $productSizes = [];
            foreach ($rawProductSizes as $ps) {
                $productSizes[] = [
                    'product_size_id' => $ps[0],
                    'product_id' => $ps[1],
                    'size_id' => $ps[2],
                    'stock' => $ps[3]
                ];
            }
            // Chunk insert to avoid SQLite parameter limit
            foreach (array_chunk($productSizes, 100) as $chunk) {
                DB::table('product_sizes')->insert($chunk);
            }
        }
    }
}
