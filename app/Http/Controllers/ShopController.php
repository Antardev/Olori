<?php

namespace App\Http\Controllers;

use App\Support\DemoData;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function home()
    {
        $products = DemoData::products();

        return view('home', [
            'nouveautes'  => array_slice(array_filter($products, fn ($p) => $p['badge'] === 'Nouveau'), 0, 4),
            'selection'   => array_slice($products, 0, 4),
            'categories'  => DemoData::categories(),
        ]);
    }

    public function index(Request $request)
    {
        $products = DemoData::products();

        if ($cat = $request->query('categorie')) {
            $products = array_filter($products, fn ($p) => $p['category'] === $cat);
        }
        if ($max = $request->query('prix_max')) {
            $products = array_filter($products, fn ($p) => $p['price'] <= (int) $max);
        }
        if ($sort = $request->query('tri')) {
            usort($products, fn ($a, $b) => $sort === 'prix_desc'
                ? $b['price'] <=> $a['price']
                : $a['price'] <=> $b['price']);
        }

        return view('shop.index', [
            'products'   => $products,
            'categories' => DemoData::categories(),
            'active'     => $cat,
        ]);
    }

    public function show(string $slug)
    {
        $product = DemoData::find($slug);
        abort_if(! $product, 404);

        $similaires = array_slice(
            array_filter(DemoData::products(), fn ($p) => $p['category'] === $product['category'] && $p['slug'] !== $slug),
            0, 3
        );

        return view('shop.show', compact('product', 'similaires'));
    }
}
