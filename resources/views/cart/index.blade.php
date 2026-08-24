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
                                    <td class="cart-thumb"><div class="ph ph-{{ $item['product']['tone'] }}">{{ mb_substr($item['product']['name'], 0, 1) }}</div></td>
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
                    <div class="row"><span>Sous-total</span><span>{{ number_format($subtotal, 0, ',', ' ') }} FCFA</span></div>
                    <div class="row"><span>Livraison (Cotonou)</span><span>{{ number_format($shipping, 0, ',', ' ') }} FCFA</span></div>
                    <div class="row total"><span>Total</span><span>{{ number_format($subtotal + $shipping, 0, ',', ' ') }} FCFA</span></div>
                    <div class="field" style="margin:18px 0">
                        <label for="promo">Code promo</label>
                        <input type="text" id="promo" placeholder="ETE2026">
                    </div>
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
