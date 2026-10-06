<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use App\Support\DemoData;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function home()
    {
        return view('home', [
            'nouveautes' => Product::published()->where('badge', 'Nouveau')->latest()->take(4)->get(),
            'selection'  => Product::published()->latest()->take(8)->get(),
            'categories' => DemoData::categories(),
            'avis'       => Review::published()->orderByDesc('rating')->latest()->take(4)->get(),
        ]);
    }

    /**
     * Page dédiée à une catégorie (une vue par catégorie : /hommes, /femmes…).
     * Les articles publiés depuis le back-office y apparaissent immédiatement,
     * les plus récents en tête.
     */
    public function category(Request $request, string $categorie)
    {
        $categories = DemoData::categories();
        abort_if(! isset($categories[$categorie]), 404);

        $query = Product::published()->category($categorie);
        $subcategories = Category::forCollection($categorie)->pluck('name', 'slug')->all();
        $subcategory = $request->query('sous_categorie');

        if ($subcategory && isset($subcategories[$subcategory])) {
            $query->where('subcategory', $subcategory);
        }

        match ($request->query('tri')) {
            'prix_asc'  => $query->orderBy('price'),
            'prix_desc' => $query->orderByDesc('price'),
            default     => $query->latest(),
        };

        return view('shop.category', [
            'products'   => $query->get(),
            'categories' => $categories,
            'active'     => $categorie,
            'label'      => $categories[$categorie],
            'meta'          => DemoData::categoryMeta($categorie),
            'subcategories' => $subcategories,
            'subcategory'  => $subcategory,
        ]);
    }

    public function accessories(Request $request)
    {
        $gender = $request->query('genre');
        $products = Product::published()->where(function ($query) {
            $query->where('category', 'accessoires')
                ->orWhere('subcategory', 'accessoires');
        });

        if (in_array($gender, ['hommes', 'femmes', 'mixtes'], true)) {
            $products->where(function ($query) use ($gender) {
                $query->where('subcategory', $gender)
                    ->orWhere(function ($legacyQuery) use ($gender) {
                        $legacyQuery->where('category', $gender)->where('subcategory', 'accessoires');
                    });
            });
        }

        return view('shop.accessories', [
            'products' => $products->latest()->get(),
            'gender' => $gender,
        ]);
    }

    public function show(string $slug)
    {
        $product = Product::published()->where('slug', $slug)->first();
        abort_if(! $product, 404);

        $similaires = Product::published()
            ->category($product->category)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(8)
            ->get();

        return view('shop.show', compact('product', 'similaires'));
    }
}
