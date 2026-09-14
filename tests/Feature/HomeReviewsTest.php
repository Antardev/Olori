<?php

use App\Models\Review;

it('shows the real published review count and average on the home page', function () {
    Review::query()->delete();

    Review::create([
        'name' => 'Amina C.',
        'city' => 'Cotonou',
        'rating' => 5,
        'comment' => 'Une robe magnifique, de très bonne qualité et très bien livrée.',
        'is_published' => true,
    ]);

    Review::create([
        'name' => 'Paul K.',
        'city' => 'Abidjan',
        'rating' => 3,
        'comment' => 'Jolie pièce, mais la matière est un peu plus légère que prévu.',
        'is_published' => true,
    ]);

    $response = $this->get('/');

    $response->assertOk()
        ->assertSee('2 avis clients')
        ->assertSee('4,0');
});
