@extends('layouts.app')

@section('title', 'Galerie — LA MAISON')
@section('meta_description', 'Découvrez toute notre galerie d’articles LA MAISON.')

@section('content')
<section class="cat-hero">
    <img class="cat-hero-bg" src="{{ asset('images/galerie.jpg') }}" alt="Galerie produits LA MAISON" loading="lazy">
    <div class="cat-hero-overlay"></div>
    <div class="container cat-hero-content">
        <span class="eyebrow"> Collection</span>
        <h1>Galerie</h1>
        <p class="lead">Tous nos articles, sélectionnés pour inspirer votre prochain achat.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow">Notre sélection</span>
                <h2>Tous les articles</h2>
            </div>
        </div>

        @if($products->count())
            <div class="product-grid quatre">
                @foreach($products as $p)
                    @include('shop._card', ['p' => $p])
                @endforeach
            </div>
        @else
            <p>Aucun article n’est disponible pour le moment.</p>
        @endif
    </div>
</section>
@endsection
