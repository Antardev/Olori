@extends('layouts.app')

@section('title', 'LA MAISON — Mode béninoise, robes et accessoires')

@section('content')

{{-- Héros --}}
<section class="hero">
    <video class="hero-bg" autoplay muted loop playsinline preload="none"
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
                <a class="btn btn-solid" href="#categories">Découvrir la collection</a>
                <a class="hero-link" href="{{ route('about') }}">Notre histoire <span class="material-symbols-outlined">arrow_forward</span></a>
            </div>
        </div>
    </div>
    <span class="scroll-cue">Défiler</span>
</section>

{{-- Réassurance --}}
<section class="reassurance reveal">
    <div class="inner">
        <div class="item">
            <span class="material-symbols-outlined">local_shipping</span>
            <strong>Livraison Bénin &amp; international</strong>
            <span>Suivi de commande en temps réel</span>
        </div>
        <div class="item">
            <span class="material-symbols-outlined">verified_user</span>
            <strong>Paiement sécurisé</strong>
            <span>KKiaPay — Mobile Money, carte bancaire</span>
        </div>
        <div class="item">
            <span class="material-symbols-outlined">autorenew</span>
            <strong>Retours faciles</strong>
            <span>Échange sous 14 jours</span>
        </div>
    </div>
</section>

{{-- Catégories --}}
<section class="section section-lg reveal" id="categories">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow">Explorer</span>
                <h2>Nos <em>collections</em></h2>
            </div>
        </div>
        <div class="cat-grid">
            @foreach($categories as $slug => $label)
                @php($catMeta = \App\Support\DemoData::categoryMeta($slug))
                <a class="cat-card" href="{{ route('shop.category', $slug) }}">
                    @if($catMeta['image'])
                        <img class="cat-img" src="{{ asset($catMeta['image']) }}" alt="{{ $label }}" loading="lazy">
                    @else
                        <div class="ph ph-{{ $catMeta['tone'] }}">{{ mb_substr($label, 0, 1) }}</div>
                    @endif
                    <span class="label">{{ $label }}</span>
                </a>
            @endforeach

        </div>
    </div>
</section>

{{-- Nouveautés --}}
<section class="section section-alt reveal">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow">Fraîchement arrivées</span>
                <h2>Nouveautés</h2>
            </div>
            <a class="link-more" href="#categories">Explorer les catégories</a>
        </div>
        <div class="product-grid">
            @foreach($selection as $p)
                @include('shop._card', ['p' => $p])
            @endforeach
        </div>
    </div>
</section>

{{-- La maison en chiffres --}}
<section class="section section-tight section-alt reveal">
    <div class="container">
        <div class="chiffres">
            <div class="chiffre">
                <span class="valeur">500<sup>+</sup></span>
                <span class="libelle">Pièces confectionnées</span>
            </div>
            <div class="chiffre">
                <span class="valeur">1200<sup>+</sup></span>
                <span class="libelle">Client</span>
            </div>
            <div class="chiffre">
                <span class="valeur">4,9<sup>/5</sup></span>
                <span class="libelle">Note moyenne</span>
            </div>
            <div class="chiffre">
                <span class="valeur">5</span>
                <span class="libelle">Pays de livraison</span>
            </div>
        </div>
    </div>
</section>
{{-- Avis clients --}}
<section class="section reveal">
    <div class="container">
        <div class="section-head centre">
            <span class="eyebrow">Ils nous font confiance</span>
            <h2>Ce que disent nos <em>clients</em></h2>
            @include('partials.wax-rule', ['serre' => true])
        </div>
        <div class="temoignages">
            @forelse($avis as $review)
                <figure class="temoignage">
                    <div class="etoiles" aria-label="{{ $review->rating }} étoiles sur 5">
                        @for($i = 1; $i <= 5; $i++)
                            <span class="material-symbols-outlined">{{ $i <= $review->rating ? 'star' : 'star_border' }}</span>
                        @endfor
                    </div>
                    <blockquote>{{ $review->comment }}</blockquote>
                    <figcaption><span class="nom">{{ $review->name }}</span>@if($review->city)<span class="ville">{{ $review->city }}</span>@endif</figcaption>
                </figure>
            @empty
                <p class="empty-state">Soyez la première personne à partager votre expérience.</p>
            @endforelse
        </div>
        <div class="avis-form">
            <div>
                <span class="eyebrow">Votre expérience</span>
                <h3>Partagez votre avis</h3>
            </div>
            @if($errors->any())
                <div class="alert" role="alert">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="{{ route('reviews.store') }}">
                @csrf
                <div class="form-grid">
                    <div class="field">
                        <label for="review-name">Nom</label>
                        <input id="review-name" name="name" type="text" value="{{ old('name') }}" required maxlength="80">
                    </div>
                    <div class="field">
                        <label for="review-city">Ville <span>(facultatif)</span></label>
                        <input id="review-city" name="city" type="text" value="{{ old('city') }}" maxlength="80">
                    </div>
                    <div class="field">
                        <label for="review-rating">Note</label>
                        <select id="review-rating" name="rating" required>
                            @for($rating = 5; $rating >= 1; $rating--)
                                <option value="{{ $rating }}" @selected((int) old('rating', 5) === $rating)>{{ $rating }} étoile{{ $rating > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="field full">
                        <label for="review-comment">Votre commentaire</label>
                        <textarea id="review-comment" name="comment" rows="4" minlength="10" maxlength="1000" required>{{ old('comment') }}</textarea>
                    </div>
                </div>
                <button class="btn btn-terra" type="submit">Publier mon avis</button>
            </form>
        </div>
    </div>
</section>



{{-- Bandeau éditorial --}}
<section class="editorial reveal">
    <div class="inner">
        @include('partials.wax-rule', ['serre' => true])
        <span class="eyebrow">Notre histoire</span>
        <h2>Chaque pièce raconte un savoir-faire <em>transmis de main en main</em>.</h2>
        <p>Découvrez l'univers de la maison, ses valeurs et ses artisanes partenaires.</p>
        <a class="btn btn-clair" href="{{ route('about') }}">À propos de la maison</a>
    </div>
</section>

@endsection
