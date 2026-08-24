<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LA MAISON — Mode & créations')</title>
    <meta name="description" content="@yield('meta_description', 'LA MAISON — maison de mode béninoise. Découvrez nos collections : robes, accessoires et pièces artisanales. Livraison au Bénin et à l’international, paiement sécurisé KKiaPay.')">
    <link rel="icon" type="image/jpeg" href="{{ asset('images/olori.jpeg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;1,500&family=Jost:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="topbar">Livraison offerte à Cotonou dès 50 000 FCFA — Paiement sécurisé KKiaPay</div>

<header class="site-header">
    <div class="inner">
        <button class="burger" aria-label="Ouvrir le menu" aria-expanded="false">☰</button>
        <a class="brand" href="{{ route('home') }}">
            <img class="brand-logo" src="{{ asset('images/nobackground.png') }}" alt="LA MAISON — Olori "  >
        </a>
        <nav class="nav" aria-label="Navigation principale">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a>
            @foreach(\App\Support\DemoData::categories() as $catSlug => $catLabel)
                <a href="{{ route('shop.category', $catSlug) }}" class="{{ request()->routeIs('shop.category') && request()->route('categorie') === $catSlug ? 'active' : '' }}">{{ $catLabel }}</a>
            @endforeach
            <a href="{{ route('view360') }}" class="{{ request()->routeIs('view360') ? 'active' : '' }}">Vue 360°</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">À propos</a>
            <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        </nav>
        <div class="header-icons">
            @auth
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit" class="link-button" aria-label="Se déconnecter"><span class="material-symbols-outlined">logout</span></button>
                </form>
            @else
                <a href="{{ route('login') }}" aria-label="Connexion"><span class="material-symbols-outlined">person</span></a>
            @endauth
            <a class="cart-link" href="{{ route('cart.index') }}" aria-label="Panier"><span class="material-symbols-outlined">shopping_bag</span>@if(($n = count(session('cart', []))) > 0)<span class="cart-count">{{ $n }}</span>@endif</a>
        </div>
    </div>
</header>

@if(session('status'))
    <div class="flash" role="status">{{ session('status') }}</div>
@endif

<main>
    @yield('content')
</main>

<footer class="site-footer">
    <div class="inner">
        <div>
            <img class="brand-logo footer-logo" src="{{ asset('images/nobackground.png') }}" alt="LA MAISON — Olori">
            <p>Maison de mode béninoise. Élégance, authenticité et savoir-faire, de Cotonou au monde entier.</p>
        </div>
        <div>
            <h4>Catégories</h4>
            @foreach(\App\Support\DemoData::categories() as $catSlug => $catLabel)
                <a href="{{ route('shop.category', $catSlug) }}">{{ $catLabel }}</a>
            @endforeach
            <a href="{{ route('view360') }}">Vue 360°</a>
        </div>
        <div>
            <h4>Aide</h4>
            <a href="{{ route('contact') }}">Contact & FAQ</a>
            <a href="#">Livraison & retours</a>
            <a href="#">Guide des tailles</a>
        </div>
        <div>
            <h4>Suivez-nous</h4>
            <a href="#">Instagram</a>
            <a href="#">Facebook</a>
            <a href="#">TikTok</a>
        </div>
    </div>
    <div class="footer-bottom">© {{ date('Y') }} La Maison — Cotonou, Bénin · Paiement sécurisé KKiaPay · Mentions légales</div>
</footer>

<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
