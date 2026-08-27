<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = ['collection', 'slug', 'name', 'sort_order'];

    public static function forCollection(string $collection)
    {
        return static::where('collection', $collection)->orderBy('sort_order')->orderBy('name');
    }

    public static function makeSlug(string $name): string
    {
        return Str::slug($name);
    }
}
