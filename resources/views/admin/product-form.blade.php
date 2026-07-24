@extends('layouts.admin')

@section('title', 'Nouvel article — Back-office')

@section('content')
<div class="page-head">
    <h1>Nouvel article</h1>
    <a class="btn btn-ghost" href="{{ route('admin.products') }}">← Retour aux articles</a>
</div>

{{-- En production : Route::post('admin/articles') + validation + Product::create() --}}
<div class="card">
    <div class="form-grid">
        <div class="field"><label for="pname">Nom de l'article</label><input id="pname" placeholder="Robe Ifè"></div>
        <div class="field">
            <label for="pcat">Catégorie</label>
            <select id="pcat">
                @foreach($categories as $slug => $label)
                    <option value="{{ $slug }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="field"><label for="pprice">Prix (FCFA)</label><input id="pprice" type="number" step="500" placeholder="28 000"></div>
        <div class="field"><label for="pstock">Stock initial</label><input id="pstock" type="number" placeholder="12"></div>
        <div class="field"><label for="psizes">Tailles (séparées par des virgules)</label><input id="psizes" placeholder="S, M, L, XL"></div>
        <div class="field"><label for="pcolors">Coloris</label><input id="pcolors" placeholder="Terracotta, Noir"></div>
        <div class="field full"><label for="pdesc">Description</label><textarea id="pdesc" rows="5" placeholder="Matières, coupe, entretien…"></textarea></div>
        <div class="field full">
            <label>Photos</label>
            <div class="upload">Glissez vos photos ici ou cliquez pour parcourir (JPG/PNG, 4 max)</div>
        </div>
    </div>
    <div style="margin-top:20px;display:flex;gap:10px">
        <button class="btn" type="button">Publier l'article</button>
        <button class="btn btn-ghost" type="button">Enregistrer comme brouillon</button>
    </div>
</div>
@endsection
