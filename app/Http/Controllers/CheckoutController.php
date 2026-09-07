<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        [$items, $subtotal] = CartController::cart($request);

        if (empty($items)) {
            return redirect()->route('home');
        }

        $shipping = 1500;
        $promotion = CartController::promotion($request);
        $discount = $promotion ? (int) floor($subtotal * $promotion->discount_percent / 100) : 0;

        return view('checkout.index', compact('items', 'subtotal', 'shipping', 'discount', 'promotion'));
    }

    public function store(Request $request)
    {
        [$items, $subtotal] = CartController::cart($request);

        if (empty($items)) {
            return redirect()->route('home');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:160'],
            'address' => ['required', 'string', 'max:500'],
            'city' => ['required', 'string', 'max:100'],
            'payment' => ['required', 'in:kkiapay'],
        ]);

        $promoCode = $request->session()->get('promo_code');
        $promotion = CartController::promotion($request);
        if ($promoCode && ! $promotion) {
            return redirect()->route('cart.index')->withErrors(['promo_code' => 'Le code promo a expiré ou n’est plus actif.']);
        }
        $discount = $promotion ? (int) floor($subtotal * $promotion->discount_percent / 100) : 0;

        $shipping = 1500;
        $order = DB::transaction(function () use ($items, $data, $request, $promotion, $subtotal, $discount, $shipping) {
            foreach ($items as $item) {
                $quantity = (int) $item['qty'];
                $product = Product::query()->lockForUpdate()->find($item['product']->id);

                if (! $product || ! $product->is_published || $product->stock < $quantity) {
                    throw ValidationException::withMessages([
                        'stock' => "Le stock de « {$item['product']->name} » est insuffisant.",
                    ]);
                }

                $product->decrement('stock', $quantity);
            }

            $order = Order::create([
                'reference' => strtoupper(Str::random(8)),
                'user_id' => $request->user()?->id,
                'customer_name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'city' => $data['city'],
                'zone' => 'cotonou',
                'payment_method' => 'kkiapay',
                'promotion_code' => $promotion?->code,
                'status' => 'en_attente',
                'subtotal' => $subtotal,
                'discount' => $discount,
                'shipping' => $shipping,
                'total' => $subtotal - $discount + $shipping,
                'items' => $items,
            ]);

            if ($promotion) {
                $promotion->increment('uses_count');
            }

            return $order;
        });

        $request->session()->put('last_order', [
            'ref' => $order->ref,
            'name' => $order->customer_name,
            'payment' => $order->payment_method,
        ]);
        $request->session()->forget('cart');
        $request->session()->forget('promo_code');

        return redirect()->route('checkout.confirmation');
    }

    public function confirmation(Request $request)
    {
        $order = $request->session()->get('last_order');

        return $order ? view('checkout.confirmation', compact('order')) : redirect()->route('home');
    }
}
