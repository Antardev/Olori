<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Back-office — LA MAISON')</title>
    <meta name="robots" content="noindex">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet">
    @vite(['resources/css/admin.css', 'resources/js/admin.js'])
</head>
<body>
<div class="admin container-fluid px-0">
    <button class="admin-menu-toggle" type="button" aria-label="Ouvrir le menu d'administration" aria-expanded="false" aria-controls="admin-sidebar">
        <span class="material-symbols-outlined" aria-hidden="true">menu</span>
    </button>
    <div class="admin-sidebar-backdrop" data-admin-menu-close></div>
    <aside class="sidebar" id="admin-sidebar">
        <div class="sidebar-mobile-head">
            <span class="section-label">Menu</span>
            <button class="sidebar-close" type="button" aria-label="Fermer le menu" data-admin-menu-close>
                <span class="material-symbols-outlined" aria-hidden="true">close</span>
            </button>
        </div>
        <a class="brand" href="{{ route('admin.dashboard') }}">
            <img class="brand-logo" src="{{ asset('images/ooo-removebg-preview.png') }}" alt="OLÒRI — Made in Benin">
        </a>
        <span class="section-label">Boutique</span>
        <a class="item d-flex align-items-center gap-2 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="bi bi-grid-1x2" aria-hidden="true"></i> Tableau de bord</a>
        <a class="item d-flex align-items-center gap-2 {{ request()->routeIs('admin.products*') ? 'active' : '' }}" href="{{ route('admin.products') }}"><i class="bi bi-box-seam" aria-hidden="true"></i> Articles</a>
        <a class="item d-flex align-items-center gap-2 {{ request()->routeIs('admin.categories*') ? 'active' : '' }}" href="{{ route('admin.categories') }}"><i class="bi bi-tags" aria-hidden="true"></i> Catégories</a>
        <a class="item d-flex align-items-center gap-2 {{ request()->routeIs('admin.orders') ? 'active' : '' }}" href="{{ route('admin.orders') }}"><i class="bi bi-receipt" aria-hidden="true"></i> Commandes</a>
        <a class="item d-flex align-items-center gap-2 {{ request()->routeIs('admin.promotions') ? 'active' : '' }}" href="{{ route('admin.promotions') }}"><i class="bi bi-percent" aria-hidden="true"></i> Promotions</a>
        <a class="item d-flex align-items-center gap-2 {{ request()->routeIs('admin.stats') ? 'active' : '' }}" href="{{ route('admin.stats') }}"><i class="bi bi-bar-chart" aria-hidden="true"></i> Statistiques</a>
        <span class="section-label">Site</span>
        <a class="item d-flex align-items-center gap-2" href="{{ route('home') }}"><i class="bi bi-shop" aria-hidden="true"></i> Voir la boutique</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="item item-logout">Déconnexion</button>
        </form>
        @auth
            <div class="sidebar-user">Connecté : {{ auth()->user()->name }}</div>
        @endauth
    </aside>
    <main class="main container-fluid">
        @if(session('status'))
            <div class="alert alert-success" role="status">{{ session('status') }}</div>
        @endif
        @yield('content')
    </main>
</div>
</body>
</html>
