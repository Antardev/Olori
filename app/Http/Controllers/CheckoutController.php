<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        [$items, $subtotal] = CartController::cart($request);

        if (empty($items)) {
            return redirect()->route('shop.index');
        }

        $shipping = 1500;

        return view('checkout.index', compact('items', 'subtotal', 'shipping'));
    }

    /**
     * Démo : enregistre la commande en session puis redirige vers la confirmation.
     *
     * En production :
     *  1. Valider les champs (adresse, téléphone, zone de livraison).
     *  2. Créer la commande en base (statut "en attente").
     *  3. Déclencher le widget KKiaPay côté client (voir checkout/index.blade.php)
     *     puis vérifier la transaction côté serveur avec le SDK PHP KKiaPay :
     *     https://docs.kkiapay.me — \Kkiapay\Kkiapay::verifyTransaction($transactionId)
     *  4. Passer la commande en "payée" et envoyer l'email de confirmation.
     */
    public function store(Request $request)
    {
        $request->session()->put('last_order', [
            'ref'  => '#'.rand(1100, 9999),
            'name' => $request->input('name', 'Cliente'),
            'payment' => $request->input('payment', 'kkiapay'),
        ]);
        $request->session()->forget('cart');

        return redirect()->route('checkout.confirmation');
    }

    public function confirmation(Request $request)
    {
        $order = $request->session()->get('last_order');

        return $order ? view('checkout.confirmation', compact('order')) : redirect()->route('home');
    }
}
