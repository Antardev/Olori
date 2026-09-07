@extends('layouts.app')

@section('title', 'Commande — LA MAISON')

@section('content')
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow">Étape 2 sur 3 — Adresse & paiement</span>
                <h2>Finaliser ma commande</h2>
            </div>
        </div>

        <form method="POST" action="{{ route('checkout.store') }}" class="checkout-layout" id="checkout-form">
            @csrf
            <div>
                <h3 style="margin-bottom:16px">Adresse de livraison</h3>
                <div class="form-grid">
                    <div class="field"><label for="name">Nom complet</label><input id="name" name="name" required placeholder="Aïcha Hounkpatin"></div>
                    <div class="field"><label for="phone">Téléphone</label><input id="phone" name="phone" type="tel" required placeholder="+229 97 00 00 00"></div>
                    <div class="field full"><label for="email">Email</label><input id="email" name="email" type="email" required placeholder="nom@exemple.com"></div>
                    <div class="field full"><label for="address">Adresse</label><input id="address" name="address" required placeholder="Quartier, rue, repère"></div>
                    <div class="field"><label for="city">Ville</label><input id="city" name="city" value="Cotonou" required></div>
                </div>

                <h3 style="margin:32px 0 4px">Paiement</h3>
                <div class="pay-options">
                    <label>
                        <input type="radio" name="payment" value="kkiapay" checked>
                        <span><strong>KKiaPay</strong><small>Mobile Money (MTN, Moov) et carte bancaire — paiement sécurisé.</small></span>
                    </label>
                </div>

                <button class="btn btn-terra" type="submit">Payer {{ number_format($subtotal - $discount + $shipping, 0, ',', ' ') }} FCFA</button>
            </div>

            <aside class="summary">
                <h3 style="margin-bottom:14px">Votre commande</h3>
                @foreach($items as $item)
                    <div class="row"><span>{{ $item['product']['name'] }} × {{ $item['qty'] }}</span><span>{{ number_format($item['line'], 0, ',', ' ') }} FCFA</span></div>
                @endforeach
                <div class="row"><span>Livraison</span><span>{{ number_format($shipping, 0, ',', ' ') }} FCFA</span></div>
                @if($discount)
                    <div class="row"><span>Remise{{ $promotion ? ' ('.$promotion->code.')' : '' }}</span><span>-{{ number_format($discount, 0, ',', ' ') }} FCFA</span></div>
                @endif
                <div class="row total"><span>Total</span><span>{{ number_format($subtotal - $discount + $shipping, 0, ',', ' ') }} FCFA</span></div>
            </aside>
        </form>
    </div>
</section>

{{--
    Intégration KKiaPay (production) :

    1. Charger le widget :  <script src="https://cdn.kkiapay.me/k.js"></script>
    2. Sur soumission du formulaire, ouvrir le widget :

        openKkiapayWidget({
            amount: {{ $subtotal + $shipping }},
            key: 'VOTRE_CLE_PUBLIQUE',
            sandbox: true,           // false en production
            phone: document.getElementById('phone').value,
        });
        addSuccessListener(function (response) {
            // Envoyer response.transactionId au serveur pour vérification
            // (CheckoutController@store → SDK PHP KKiaPay verifyTransaction)
        });

    Documentation : https://docs.kkiapay.me
--}}
@endsection
