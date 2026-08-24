<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        [$items, $subtotal] = $this->cart($request);
        $shipping = $subtotal > 0 ? 1500 : 0; // Zone Cotonou par défaut

        return view('cart.index', compact('items', 'subtotal', 'shipping'));
    }

    public function add(Request $request, string $slug)
    {
        $cart = $request->session()->get('cart', []);
        $cart[$slug] = ($cart[$slug] ?? 0) + max(1, (int) $request->input('qty', 1));
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('status', 'Article ajouté au panier');
    }

    public function remove(Request $request, string $slug)
    {
        $cart = $request->session()->get('cart', []);
        unset($cart[$slug]);
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('status', 'Article retiré du panier');
    }

    public static function cart(Request $request): array
    {
        $items = [];
        $subtotal = 0;

        foreach ($request->session()->get('cart', []) as $slug => $qty) {
            if ($product = Product::published()->where('slug', $slug)->first()) {
                $items[] = ['product' => $product, 'qty' => $qty, 'line' => $product->price * $qty];
                $subtotal += $product->price * $qty;
            }
        }

        return [$items, $subtotal];
    }
}
