<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['name' => 'Amina C.', 'city' => 'Cotonou', 'rating' => 5, 'comment' => 'Une robe magnifique, des tissus de qualité et une finition parfaite. Je suis ravie de ma commande.'],
            ['name' => 'Paul K.', 'city' => 'Porto-Novo', 'rating' => 5, 'comment' => 'Le chemisier correspond parfaitement aux photos. Livraison rapide et service client au top.'],
            ['name' => 'Sophie B.', 'city' => 'Abidjan', 'rating' => 4, 'comment' => "J'adore le style unique des collections. Ça change des grandes enseignes, on sent le savoir-faire local."],
        ] as $review) {
            Review::firstOrCreate($review);
        }
    }
}
