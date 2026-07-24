@extends('layouts.admin')

@section('title', 'Articles — Back-office')

@section('content')
<div class="page-head">
    <h1>Articles ({{ count($products) }})</h1>
    <a class="btn" href="{{ route('admin.products.create') }}">+ Nouvel article</a>
</div>

<div class="card">
    <table class="data">
        <thead><tr><th>Article</th><th>Catégorie</th><th>Prix</th><th>Stock</th><th>Statut</th><th></th></tr></thead>
        <tbody>
            @foreach($products as $p)
                <tr>
                    <td><strong>{{ $p['name'] }}</strong></td>
                    <td>{{ $categories[$p['category']] ?? $p['category'] }}</td>
                    <td>{{ number_format($p['price'], 0, ',', ' ') }} FCFA</td>
                    <td><span class="stock-pill {{ $p['stock'] <= 2 ? 'low' : '' }}">{{ $p['stock'] }} {{ $p['stock'] <= 2 ? '⚠' : '' }}</span></td>
                    <td><span class="badge badge-success">En ligne</span></td>
                    <td>
                        <a class="btn btn-ghost btn-sm" href="{{ route('admin.products.create') }}">Modifier</a>
                        <a class="btn btn-ghost btn-sm" href="#">Retirer</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
