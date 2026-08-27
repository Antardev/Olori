<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Support\DemoData;
use Illuminate\Database\Seeder;

/**
 * Reprend le catalogue de démonstration en base.
 * Idempotent : relancer le seeder ne crée pas de doublons.
 */
class ProductSeeder extends Seeder
{
    public function run(): void
    {
        foreach (DemoData::products() as $p) {
            Product::updateOrCreate(
                ['slug' => $p['slug']],
                [
                    'name'         => $p['name'],
                    'category'     => $p['category'],
                    'subcategory'  => $p['subcategory'],
                    'price'        => $p['price'],
                    'old_price'    => $p['old_price'],
                    'tone'         => $p['tone'],
                    'badge'        => $p['badge'],
                    'sizes'        => $p['sizes'],
                    'colors'       => $p['colors'],
                    'stock'        => $p['stock'],
                    'rating'       => $p['rating'],
                    'reviews'      => $p['reviews'],
                    'description'  => $p['description'],
                    'is_published' => true,
                ]
            );
        }
    }
}
