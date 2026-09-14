@extends('layouts.admin')

@section('title', 'Tableau de bord — Back-office')

@section('content')
@php
    $goalTarget = 1500000;
    $goalPct = min(100, round($kpis['ventes'] / $goalTarget * 100));
@endphp

<div class="page-head">
    <div>
        <h1>Tableau de bord</h1>
        <p class="page-sub">Aperçu de votre boutique · {{ now()->format('d/m/Y') }}</p>
    </div>
    <a class="btn" href="{{ route('admin.products.create') }}"><span class="material-symbols-outlined">add</span> Nouvel article</a>
</div>

<div class="kpis">
    <div class="kpi">
        <div class="kpi-top">
            <span class="kpi-icon terra"><span class="material-symbols-outlined">payments</span></span>
            @include('admin.partials.trend', ['value' => $kpis['ventes_tendance']])
        </div>
        <div class="value">{{ number_format($kpis['ventes'] / 1000000, 2, ',') }} M FCFA</div>
        <div class="label">Ventes du mois</div>
    </div>
    <div class="kpi">
        <div class="kpi-top">
            <span class="kpi-icon green"><span class="material-symbols-outlined">shopping_bag</span></span>
            @include('admin.partials.trend', ['value' => $kpis['commandes_tendance']])
        </div>
        <div class="value">{{ $kpis['commandes'] }}</div>
        <div class="label">Commandes</div>
    </div>
    <div class="kpi">
        <div class="kpi-top">
            <span class="kpi-icon rose"><span class="material-symbols-outlined">group</span></span>
            @include('admin.partials.trend', ['value' => $kpis['clients_tendance']])
        </div>
        <div class="value">{{ number_format($kpis['clients'], 0, ',', ' ') }}</div>
        <div class="label">Clients</div>
    </div>
    <div class="kpi">
        <div class="kpi-top">
            <span class="kpi-icon sable"><span class="material-symbols-outlined">shopping_cart</span></span>
            @include('admin.partials.trend', ['value' => $kpis['panier_tendance']])
        </div>
        <div class="value">{{ number_format($kpis['panier_moyen'], 0, ',', ' ') }} FCFA</div>
        <div class="label">Panier moyen</div>
    </div>
</div>

<div class="dash-grid">
    {{-- Colonne principale : dernières commandes --}}
    <div class="card">
        <div class="card-head">
            <h2>Dernières commandes</h2>
            <a class="card-link" href="{{ route('admin.orders') }}">Tout voir →</a>
        </div>
        <table class="data">
            <thead><tr><th>N°</th><th>Cliente</th><th>Date</th><th>Montant</th><th>Statut</th><th></th></tr></thead>
            <tbody>
                @foreach($orders as $o)
                    <tr>
                        <td class="mono">{{ $o['ref'] }}</td>
                        <td>{{ $o['client'] }}</td>
                        <td class="muted">{{ $o['date'] }}</td>
                        <td class="num">{{ number_format($o['total'], 0, ',', ' ') }} FCFA</td>
                        <td><span class="badge {{ $statuses[$o['status']]['class'] }}">{{ $statuses[$o['status']]['label'] }}</span></td>
                        <td><a class="btn btn-ghost btn-sm" href="{{ route('admin.orders') }}">Traiter</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Colonne latérale --}}
    <div class="dash-aside">
        {{-- Objectif du mois --}}
        <div class="card">
            <div class="card-head"><h2>Objectif du mois</h2></div>
            <div class="goal">
                <div class="goal-figures">
                    <span class="goal-current">{{ number_format($kpis['ventes'], 0, ',', ' ') }}</span>
                    <span class="goal-target">/ {{ number_format($goalTarget, 0, ',', ' ') }} FCFA</span>
                </div>
                <div class="goal-bar"><div class="goal-fill" style="width: {{ $goalPct }}%"></div></div>
                <div class="goal-pct">{{ $goalPct }} % atteint</div>
            </div>
        </div>

        {{-- Stock faible --}}
        <div class="card">
            <div class="card-head">
                <h2>Stock faible</h2>
                <a class="card-link" href="{{ route('admin.products') }}">Gérer →</a>
            </div>
            @if(count($lowStock))
                <ul class="stock-list">
                    @foreach($lowStock as $p)
                        <li>
                            <span class="stock-name">{{ $p['name'] }}</span>
                            <span class="stock-qty {{ $p['stock'] <= 1 ? 'critical' : '' }}">{{ $p['stock'] }} restant{{ $p['stock'] > 1 ? 's' : '' }}</span>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="empty-ok"><span class="material-symbols-outlined">check_circle</span> Tous les stocks sont bons.</p>
            @endif
        </div>
    </div>
</div>
@endsection
