@extends('layouts.admin')

@section('title', 'Statistiques — Back-office')

@section('content')
<div class="page-head">
    <h1>Statistiques de vente</h1>
</div>

<div class="card">
    <h2>Chiffre d'affaires — 6 derniers mois</h2>
    @php $max = max(array_column($monthly, 'ca')); @endphp
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
    <table class="data">
        <thead><tr><th>#</th><th>Article</th><th>Prix</th><th>Note</th><th>Avis</th></tr></thead>
        <tbody>
            @foreach($top as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td><strong>{{ $p['name'] }}</strong></td>
                    <td>{{ number_format($p['price'], 0, ',', ' ') }} FCFA</td>
                    <td>★ {{ number_format($p['rating'], 1, ',') }}</td>
                    <td>{{ $p['reviews'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
