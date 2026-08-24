<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Back-office — LA MAISON')</title>
    <meta name="robots" content="noindex">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@600&family=Jost:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="admin">
    <aside class="sidebar">
        <a class="brand" href="{{ route('admin.dashboard') }}">
            <img class="brand-logo" src="{{ asset('images/olori.png') }}" alt="LA MAISON — Olori">
        </a>
        <span class="section-label">Boutique</span>
        <a class="item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Tableau de bord</a>
        <a class="item {{ request()->routeIs('admin.products*') ? 'active' : '' }}" href="{{ route('admin.products') }}">Articles</a>
        <a class="item {{ request()->routeIs('admin.orders') ? 'active' : '' }}" href="{{ route('admin.orders') }}">Commandes</a>
        <a class="item {{ request()->routeIs('admin.promotions') ? 'active' : '' }}" href="{{ route('admin.promotions') }}">Promotions</a>
        <a class="item {{ request()->routeIs('admin.stats') ? 'active' : '' }}" href="{{ route('admin.stats') }}">Statistiques</a>
        <span class="section-label">Site</span>
        <a class="item" href="{{ route('home') }}">Voir la boutique</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="item item-logout">Déconnexion</button>
        </form>
        @auth
            <div class="sidebar-user">Connecté : {{ auth()->user()->name }}</div>
        @endauth
    </aside>
    <main class="main">
        @if(session('status'))
            <div class="alert alert-success" role="status">{{ session('status') }}</div>
        @endif
        @yield('content')
    </main>
</div>
</body>
</html>
