@extends('layouts.app')

@section('title', 'Mon panier — LA MAISON')

@section('content')
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow">Commande</span>
                <h2>Mon panier</h2>
            </div>
        </div>

        @if(count($items))
            <div class="cart-layout">
                <div>
                    <table class="cart-table">
                        <thead>
                            <tr><th></th><th>Article</th><th>Prix</th><th>Qté</th><th>Total</th><th></th></tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td class="cart-thumb"><div class="ph ph-sable">{{ mb_substr($item['product']['name'], 0, 1) }}</div></td>
                                    <td><a href="{{ route('shop.show', $item['product']['slug']) }}">{{ $item['product']['name'] }}</a></td>
                                    <td>{{ number_format($item['product']['price'], 0, ',', ' ') }} FCFA</td>
                                    <td>{{ $item['qty'] }}</td>
                                    <td><strong>{{ number_format($item['line'], 0, ',', ' ') }} FCFA</strong></td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.remove', $item['product']['slug']) }}">
                                            @csrf
                                            <button class="btn btn-sm" type="submit" aria-label="Retirer {{ $item['product']['name'] }}">✕</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <aside class="summary">
                    <h3 style="margin-bottom:14px">Récapitulatif</h3>
                    <form method="POST" action="{{ route('cart.promotion.apply') }}" style="margin-bottom:18px">
                        @csrf
                        <label for="promo_code">Code promo</label>
                        <div style="display:flex;gap:8px;margin-top:6px">
                            <input class="form-control" id="promo_code" name="promo_code" value="{{ session('promo_code') }}" placeholder="BIENVENUE">
                            <button class="btn btn-sm" type="submit">Appliquer</button>
                        </div>
                        @error('promo_code')<span class="field-error">{{ $message }}</span>@enderror
                    </form>
                    <div class="row"><span>Sous-total</span><span>{{ number_format($subtotal, 0, ',', ' ') }} FCFA</span></div>
                    @if($discount)
                        <div class="row"><span>Remise ({{ $promotion->code }})</span><span>-{{ number_format($discount, 0, ',', ' ') }} FCFA</span></div>
                        <form method="POST" action="{{ route('cart.promotion.remove') }}" style="margin:8px 0 14px">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-ghost" type="submit">Retirer le code promo</button>
                        </form>
                    @endif
                    <div class="row"><span>Livraison (Cotonou)</span><span>{{ number_format($shipping, 0, ',', ' ') }} FCFA</span></div>
                    <div class="row total"><span>Total</span><span>{{ number_format($subtotal - $discount + $shipping, 0, ',', ' ') }} FCFA</span></div>
                    <a class="btn btn-terra btn-block" href="{{ route('checkout.index') }}">Passer la commande</a>
                </aside>
            </div>
        @else
            <p>Votre panier est vide pour le moment.</p>
            <p style="margin-top:18px"><a class="btn" href="{{ route('home') }}#categories">Découvrir nos catégories</a></p>
        @endif
    </div>
</section>
@endsection
