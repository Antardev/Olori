@extends('layouts.app')

@section('title', 'À propos — LA MAISON')

@section('content')
<section class="hero">
    <video class="hero-bg" autoplay muted loop playsinline preload="metadata"
           poster="{{ asset('images/olori.jpeg') }}">
        <source src="{{ asset('videos/mode2.mp4') }}" type="video/mp4">
    </video>
    <div class="hero-overlay"></div>
    <div class="inner">
        <div class="hero-content">
            <span class="eyebrow">Notre histoire</span>
            <h1>Une maison,<br>un <em>savoir-faire</em>.</h1>
            <p class="lead">Née à Cotonou, La Maison célèbre l'artisanat béninois à travers des pièces contemporaines, confectionnées avec exigence et passion.</p>
        </div>
    </div>
</section>

<section class="section">
    <div class="container" style="max-width:820px">
        <span class="eyebrow">Nos valeurs</span>
        <h2 style="margin-bottom:20px">Élégance, authenticité, modernité</h2>
        <p style="margin-bottom:16px">Chaque collection est imaginée dans notre atelier de Cotonou. Nous travaillons avec des artisanes partenaires, sélectionnons des tissus de qualité — wax premium, coton grand teint, soies mélangées — et produisons en séries courtes pour garantir le soin apporté à chaque pièce.</p>
        <p style="margin-bottom:16px">Notre ambition : porter la création béninoise au-delà des frontières, sans jamais renoncer à ce qui fait son âme.</p>
        <a class="btn btn-solid" href="{{ route('shop.index') }}" style="margin-top:12px">Découvrir les collections</a>
    </div>
</section>

<section class="section" style="padding-top:0">
    <div class="container">
        <div class="cat-grid">
            <div><div class="ph ph-terra">1</div><p style="margin-top:10px"><strong>L'atelier</strong> — coupe et confection à Cotonou.</p></div>
            <div><div class="ph ph-rose">2</div><p style="margin-top:10px"><strong>Les tissus</strong> — sélectionnés chez nos fournisseurs partenaires.</p></div>
            <div><div class="ph ph-vert">3</div><p style="margin-top:10px"><strong>Les mains</strong> — un réseau d'artisanes passionnées.</p></div>
        </div>
    </div>
</section>
@endsection
