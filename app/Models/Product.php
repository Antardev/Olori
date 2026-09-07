<?php

namespace App\Models;

use App\Support\DemoData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    /** Pastilles affichables sur la fiche produit. */
    public const BADGES = ['Nouveau', 'Promo', 'Édition limitée'];

    protected $fillable = [
        'slug', 'name', 'category', 'subcategory', 'price', 'old_price', 'badge',
        'sizes', 'colors', 'stock', 'rating', 'reviews', 'description',
        'image', 'images', 'is_published',
    ];

    protected function casts(): array
    {
        return [
            'sizes'        => 'array',
            'colors'       => 'array',
            'images'       => 'array',
            'price'        => 'integer',
            'old_price'    => 'integer',
            'stock'        => 'integer',
            'reviews'      => 'integer',
            'rating'       => 'float',
            'is_published' => 'boolean',
        ];
    }

    /** Articles visibles en boutique. */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    /** Articles d'une catégorie, du plus récent au plus ancien. */
    public function scopeCategory(Builder $query, string $category): Builder
    {
        return $query->where('category', $category);
    }

    /** Libellé lisible de la catégorie (« Hommes », « Femmes »…). */
    public function getCategoryLabelAttribute(): string
    {
        return DemoData::categories()[$this->category] ?? $this->category;
    }

    public function getSubcategoryLabelAttribute(): string
    {
        return Category::where('collection', $this->category)
            ->where('slug', $this->subcategory)
            ->value('name') ?? $this->subcategory ?? 'Non classée';
    }

    /**
     * Slug unique dérivé du nom : « Chemise Ouémé » → « chemise-oueme »,
     * suffixé si le nom existe déjà.
     */
    public static function uniqueSlug(string $name): string
    {
        $base = Str::slug($name) ?: 'article';
        $slug = $base;
        $i = 2;

        while (static::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }
}
