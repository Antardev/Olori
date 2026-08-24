@extends('layouts.app')

@php
    $sizes  = $product['sizes'] ?: ['Unique'];
    $colors = $product['colors'] ?: [];
@endphp

@section('title', $product['name'].' — LA MAISON')
@section('meta_description', $product['description']
    ? mb_substr($product['description'], 0, 150)
    : $product['name'].' — '.$product->category_label.' chez LA MAISON, maison de mode béninoise.')

@section('content')
<section class="section">
    <div class="container">
        <div class="product-page">

            <div class="gallery">
                @if($product['image'])
                    <img class="product-img main-img" src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}">
                @else
                    <div class="ph ph-{{ $product['tone'] }} main-ph">{{ mb_substr($product['name'], mb_strpos($product['name'], ' ') + 1, 1) }}</div>
                    <div class="thumbs">
                        <div class="ph ph-{{ $product['tone'] }}">1</div>
                        <div class="ph ph-sable">2</div>
                        <div class="ph ph-{{ $product['tone'] }}">3</div>
                        <div class="ph ph-sable">4</div>
                    </div>
                @endif
            </div>

            <div class="pp-info">
                <span class="eyebrow">{{ $product->category_label }}</span>
                <h1>{{ $product['name'] }}</h1>
                @if($product['reviews'] > 0)
                    <p class="pp-rating">★ {{ number_format($product['rating'], 1, ',') }} · {{ $product['reviews'] }} avis clients</p>
                @else
                    <p class="pp-rating">Nouveauté — soyez la première personne à donner votre avis</p>
                @endif
                <p class="pp-price">
                    {{ number_format($product['price'], 0, ',', ' ') }} FCFA
                    @if($product['old_price'])
                        <span class="old">{{ number_format($product['old_price'], 0, ',', ' ') }} FCFA</span>
                    @endif
                </p>
                @if($product['stock'] > 3)
                    <p class="stock-ok">✓ En stock — expédié sous 48 h</p>
                @elseif($product['stock'] > 0)
                    <p class="stock-low">Plus que {{ $product['stock'] }} en stock</p>
                @else
                    <p class="stock-low">Rupture de stock</p>
                @endif

                <form method="POST" action="{{ route('cart.add', $product['slug']) }}">
                    @csrf

                    <p class="opt-label">Taille</p>
                    <div class="sizes">
                        @foreach($sizes as $i => $size)
                            <label><input type="radio" name="size" value="{{ $size }}" @checked($i === 0)><span>{{ $size }}</span></label>
                        @endforeach
                    </div>

                    @if($colors)
                        <p class="opt-label">Coloris</p>
                        <div class="swatches">
                            @foreach($colors as $i => $color)
                                <span class="swatch {{ $i === 0 ? 'selected' : '' }}" style="background: {{ $color }}" data-color="{{ $color }}" role="button" tabindex="0" aria-label="Coloris {{ $i + 1 }}"></span>
                            @endforeach
                            <input type="hidden" name="color" id="color-input" value="{{ $colors[0] }}">
                        </div>
                    @endif

                    <div class="qty-row">
                        <input type="number" name="qty" value="1" min="1" max="{{ max($product['stock'], 1) }}" aria-label="Quantité">
                        <button class="btn btn-terra" type="submit" style="flex:1" @disabled($product['stock'] === 0)>Ajouter au panier</button>
                    </div>
                </form>

                <div class="accordion">
                    <details open>
                        <summary>Description & entretien</summary>
                        <div class="body">
                            @if($product['description'])
                                <p>{{ $product['description'] }}</p>
                            @endif
                            <p>Lavage à la main recommandé, repassage doux sur l'envers.</p>
                        </div>
                    </details>
                    <details>
                        <summary>Livraison & retours</summary>
                        <div class="body">Livraison à Cotonou sous 48 h (1 500 FCFA), au Bénin sous 3 à 5 jours, à l'international sous 7 à 12 jours. Retours acceptés sous 7 jours.</div>
                    </details>
                    <details>
                        <summary>Paiement</summary>
                        <div class="body">Paiement sécurisé par KKiaPay (Mobile Money MTN & Moov, carte bancaire) ou paiement à la livraison selon la zone.</div>
                    </details>
                </div>
            </div>
        </div>

        @if(count($similaires))
            <div class="section-head" style="margin-top:72px">
                <div>
                    <span class="eyebrow">Vous aimerez aussi</span>
                    <h2>Produits similaires</h2>
                </div>
            </div>
            <div class="product-grid" style="grid-template-columns:repeat(3,1fr)">
                @foreach($similaires as $p)
                    @include('shop._card', ['p' => $p])
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
