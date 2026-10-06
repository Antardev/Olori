<?php

use App\Models\Product;
use App\Models\Promotion;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('applies the promotion only to selected cart products', function () {
    $eligibleProduct = Product::create([
        'slug' => 'robe-eligible',
        'name' => 'Robe éligible',
        'category' => 'femmes',
        'price' => 1000,
        'stock' => 10,
        'is_published' => true,
    ]);

    Product::create([
        'slug' => 'sac-non-eligible',
        'name' => 'Sac non éligible',
        'category' => 'accessoires',
        'price' => 500,
        'stock' => 10,
        'is_published' => true,
    ]);

    $promotion = Promotion::create([
        'code' => 'ARTICLE10',
        'discount_percent' => 10,
        'is_active' => true,
    ]);
    $promotion->products()->attach($eligibleProduct);

    $this->withSession([
        'cart' => ['robe-eligible' => 2, 'sac-non-eligible' => 1],
        'promo_code' => 'ARTICLE10',
    ])->get('/panier')
        ->assertOk()
        ->assertSee('1 800 FCFA')
        ->assertSee('500 FCFA')
        ->assertSee('-200 FCFA avec le code promo')
        ->assertSee('Sous-total');
});
