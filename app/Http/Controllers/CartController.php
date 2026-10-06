<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        [$items, $subtotal] = $this->cart($request);
        $shipping = $subtotal > 0 ? 1500 : 0; // Zone Cotonou par défaut
        $promotion = $this->promotion($request);
        [$items, $discount, $hasEligibleItems] = self::applyPromotionToItems($items, $promotion);

        return view('cart.index', compact('items', 'subtotal', 'shipping', 'promotion', 'discount', 'hasEligibleItems'));
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

    public function applyPromotion(Request $request)
    {
        $data = $request->validate([
            'promo_code' => ['required', 'string', 'max:40'],
        ]);

        $promotion = Promotion::activeByCode($data['promo_code']);

        if (! $promotion) {
            return back()->withInput()->withErrors(['promo_code' => 'Ce code promo est invalide ou expiré.']);
        }

        [$items] = self::cart($request);
        [, , $hasEligibleItems] = self::applyPromotionToItems($items, $promotion);

        if (! $hasEligibleItems) {
            return back()->withInput()->withErrors(['promo_code' => 'Ce code promo ne s’applique à aucun article de votre panier.']);
        }

        $request->session()->put('promo_code', $promotion->code);

        return back()->with('status', 'Code promo appliqué.');
    }

    public function removePromotion(Request $request)
    {
        $request->session()->forget('promo_code');

        return back()->with('status', 'Code promo retiré.');
    }

    public static function promotion(Request $request): ?Promotion
    {
        $code = $request->session()->get('promo_code');

        if (! $code) {
            return null;
        }

        $promotion = Promotion::activeByCode($code);

        if (! $promotion) {
            $request->session()->forget('promo_code');
        }

        return $promotion;
    }

    public static function applyPromotionToItems(array $items, ?Promotion $promotion): array
    {
        $discount = 0;
        $hasEligibleItems = false;

        foreach ($items as &$item) {
            $isEligible = $promotion && $promotion->appliesTo($item['product']);
            $lineDiscount = $isEligible
                ? (int) floor($item['line'] * $promotion->discount_percent / 100)
                : 0;

            $item['discount'] = $lineDiscount;
            $item['discounted_line'] = $item['line'] - $lineDiscount;
            $discount += $lineDiscount;
            $hasEligibleItems = $hasEligibleItems || (bool) $isEligible;
        }
        unset($item);

        return [$items, $discount, $hasEligibleItems];
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
