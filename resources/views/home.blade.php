@extends('layouts.app')

@section('title', 'LA MAISON — Mode béninoise, robes et accessoires')

@section('content')

{{-- Héros --}}
<section class="hero">
    <video class="hero-bg" autoplay muted loop playsinline preload="metadata"
           poster="{{ asset('images/olori.jpeg') }}">
        <source src="{{ asset('videos/mode.mp4') }}" type="video/mp4">
    </video>
    <div class="hero-overlay"></div>
    <div class="inner">
        <div class="hero-content">
            <span class="eyebrow">Nouvelle collection · Été {{ date('Y') }}</span>
            <h1>L'élégance,<br><em>l'authenticité</em>,<br>la modernité.</h1>
            <p class="lead">Des pièces dessinées et confectionnées à Cotonou, pensées pour vous accompagner du quotidien aux grandes occasions.</p>
            <div class="hero-cta">
                <a class="btn btn-solid" href="{{ route('shop.index') }}">Découvrir la collection</a>
                <a class="hero-link" href="{{ route('about') }}">Notre histoire <span class="material-symbols-outlined" style="font-size:18px">arrow_forward</span></a>
            </div>
        </div>
    </div>
    <span class="scroll-cue">Défiler</span>
</section>

{{-- Réassurance --}}
<section class="reassurance reveal">
    <div class="inner">
        <div class="item"><span class="material-symbols-outlined">local_shipping</span><strong>Livraison Bénin & international</strong><span>Suivi de commande en temps réel</span></div>
        <div class="item"><span class="material-symbols-outlined">verified_user</span><strong>Paiement sécurisé</strong><span>KKiaPay — Mobile Money, carte bancaire</span></div>
        <div class="item"><span class="material-symbols-outlined">payments</span><strong>Paiement à la livraison</strong><span>Disponible selon la zone de livraison</span></div>
    </div>
</section>

{{-- Catégories --}}
<section class="section reveal">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow">Explorer</span>
                <h2>Nos catégories</h2>
            </div>
        </div>
        @php
            $catImages = [
                'robes' => 'images/categories/robes.jpg',
                'accessoires' => 'images/categories/accessoires.jpg',
                'collection-ete' => 'images/categories/ete.jpg',
            ];
        @endphp
        <div class="cat-grid">
            @foreach($categories as $slug => $label)
                <a class="cat-card" href="{{ route('shop.index', ['categorie' => $slug]) }}">
                    @if(isset($catImages[$slug]))
                        <img class="cat-img" src="{{ asset($catImages[$slug]) }}" alt="{{ $label }}" loading="lazy">
                    @else
                        <div class="ph ph-{{ ['robes' => 'terra', 'accessoires' => 'rose', 'collection-ete' => 'vert'][$slug] ?? 'sable' }}">{{ mb_substr($label, 0, 1) }}</div>
                    @endif
                    <span class="label">{{ $label }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Nouveautés --}}
<section class="section reveal" style="padding-top:0">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow">Fraîchement arrivées</span>
                <h2>Nouveautés</h2>
            </div>
            <a class="link-more" href="{{ route('shop.index') }}">Voir toute la boutique</a>
        </div>
        <div class="product-grid">
            @foreach($selection as $p)
                @include('shop._card', ['p' => $p])
            @endforeach
        </div>
    </div>
</section>

{{-- Bandeau éditorial --}}
<section class="editorial reveal">
    <div class="inner">
        <span class="eyebrow">Notre histoire</span>
        <h2>« Chaque pièce raconte un savoir-faire transmis de main en main. »</h2>
        <p>Découvrez l'univers de la maison, ses valeurs et ses artisanes partenaires.</p>
        <a class="btn" style="border-color:#F4F1E9;color:#F4F1E9" href="{{ route('about') }}">À propos de la maison</a>
    </div>
</section>

@endsection
