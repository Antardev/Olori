<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\DemoData;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function home()
    {
        return view('home', [
            'nouveautes' => Product::published()->where('badge', 'Nouveau')->latest()->take(4)->get(),
            'selection'  => Product::published()->latest()->take(4)->get(),
            'categories' => DemoData::categories(),
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

        if ($max = $request->query('prix_max')) {
            $query->where('price', '<=', (int) $max);
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
            'meta'       => DemoData::categoryMeta($categorie),
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
            ->take(3)
            ->get();

        return view('shop.show', compact('product', 'similaires'));
    }
}
