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
        <span class="eyebrow">Catégorie</span>
        <h1>{{ $label }}</h1>
        @if($meta['intro'])
            <p class="lead">{{ $meta['intro'] }}</p>
        @endif
    </div>
</section>

<section class="section">
    <div class="container">

        {{-- Passage d'une catégorie à l'autre --}}
        <nav class="cat-switch" aria-label="Catégories">
            @foreach($categories as $slug => $name)
                <a href="{{ route('shop.category', $slug) }}" class="{{ $active === $slug ? 'active' : '' }}">{{ $name }}</a>
            @endforeach
        </nav>

        <div class="shop-layout">
            <aside class="filters">
                <h3>Filtrer</h3>
                <form method="GET" action="{{ route('shop.category', $active) }}">
                    <div class="field" style="margin-bottom:14px">
                        <label for="prix_max">Prix maximum (FCFA)</label>
                        <input type="number" id="prix_max" name="prix_max" step="1000" min="0" value="{{ request('prix_max') }}" placeholder="30 000">
                    </div>
                    <div class="field" style="margin-bottom:14px">
                        <label for="tri">Trier par</label>
                        <select id="tri" name="tri">
                            <option value="">Pertinence</option>
                            <option value="prix_asc" @selected(request('tri') === 'prix_asc')>Prix croissant</option>
                            <option value="prix_desc" @selected(request('tri') === 'prix_desc')>Prix décroissant</option>
                        </select>
                    </div>
                    <button class="btn btn-sm btn-block" type="submit">Appliquer</button>
                </form>

                @if(request()->hasAny(['prix_max', 'tri']))
                    <p style="margin-top:14px"><a href="{{ route('shop.category', $active) }}" style="text-decoration:underline">Réinitialiser les filtres</a></p>
                @endif
            </aside>

            <div>
                <div class="toolbar">
                    <span>{{ count($products) }} article{{ count($products) > 1 ? 's' : '' }}</span>
                </div>
                @if(count($products))
                    <div class="product-grid" style="grid-template-columns:repeat(3,1fr)">
                        @foreach($products as $p)
                            @include('shop._card', ['p' => $p])
                        @endforeach
                    </div>
                @else
                    <p>Aucun article ne correspond à ces filtres. <a href="{{ route('shop.category', $active) }}" style="text-decoration:underline">Voir toute la catégorie {{ $label }}</a></p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
