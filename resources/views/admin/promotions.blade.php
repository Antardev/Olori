@extends('layouts.admin')

@section('title', 'Promotions — Back-office')

@section('content')
<div class="page-head">
    <h1>Promotions & codes de réduction</h1>
    <button class="btn" type="button">+ Nouvelle promotion</button>
</div>

<div class="card">
    <h2>Codes actifs</h2>
    <table class="data">
        <thead><tr><th>Code</th><th>Réduction</th><th>Validité</th><th>Utilisations</th><th>Statut</th></tr></thead>
        <tbody>
            <tr><td><strong>ETE2026</strong></td><td>-15 %</td><td>01/07 → 31/08/2026</td><td>23</td><td><span class="badge badge-success">Actif</span></td></tr>
            <tr><td><strong>BIENVENUE</strong></td><td>-10 % (1re commande)</td><td>Permanent</td><td>112</td><td><span class="badge badge-success">Actif</span></td></tr>
            <tr><td><strong>FETES2025</strong></td><td>-20 %</td><td>Expiré</td><td>87</td><td><span class="badge badge-danger">Expiré</span></td></tr>
        </tbody>
    </table>
</div>

<div class="card">
    <h2>Créer un code</h2>
    <div class="form-grid">
        <div class="field"><label for="code">Code</label><input id="code" placeholder="RENTREE2026"></div>
        <div class="field"><label for="reduc">Réduction (%)</label><input id="reduc" type="number" placeholder="15"></div>
        <div class="field"><label for="du">Valable du</label><input id="du" type="date"></div>
        <div class="field"><label for="au">au</label><input id="au" type="date"></div>
    </div>
    <button class="btn" type="button" style="margin-top:18px">Créer le code</button>
</div>
@endsection
