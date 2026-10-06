<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Promotion extends Model
{
    protected $fillable = [
        'code', 'discount_percent', 'starts_at', 'ends_at', 'uses_count', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'starts_at' => 'date',
            'ends_at' => 'date',
            'discount_percent' => 'integer',
            'uses_count' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    public static function activeByCode(string $code): ?self
    {
        $promotion = static::query()
            ->whereRaw('UPPER(code) = ?', [strtoupper(trim($code))])
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('starts_at')->orWhereDate('starts_at', '<=', today());
            })
            ->where(function ($query) {
                $query->whereNull('ends_at')->orWhereDate('ends_at', '>=', today());
            })
            ->first();

        return $promotion?->load('products:id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function appliesTo(Product $product): bool
    {
        return $this->products->isEmpty() || $this->products->contains('id', $product->id);
    }

    public function getStatusLabelAttribute(): string
    {
        if (! $this->is_active) {
            return 'Désactivé';
        }

        if ($this->ends_at && $this->ends_at->isPast()) {
            return 'Expiré';
        }

        return 'Actif';
    }
}
