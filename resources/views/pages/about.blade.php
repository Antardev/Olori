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
            <span class="eyebrow">OLORI · Cotonou</span>
            <h1>Le style comme<br>une <em>signature</em>.</h1>
            <p class="lead">Nous imaginons une mode libre, sensible et profondément ancrée dans le savoir-faire béninois.</p>
            <div class="hero-cta">
                <a class="btn btn-solid" href="{{ route('home') }}#categories">Découvrir nos collections</a>
                <a class="hero-link" href="#maison">Notre démarche <span class="material-symbols-outlined">arrow_downward</span></a>
            </div>
        </div>
    </div>
    <span class="scroll-cue">Faire défiler</span>
</section>

<section class="section about-intro" id="maison">
    <div class="container about-intro-grid">
        <div class="about-intro-title">
            <span class="eyebrow">Notre vision</span>
            <h2>Une mode qui a<br><em>quelque chose à dire.</em></h2>
        </div>
        <div class="about-intro-copy">
            <p class="about-lead">OLORI est née à Cotonou d'une envie simple : faire dialoguer la création contemporaine et la richesse de nos gestes.</p>
            <p>Chaque pièce est pensée comme une rencontre entre la matière, le mouvement et la personne qui la porte. Nous dessinons des silhouettes durables, expressives et faciles à habiter, loin des tendances qui passent.</p>
            <a class="link-more" href="{{ route('contact') }}">Nous contacter <span class="material-symbols-outlined">arrow_forward</span></a>
        </div>
    </div>
</section>

<section class="section section-alt about-values">
    <div class="container">
        <div class="section-head centre">
            <span class="eyebrow">Ce qui nous guide</span>
            <h2>Trois façons de faire <em>la différence</em></h2>
        </div>
        <div class="about-values-grid">
            <article class="about-value">
                <span class="about-value-number">01</span>
                <span class="material-symbols-outlined">auto_awesome</span>
                <h3>L'allure</h3>
                <p>Des lignes précises et des détails justes pour une élégance naturelle, jamais figée.</p>
            </article>
            <article class="about-value">
                <span class="about-value-number">02</span>
                <span class="material-symbols-outlined">texture</span>
                <h3>La matière</h3>
                <p>Des tissus choisis pour leur caractère, leur tenue et le plaisir qu'ils donnent au quotidien.</p>
            </article>
            <article class="about-value">
                <span class="about-value-number">03</span>
                <span class="material-symbols-outlined">diversity_3</span>
                <h3>La transmission</h3>
                <p>Un travail collectif qui valorise les artisanes et fait grandir les savoir-faire locaux.</p>
            </article>
        </div>
    </div>
</section>

<section class="section about-atelier">
    <div class="container about-atelier-grid">
        <div class="about-atelier-media">
            <img src="{{ asset('images/categories/femmes/femmes.jpg') }}" alt="Silhouette de la collection féminine Olori" loading="lazy">
            <span class="about-atelier-caption">Fabriqué avec intention<br>à Cotonou</span>
        </div>
        <div class="about-atelier-copy">
            <span class="eyebrow">L'atelier</span>
            <h2>Du premier croquis<br>à la dernière <em>couture</em>.</h2>
            <p>Nous avançons en petites séries pour prendre le temps de bien faire. Dans notre atelier, chaque coupe est ajustée, chaque finition contrôlée et chaque commande préparée avec la même attention.</p>
            <div class="about-stats">
                <div><strong>Cotonou</strong><span>Notre ancrage</span></div>
                <div><strong>Petites séries</strong><span>Notre rythme</span></div>
                <div><strong>Fait avec soin</strong><span>Notre promesse</span></div>
            </div>
        </div>
    </div>
</section>

<section class="about-cta">
    <div class="container">
        <span class="eyebrow">Votre prochaine pièce</span>
        <h2>Entrez dans<br><em>notre univers.</em></h2>
        <a class="btn btn-solid" href="{{ route('home') }}#categories">Explorer les collections</a>
    </div>
</section>
@endsection
