@extends('layouts.admin')

@section('title', 'Nouvel article — Back-office')

@section('content')
<div class="page-head">
    <div>
        <h1>Nouvel article</h1>
        <p class="page-sub">Publié, il apparaît en tête de la page de sa catégorie.</p>
    </div>
    <a class="btn btn-ghost" href="{{ route('admin.products') }}">← Retour aux articles</a>
</div>

@if($errors->any())
    <div class="alert alert-error">
        <strong>{{ $errors->count() }} champ{{ $errors->count() > 1 ? 's' : '' }} à corriger avant publication.</strong>
    </div>
@endif

<form class="card" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-grid">
        <div class="field">
            <label for="name">Nom de l'article</label>
            <input id="name" name="name" value="{{ old('name') }}" placeholder="Chemise Ouémé" required>
            @error('name')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field">
            <label for="category">Catégorie</label>
            <select id="category" name="category" required>
                @foreach($categories as $slug => $label)
                    <option value="{{ $slug }}" @selected(old('category') === $slug)>{{ $label }}</option>
                @endforeach
            </select>
            @error('category')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field">
            <label for="price">Prix (FCFA)</label>
            <input id="price" name="price" type="number" step="500" min="0" value="{{ old('price') }}" placeholder="28000" required>
            @error('price')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field">
            <label for="old_price">Prix barré (facultatif)</label>
            <input id="old_price" name="old_price" type="number" step="500" min="0" value="{{ old('old_price') }}" placeholder="42000">
            @error('old_price')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field">
            <label for="stock">Stock initial</label>
            <input id="stock" name="stock" type="number" min="0" value="{{ old('stock', 0) }}" required>
            @error('stock')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field">
            <label for="badge">Pastille (facultatif)</label>
            <select id="badge" name="badge">
                <option value="">Aucune</option>
                @foreach($badges as $badge)
                    <option value="{{ $badge }}" @selected(old('badge') === $badge)>{{ $badge }}</option>
                @endforeach
            </select>
            @error('badge')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field">
            <label for="sizes">Tailles (séparées par des virgules)</label>
            <input id="sizes" name="sizes" value="{{ old('sizes') }}" placeholder="S, M, L, XL">
            @error('sizes')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field">
            <label for="colors">Coloris (codes hexadécimaux, séparés par des virgules)</label>
            <input id="colors" name="colors" value="{{ old('colors') }}" placeholder="#B0472B, #23201B">
            @error('colors')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field full">
            <label for="tone">Teinte d'affichage — utilisée tant qu'aucune photo n'est chargée</label>
            <div class="tone-picker">
                @foreach($tones as $value => $name)
                    <label class="tone-option tone-{{ $value }}">
                        <input type="radio" name="tone" value="{{ $value }}" @checked(old('tone', 'sable') === $value)>
                        <span>{{ $name }}</span>
                    </label>
                @endforeach
            </div>
            @error('tone')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field full">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="5" placeholder="Matières, coupe, entretien…">{{ old('description') }}</textarea>
            @error('description')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field full">
            <label for="photo">Photo</label>
            <label class="upload" for="photo">
                <img class="upload-preview" alt="" hidden>
                <span class="upload-text">Cliquez pour choisir une photo — JPG, PNG ou WebP, 4 Mo maximum</span>
                <input id="photo" name="photo" type="file" accept="image/jpeg,image/png,image/webp" hidden>
            </label>
            @error('photo')<span class="field-error">{{ $message }}</span>@enderror
        </div>
    </div>

    <div style="margin-top:20px;display:flex;gap:10px">
        <button class="btn" type="submit" name="action" value="publish">Publier l'article</button>
        <button class="btn btn-ghost" type="submit" name="action" value="draft">Enregistrer comme brouillon</button>
    </div>
</form>

<script>
document.getElementById('photo').addEventListener('change', function (e) {
    const file = e.target.files[0];
    const zone = e.target.closest('.upload');
    const preview = zone.querySelector('.upload-preview');
    const text = zone.querySelector('.upload-text');

    if (!file) return;
    preview.src = URL.createObjectURL(file);
    preview.hidden = false;
    text.textContent = file.name + ' — cliquez pour changer';
});
</script>
@endsection
