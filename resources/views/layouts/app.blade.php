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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<div class="topbar">Livraison offerte à Cotonou dès 50 000 FCFA — Paiement sécurisé KKiaPay</div>

<header class="site-header">
    <div class="inner">
        <button class="burger" aria-label="Ouvrir le menu" aria-expanded="false">☰</button>
        <a class="brand" href="{{ route('home') }}">
            <img class="brand-logo" src="{{ asset('images/ooo-removebg-preview.png') }}" alt="LA MAISON — Olori "  >
        </a>
        <nav class="nav" aria-label="Navigation principale">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a>
            <details class="nav-dropdown">
                <summary>Collection</summary>
                <div class="nav-dropdown-menu">
                    @foreach(\App\Support\DemoData::categories() as $catSlug => $catLabel)
                        <a href="{{ route('shop.category', $catSlug) }}" class="{{ request()->routeIs('shop.category') && request()->route('categorie') === $catSlug ? 'active' : '' }}">{{ $catLabel }}</a>
                    @endforeach
                </div>
            </details>
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
            <img class="brand-logo footer-logo" src="{{ asset('images/ooo-removebg-preview.png') }}" alt="LA MAISON — Olori">
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
            <div class="social-links">
                <a href="#" aria-label="Instagram">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"></rect><circle cx="12" cy="12" r="4"></circle><circle cx="17.5" cy="6.5" r="1"></circle></svg>
                    <span>Instagram</span>
                </a>
                <a href="#" aria-label="Facebook">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 8h3V4h-3c-3.3 0-5 2-5 5v3H6v4h3v4h4v-4h3l1-4h-4V9c0-.7.3-1 1-1Z"></path></svg>
                    <span>Facebook</span>
                </a>
                <a href="#" aria-label="TikTok">
                    <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M15 4c.3 2 1.5 3.2 3.5 3.4v3.1c-1.3 0-2.5-.4-3.5-1v5.4a5.1 5.1 0 1 1-4.4-5v3.2a2 2 0 1 0 1.3 1.8V4H15Z"></path></svg>
                    <span>TikTok</span>
                </a>
            </div>
        </div>
    </div>
    <div class="footer-bottom">© {{ date('Y') }} La Maison — Cotonou, Bénin · Paiement sécurisé KKiaPay · Mentions légales</div>
</footer>

<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
