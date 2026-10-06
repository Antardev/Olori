@extends('layouts.app')

@php
    $sizes  = $product['sizes'] ?: ['Unique'];
    $colors = $product['colors'] ?: [];
    $gallery = array_values(array_filter(array_merge([$product['image']], $product['images'] ?? [])));
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
                @if($gallery)
                    <img class="product-img main-img" src="{{ asset($gallery[0]) }}" alt="{{ $product['name'] }}">
                    @if(count($gallery) > 1)
                        <div class="thumbs">
                            @foreach($gallery as $index => $image)
                                <button class="thumb {{ $index === 0 ? 'active' : '' }}" type="button" data-image="{{ asset($image) }}" aria-label="Voir la photo {{ $index + 1 }}">
                                    <img src="{{ asset($image) }}" alt="" loading="lazy">
                                </button>
                            @endforeach
                        </div>
                    @endif
                @else
                    <div class="ph ph-sable main-ph">{{ mb_substr($product['name'], mb_strpos($product['name'], ' ') + 1, 1) }}</div>
                    <div class="thumbs">
                        <div class="ph ph-sable">1</div>
                        <div class="ph ph-sable">2</div>
                        <div class="ph ph-sable">3</div>
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
                        <div class="sizes color-options">
                            @foreach($colors as $i => $color)
                                <label>
                                    <input type="radio" name="color" value="{{ $color }}" @checked($i === 0)>
                                    <span>{{ $color }}</span>
                                </label>
                            @endforeach
                        </div>
                    @endif

                    <div class="qty-row">
                        <input type="number" name="qty" value="1" min="1" max="{{ max($product['stock'], 1) }}" aria-label="Quantité">
                        <button class="btn btn-terra" type="submit" @disabled($product['stock'] === 0)>Ajouter au panier</button>
                    </div>
                </form>

                <div class="accordion">
                    <details open>
                        <summary>Description & entretien</summary>
                        <div class="body">
                            @if($product['description'])
                                <p>{{ $product['description'] }}</p>
                            @endif
                            {{-- <p>Lavage à la main recommandé, repassage doux sur l'envers.</p> --}}
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
            <div class="section-head suggestions">
                <div>
                    <span class="eyebrow">Vous aimerez aussi</span>
                    <h2>Produits similaires</h2>
                </div>
            </div>
            <div class="product-grid">
                @foreach($similaires as $p)
                    @include('shop._card', ['p' => $p])
                @endforeach
            </div>
        @endif
    </div>
</section>
<script>
document.querySelectorAll('.thumb').forEach(function (thumb) {
    thumb.addEventListener('click', function () {
        const gallery = thumb.closest('.gallery');
        gallery.querySelector('.main-img').src = thumb.dataset.image;
        gallery.querySelectorAll('.thumb').forEach(item => item.classList.remove('active'));
        thumb.classList.add('active');
    });
});
</script>
@endsection
