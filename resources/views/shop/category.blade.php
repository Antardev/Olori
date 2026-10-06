@extends('layouts.app')

@section('title', $label.' — LA MAISON')
@section('meta_description', $meta['intro'] ?: 'Découvrez la sélection '.$label.' de LA MAISON.')

@section('content')

{{-- Bandeau de la catégorie --}}
<section class="cat-hero">
    @if($meta['image'])
        <img class="cat-hero-bg" src="{{ asset($meta['image']) }}" alt="{{ $label }}" loading="lazy">
    @else
        <div class="cat-hero-bg ph ph-{{ $meta['tone'] }}"></div>
    @endif
    <div class="cat-hero-overlay"></div>
    <div class="container cat-hero-content">
        <span class="eyebrow">Collection</span>
        <h1>{{ $label }}</h1>
        @if($meta['intro'])
            <p class="lead">{{ $meta['intro'] }}</p>
        @endif
    </div>
</section>

<section class="section">
    <div class="container">

        {{-- Passage d'une collection à l'autre --}}
        <nav class="cat-switch" aria-label="Collections">
            <h2>Choisir sa collection</h2>
            @foreach($categories as $slug => $name)
                <a href="{{ route('shop.category', $slug) }}" class="{{ $active === $slug ? 'active' : '' }}">{{ $name }}</a>
            @endforeach
        </nav>

        <div class="category-filter" data-category-filter>
            <span class="category-filter-label">Catégories</span>
            <div class="category-filter-list" role="group" aria-label="Filtrer par catégorie">
                <button type="button" class="category-filter-option {{ ! $subcategory ? 'active' : '' }}" data-category-value="" aria-pressed="{{ ! $subcategory ? 'true' : 'false' }}">
                    Toutes
                </button>
                @foreach($subcategories as $slug => $name)
                    <button type="button" class="category-filter-option {{ $subcategory === $slug ? 'active' : '' }}" data-category-value="{{ $slug }}" aria-pressed="{{ $subcategory === $slug ? 'true' : 'false' }}">
                        {{ $name }}
                    </button>
                @endforeach
            </div>
            <form class="category-filter-form" method="GET" action="{{ route('shop.category', $active) }}">
                <input type="hidden" name="sous_categorie" value="{{ $subcategory ?? '' }}">
                @if(request('tri'))
                    <input type="hidden" name="tri" value="{{ request('tri') }}">
                @endif
            </form>
        </div>

        <div>
                <div class="toolbar">
                    <span>{{ count($products) }} article{{ count($products) > 1 ? 's' : '' }}</span>
                </div>
                @if(count($products))
                    <div class="product-grid quatre">
                        @foreach($products as $p)
                            @include('shop._card', ['p' => $p])
                        @endforeach
                    </div>
                @else
                    <p>Aucun article ne correspond à ces filtres. <a class="lien-souligne" href="{{ route('shop.category', $active) }}">Voir toute la catégorie {{ $label }}</a></p>
                @endif
        </div>
    </div>
</section>
@endsection
