@extends('layouts.app')

@section('title', 'Boutique — LA MAISON')

@section('content')
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow">Boutique</span>
                <h2>{{ $active ? ($categories[$active] ?? 'Catalogue') : 'Tout le catalogue' }}</h2>
            </div>
        </div>

        <div class="shop-layout">
            <aside class="filters">
                <h3>Catégories</h3>
                <ul>
                    <li><a href="{{ route('shop.index') }}" class="{{ ! $active ? 'active' : '' }}">Tout voir</a></li>
                    @foreach($categories as $slug => $label)
                        <li><a href="{{ route('shop.index', ['categorie' => $slug]) }}" class="{{ $active === $slug ? 'active' : '' }}">{{ $label }}</a></li>
                    @endforeach
                </ul>

                <h3>Filtrer</h3>
                <form method="GET" action="{{ route('shop.index') }}">
                    @if($active)<input type="hidden" name="categorie" value="{{ $active }}">@endif
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
                    <p>Aucun article ne correspond à ces filtres. <a href="{{ route('shop.index') }}" style="text-decoration:underline">Réinitialiser la recherche</a></p>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
