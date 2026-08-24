@extends('layouts.admin')

@section('title', 'Articles — Back-office')

@section('content')
<div class="page-head">
    <div>
        <h1>Articles ({{ count($products) }})</h1>
        <p class="page-sub">
            @foreach($categories as $slug => $label)
                {{ $label }} : {{ $products->where('category', $slug)->where('is_published', true)->count() }}@if(! $loop->last) · @endif
            @endforeach
        </p>
    </div>
    <a class="btn" href="{{ route('admin.products.create') }}">+ Nouvel article</a>
</div>

<div class="card">
    @if(count($products))
        <table class="data">
            <thead><tr><th>Article</th><th>Catégorie</th><th>Prix</th><th>Stock</th><th>Statut</th><th></th></tr></thead>
            <tbody>
                @foreach($products as $p)
                    <tr>
                        <td><strong>{{ $p->name }}</strong></td>
                        <td>{{ $p->category_label }}</td>
                        <td>{{ number_format($p->price, 0, ',', ' ') }} FCFA</td>
                        <td><span class="stock-pill {{ $p->stock <= 2 ? 'low' : '' }}">{{ $p->stock }} {{ $p->stock <= 2 ? '⚠' : '' }}</span></td>
                        <td>
                            @if($p->is_published)
                                <span class="badge badge-success">En ligne</span>
                            @else
                                <span class="badge badge-draft">Brouillon</span>
                            @endif
                        </td>
                        <td class="row-actions">
                            @if($p->is_published)
                                <a class="btn btn-ghost btn-sm" href="{{ route('shop.show', $p->slug) }}" target="_blank" rel="noopener">Voir en boutique</a>
                            @endif
                            <form method="POST" action="{{ route('admin.products.destroy', $p) }}"
                                  onsubmit="return confirm('Supprimer « {{ $p->name }} » du catalogue ? Cette action est définitive.')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucun article pour l'instant. <a href="{{ route('admin.products.create') }}" style="text-decoration:underline">Créez le premier</a>.</p>
    @endif
</div>
@endsection
