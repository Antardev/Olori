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
                <a class="btn btn-solid" href="#categories">Découvrir la collection</a>
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
        {{-- <div class="item"><span class="material-symbols-outlined">payments</span><strong>Paiement à la livraison</strong><span>Disponible selon la zone de livraison</span></div> --}}
    </div>
</section>

{{-- Catégories --}}
<section class="section reveal" id="categories">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow">Explorer</span>
                <h2>Nos catégories</h2>
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
<section class="section reveal" style="padding-top:0">
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

{{-- Avis clients --}}
<section class="section reviews-section reveal" style="background:#fcf9f6;padding:60px 0;">
    <div class="container">
        <div class="section-head" style="text-align:center;margin-bottom:40px;">
            <span class="eyebrow">Ils nous font confiance</span>
            <h2>Ce que disent nos clients</h2>
        </div>
        <div class="reviews-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:30px;">
            <div class="review-card" style="background:#fff;padding:30px;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.05);">
                <div style="display:flex;gap:4px;color:#f5a623;margin-bottom:12px;">
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                </div>
                <p style="font-size:15px;line-height:1.6;color:#3d2c1e;font-style:italic;">"Une robe magnifique, des tissus de qualité et une finition parfaite. Je suis ravie de ma commande !"</p>
                <div style="margin-top:15px;display:flex;align-items:center;gap:12px;">
                    <div style="width:44px;height:44px;border-radius:50%;background:#e8ddd0;display:flex;align-items:center;justify-content:center;color:#8B7355;font-weight:600;">AC</div>
                    <div>
                        <div style="font-weight:600;color:#2c1810;">Amina C.</div>
                        <div style="font-size:13px;color:#8B7355;">Cotonou</div>
                    </div>
                </div>
            </div>
            <div class="review-card" style="background:#fff;padding:30px;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.05);">
                <div style="display:flex;gap:4px;color:#f5a623;margin-bottom:12px;">
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                </div>
                <p style="font-size:15px;line-height:1.6;color:#3d2c1e;font-style:italic;">"Le chemisier correspond parfaitement aux photos. Livraison rapide et service client au top !"</p>
                <div style="margin-top:15px;display:flex;align-items:center;gap:12px;">
                    <div style="width:44px;height:44px;border-radius:50%;background:#e8ddd0;display:flex;align-items:center;justify-content:center;color:#8B7355;font-weight:600;">PK</div>
                    <div>
                        <div style="font-weight:600;color:#2c1810;">Paul K.</div>
                        <div style="font-size:13px;color:#8B7355;">Porto-Novo</div>
                    </div>
                </div>
            </div>
            <div class="review-card" style="background:#fff;padding:30px;border-radius:16px;box-shadow:0 4px 20px rgba(0,0,0,0.05);">
                <div style="display:flex;gap:4px;color:#f5a623;margin-bottom:12px;">
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star_half</span>
                </div>
                <p style="font-size:15px;line-height:1.6;color:#3d2c1e;font-style:italic;">"J'adore le style unique des collections. Ça change des grandes enseignes, on sent le savoir-faire local."</p>
                <div style="margin-top:15px;display:flex;align-items:center;gap:12px;">
                    <div style="width:44px;height:44px;border-radius:50%;background:#e8ddd0;display:flex;align-items:center;justify-content:center;color:#8B7355;font-weight:600;">SB</div>
                    <div>
                        <div style="font-weight:600;color:#2c1810;">Sophie B.</div>
                        <div style="font-size:13px;color:#8B7355;">Abidjan</div>
                    </div>
                </div>
            </div>
        </div>
        <div style="text-align:center;margin-top:35px;">
            <a class="btn btn-outline" href="#" style="border:1px solid #8B7355;color:#8B7355;padding:10px 30px;border-radius:30px;text-decoration:none;">Voir tous les avis</a>
        </div>
    </div>
</section>

{{-- Statistiques --}}
<section class="section stats-section reveal" style="background:#f8f5f0;padding:60px 0;">
    <div class="container">
        <div class="section-head" style="text-align:center;margin-bottom:40px;">
            <span class="eyebrow">La maison en chiffres</span>
            <h2>Quelques repères</h2>
        </div>
        <div class="stats-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:30px;text-align:center;">
            <div class="stat-item">
                <span class="material-symbols-outlined" style="font-size:48px;color:#8B7355;">collections</span>
                <div class="stat-number" style="font-size:42px;font-weight:700;color:#2c1810;margin:10px 0 5px;">500+</div>
                <div class="stat-label" style="color:#6b5b4f;font-size:16px;">Pièces confectionnées</div>
            </div>
            <div class="stat-item">
                <span class="material-symbols-outlined" style="font-size:48px;color:#8B7355;">favorite</span>
                <div class="stat-number" style="font-size:42px;font-weight:700;color:#2c1810;margin:10px 0 5px;">1200+</div>
                <div class="stat-label" style="color:#6b5b4f;font-size:16px;">Clientes et clients satisfaits</div>
            </div>
            <div class="stat-item">
                <span class="material-symbols-outlined" style="font-size:48px;color:#8B7355;">star</span>
                <div class="stat-number" style="font-size:42px;font-weight:700;color:#2c1810;margin:10px 0 5px;">4.9/5</div>
                <div class="stat-label" style="color:#6b5b4f;font-size:16px;">Note moyenne</div>
            </div>
            <div class="stat-item">
                <span class="material-symbols-outlined" style="font-size:48px;color:#8B7355;">public</span>
                <div class="stat-number" style="font-size:42px;font-weight:700;color:#2c1810;margin:10px 0 5px;">15</div>
                <div class="stat-label" style="color:#6b5b4f;font-size:16px;">Pays de livraison</div>
            </div>
        </div>
    </div>
</section>

{{-- Bandeau éditorial --}}
<section class="editorial reveal" style="background:#c67a5c;background:linear-gradient(135deg,#c67a5c,#a8654a);">
    <div class="inner">
        <span class="eyebrow" style="color:#f5ede4;">Notre histoire</span>
        <h2 style="color:#fff;">« Chaque pièce raconte un savoir-faire transmis de main en main. »</h2>
        <p style="color:#f5ede4;">Découvrez l'univers de la maison, ses valeurs et ses artisanes partenaires.</p>
        <a class="btn" style="border-color:#fff;color:#fff;" href="{{ route('about') }}">À propos de la maison</a>
    </div>
</section>

@endsection
