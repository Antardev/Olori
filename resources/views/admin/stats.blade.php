@extends('layouts.admin')

@section('title', 'Statistiques — Back-office')

@section('content')
<div class="page-head">
    <h1>Statistiques de vente</h1>
</div>

<div class="kpis">
    <div class="kpi"><div class="kpi-top"><span class="kpi-icon terra"><span class="material-symbols-outlined">payments</span></span></div><div class="value">{{ number_format($stats['ventes'], 0, ',', ' ') }} FCFA</div><div class="label">CA sur 6 mois</div></div>
    <div class="kpi"><div class="kpi-top"><span class="kpi-icon green"><span class="material-symbols-outlined">shopping_bag</span></span></div><div class="value">{{ number_format($stats['commandes'], 0, ',', ' ') }}</div><div class="label">Commandes confirmées</div></div>
    <div class="kpi"><div class="kpi-top"><span class="kpi-icon rose"><span class="material-symbols-outlined">inventory_2</span></span></div><div class="value">{{ number_format($stats['articles'], 0, ',', ' ') }}</div><div class="label">Articles vendus</div></div>
    <div class="kpi"><div class="kpi-top"><span class="kpi-icon sable"><span class="material-symbols-outlined">shopping_cart</span></span></div><div class="value">{{ number_format($stats['panier_moyen'], 0, ',', ' ') }} FCFA</div><div class="label">Panier moyen</div></div>
</div>

<div class="card">
    <h2>Chiffre d'affaires — 6 derniers mois</h2>
    @php $max = max(1, max(array_column($monthly, 'ca'))); @endphp
    <div class="bar-chart">
        @foreach($monthly as $m)
            <div class="bar-row">
                <span>{{ $m['mois'] }}</span>
                <div class="bar-track"><div class="bar-fill" style="width: {{ round($m['ca'] / $max * 100) }}%"></div></div>
                <span class="val">{{ number_format($m['ca'], 0, ',', ' ') }} FCFA</span>
            </div>
        @endforeach
    </div>
</div>

<div class="card">
    <h2>Produits les plus vendus</h2>
    <table class="data table table-hover align-middle">
        <thead><tr><th>#</th><th>Article</th><th>CA généré</th><th>Quantité</th><th>Prix unitaire</th></tr></thead>
        <tbody>
            @forelse($top as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><strong>{{ $p['name'] }}</strong></td>
                    <td>{{ number_format($p['revenue'], 0, ',', ' ') }} FCFA</td>
                    <td>{{ number_format($p['quantity'], 0, ',', ' ') }}</td>
                    <td>{{ number_format($p['price'], 0, ',', ' ') }} FCFA</td>
                </tr>
            @empty
                <tr><td colspan="5" class="muted">Aucune vente enregistrée pour le moment.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
