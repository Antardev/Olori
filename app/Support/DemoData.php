<?php

namespace App\Support;

/**
 * Données de démonstration.
 * À remplacer par des modèles Eloquent (Product, Order, Category…)
 * une fois la base de données en place.
 */
class DemoData
{
    public static function products(): array
    {
        return [
            [
                'id' => 1, 'slug' => 'robe-ife', 'name' => 'Robe Ifè',
                'category' => 'robes', 'price' => 28000, 'old_price' => null,
                'tone' => 'terra', 'badge' => 'Nouveau',
                'sizes' => ['S', 'M', 'L', 'XL'], 'colors' => ['#B0472B', '#23201B', '#9C4B5E'],
                'stock' => 12, 'rating' => 4.8, 'reviews' => 26,
                'description' => "Robe longue en wax premium, coupe fluide et manches courtes. Confectionnée à la main dans nos ateliers de Cotonou, elle incarne l'élégance et l'authenticité de la maison.",
            ],
            [
                'id' => 2, 'slug' => 'ensemble-adjara', 'name' => 'Ensemble Adjara',
                'category' => 'robes', 'price' => 35000, 'old_price' => 42000,
                'tone' => 'sable', 'badge' => 'Promo',
                'sizes' => ['S', 'M', 'L'], 'colors' => ['#C8B79A', '#23201B'],
                'stock' => 1, 'rating' => 4.9, 'reviews' => 18,
                'description' => "Ensemble deux pièces haut et pantalon large, tissé main. Une silhouette moderne portée par un savoir-faire traditionnel.",
            ],
            [
                'id' => 3, 'slug' => 'sac-kefa', 'name' => 'Sac Kéfa',
                'category' => 'accessoires', 'price' => 18500, 'old_price' => null,
                'tone' => 'rose', 'badge' => null,
                'sizes' => ['Unique'], 'colors' => ['#9C4B5E', '#23201B'],
                'stock' => 2, 'rating' => 4.7, 'reviews' => 31,
                'description' => "Sac porté épaule en cuir et tissage wax, doublure coton, fermeture aimantée. Le compagnon de toutes vos tenues.",
            ],
            [
                'id' => 4, 'slug' => 'boubou-seme', 'name' => 'Boubou Sèmè',
                'category' => 'collection-ete', 'price' => 45000, 'old_price' => null,
                'tone' => 'vert', 'badge' => 'Édition limitée',
                'sizes' => ['M', 'L', 'XL'], 'colors' => ['#3E5C46', '#23201B'],
                'stock' => 6, 'rating' => 5.0, 'reviews' => 9,
                'description' => "Boubou brodé main, coton grand teint. Pièce signature de la collection été, produite en série limitée.",
            ],
            [
                'id' => 5, 'slug' => 'jupe-ganvie', 'name' => 'Jupe Ganvié',
                'category' => 'robes', 'price' => 22000, 'old_price' => null,
                'tone' => 'sable', 'badge' => null,
                'sizes' => ['S', 'M', 'L', 'XL'], 'colors' => ['#C8B79A', '#B0472B'],
                'stock' => 15, 'rating' => 4.6, 'reviews' => 12,
                'description' => "Jupe midi plissée en coton léger, taille haute élastiquée. Idéale du bureau à la plage.",
            ],
            [
                'id' => 6, 'slug' => 'collier-akaba', 'name' => 'Collier Akaba',
                'category' => 'accessoires', 'price' => 9500, 'old_price' => null,
                'tone' => 'terra', 'badge' => null,
                'sizes' => ['Unique'], 'colors' => ['#B0472B'],
                'stock' => 20, 'rating' => 4.8, 'reviews' => 22,
                'description' => "Collier de perles artisanales montées sur fil de laiton doré. Fait main par nos artisanes partenaires.",
            ],
            [
                'id' => 7, 'slug' => 'chemise-oueme', 'name' => 'Chemise Ouémé',
                'category' => 'collection-ete', 'price' => 26000, 'old_price' => null,
                'tone' => 'vert', 'badge' => 'Nouveau',
                'sizes' => ['S', 'M', 'L', 'XL'], 'colors' => ['#3E5C46', '#C8B79A'],
                'stock' => 8, 'rating' => 4.5, 'reviews' => 7,
                'description' => "Chemise ample col officier, imprimé exclusif de la collection été. Coton respirant, coupe mixte.",
            ],
            [
                'id' => 8, 'slug' => 'foulard-atacora', 'name' => 'Foulard Atacora',
                'category' => 'accessoires', 'price' => 7000, 'old_price' => 9000,
                'tone' => 'rose', 'badge' => 'Promo',
                'sizes' => ['Unique'], 'colors' => ['#9C4B5E', '#3E5C46'],
                'stock' => 30, 'rating' => 4.9, 'reviews' => 40,
                'description' => "Carré de soie mélangée aux motifs inspirés des paysages de l'Atacora. À porter en turban, au cou ou au sac.",
            ],
        ];
    }

    public static function categories(): array
    {
        return [
            'robes' => 'Robes',
            'accessoires' => 'Accessoires',
            'collection-ete' => 'Collection été',
        ];
    }

    public static function find(string $slug): ?array
    {
        foreach (self::products() as $p) {
            if ($p['slug'] === $slug) {
                return $p;
            }
        }
        return null;
    }

    public static function orders(): array
    {
        return [
            ['ref' => '#1047', 'client' => 'A. Hounkpatin', 'date' => '04/07/2026', 'total' => 46500, 'status' => 'en_attente'],
            ['ref' => '#1046', 'client' => 'M. Dossou',     'date' => '03/07/2026', 'total' => 28000, 'status' => 'expediee'],
            ['ref' => '#1045', 'client' => 'R. Agossa',     'date' => '02/07/2026', 'total' => 18500, 'status' => 'livree'],
            ['ref' => '#1044', 'client' => 'C. Adjovi',     'date' => '01/07/2026', 'total' => 35000, 'status' => 'annulee'],
            ['ref' => '#1043', 'client' => 'F. Gbaguidi',   'date' => '30/06/2026', 'total' => 61500, 'status' => 'livree'],
        ];
    }

    public static function statuses(): array
    {
        return [
            'en_attente' => ['label' => 'En attente', 'class' => 'badge-warning'],
            'expediee'   => ['label' => 'Expédiée',   'class' => 'badge-info'],
            'livree'     => ['label' => 'Livrée',     'class' => 'badge-success'],
            'annulee'    => ['label' => 'Annulée',    'class' => 'badge-danger'],
        ];
    }
}
