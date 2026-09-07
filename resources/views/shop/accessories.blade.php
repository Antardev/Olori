@extends('layouts.app')

@section('title', 'Accessoires — LA MAISON')
@section('meta_description', 'Découvrez les accessoires LA MAISON pour Hommes, Femmes et styles mixtes.')

@section('content')
<section class="cat-hero">
    <img class="cat-hero-bg" src="{{ asset('images/Accesoires/Accessoires.jpg') }}" alt="Accessoires" loading="lazy">
    <div class="cat-hero-overlay"></div>
    <div class="container cat-hero-content">
        <span class="eyebrow">Collection</span>
        <h1>Accessoires</h1>
        <p class="lead">Des pièces artisanales pour compléter chaque silhouette.</p>
    </div>
</section>

<section class="section">
    <div class="container">
        {{-- <nav class="cat-switch" aria-label="Collections">
            <a href="{{ route('shop.category', 'hommes') }}">Hommes</a>
            <a href="{{ route('shop.category', 'femmes') }}">Femmes</a>
            <a href="{{ route('shop.accessories') }}" class="active">Accessoires</a>
        </nav> --}}

        <div class="shop-layout">
            <aside class="filters">
                <h3>Filtrer</h3>
                <div class="field">
                    <span class="form-label">Pour qui ?</span>
                    <div class="filter-links">
                        <a href="{{ route('shop.accessories') }}" class="{{ !in_array($gender, ['hommes', 'femmes', 'mixtes'], true) ? 'active' : '' }}">Mixte</a>
                        <a href="{{ route('shop.accessories', ['genre' => 'hommes']) }}" class="{{ $gender === 'hommes' ? 'active' : '' }}">Hommes</a>
                        <a href="{{ route('shop.accessories', ['genre' => 'femmes']) }}" class="{{ $gender === 'femmes' ? 'active' : '' }}">Femmes</a>
                        <a href="{{ route('shop.accessories', ['genre' => 'mixtes']) }}" class="{{ $gender === 'mixtes' ? 'active' : '' }}">Mixtes</a>
                    </div>
                </div>
            </aside>

            <div>
                <div class="toolbar">
                    <span>{{ count($products) }} accessoire{{ count($products) > 1 ? 's' : '' }}</span>
                </div>
                @if(count($products))
                    <div class="product-grid trois">
                        @foreach($products as $p)
                            @include('shop._card', ['p' => $p])
                        @endforeach
                    </div>
                @else
                    <p>Aucun accessoire ne correspond à ce filtre.</p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
