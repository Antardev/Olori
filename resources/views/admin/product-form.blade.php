@extends('layouts.admin')

@section('title', 'Nouvel article — Back-office')

@section('content')
<div class="page-head">
    <div>
        <h1>Nouvel article</h1>
        <p class="page-sub">Publié, il apparaît en tête de la page de sa collection.</p>
    </div>
    <a class="btn btn-ghost" href="{{ route('admin.products') }}"><i class="bi bi-arrow-left" aria-hidden="true"></i> Retour aux articles</a>
</div>

@if($errors->any())
    <div class="alert alert-error">
        <strong>{{ $errors->count() }} champ{{ $errors->count() > 1 ? 's' : '' }} à corriger avant publication.</strong>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form class="card" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-grid">
        <div class="field">
            <label for="name">Nom de l'article</label>
            <input class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field">
            <label for="category">Collection</label>
            <select class="form-select" id="category" name="category" required>
                @foreach($categories as $slug => $label)
                    <option value="{{ $slug }}" @selected(old('category') === $slug)>{{ $label }}</option>
                @endforeach
            </select>
            @error('category')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field">
            <label for="subcategory">Catégorie</label>
            <select class="form-select" id="subcategory" name="subcategory" required>
                @foreach($subcategories[old('category', 'hommes')] ?? [] as $slug => $label)
                    <option value="{{ $slug }}" @selected(old('subcategory') === $slug)>{{ $label }}</option>
                @endforeach
            </select>
            @error('subcategory')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field">
            <label for="price">Prix (FCFA)</label>
            <input class="form-control" id="price" name="price" type="number" step="500" min="0" value="{{ old('price') }}" required>
            @error('price')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field">
            <label for="old_price">Prix barré (facultatif)</label>
            <input class="form-control" id="old_price" name="old_price" type="number" step="500" min="0" value="{{ old('old_price') }}" >
            @error('old_price')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field">
            <label for="stock">Stock initial</label>
            <input class="form-control" id="stock" name="stock" type="number" min="0" value="{{ old('stock', 0) }}" required>
            @error('stock')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field">
            <label for="badge">Pastille (facultatif)</label>
            <select class="form-select" id="badge" name="badge">
                <option value="">Aucune</option>
                @foreach($badges as $badge)
                    <option value="{{ $badge }}" @selected(old('badge') === $badge)>{{ $badge }}</option>
                @endforeach
            </select>
            @error('badge')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field" id="sizes-field">
            <label for="sizes">Tailles (séparées par des virgules)</label>
            <input class="form-control" id="sizes" name="sizes" value="{{ old('sizes') }}" placeholder="S, M, L, XL">
            @error('sizes')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field">
            <label for="colors">Coloris (noms séparés par des virgules)</label>
            <input class="form-control" id="colors" name="colors" value="{{ old('colors') }}" placeholder="Rouge brique, Noir, Beige">
            @error('colors')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field full">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="5" placeholder="Matières, coupe, entretien…">{{ old('description') }}</textarea>
            @error('description')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="field full">
            <label for="photo">Photos de l'article</label>
            <label class="upload" for="photo">
                <img class="upload-preview" alt="" hidden>
                <span class="upload-text">Choisissez jusqu'à 5 photos. La première sera la photo principale — JPG, PNG ou WebP, 4 Mo maximum par photo</span>
                <input id="photo" name="photo[]" type="file" accept="image/jpeg,image/png,image/webp" multiple hidden>
            </label>
            @error('photo')<span class="field-error">{{ $message }}</span>@enderror
        </div>
    </div>

    <div style="margin-top:20px;display:flex;gap:10px">
        <button class="btn btn-primary" type="submit" name="action" value="publish"><i class="bi bi-check-lg" aria-hidden="true"></i> Publier l'article</button>
        <button class="btn btn-ghost" type="submit" name="action" value="draft">Enregistrer comme brouillon</button>
    </div>
</form>

<script>
const subcategories = @json($subcategories);
const collectionSelect = document.getElementById('category');
const subcategorySelect = document.getElementById('subcategory');
const selectedSubcategory = @json(old('subcategory'));

function fillSubcategories(selected = null) {
    subcategorySelect.replaceChildren();
    Object.entries(subcategories[collectionSelect.value] || {}).forEach(([value, label]) => {
        subcategorySelect.add(new Option(label, value, false, value === selected));
    });
}

function toggleSizes() {
    const isAccessory = collectionSelect.value === 'accessoires';
    document.getElementById('sizes-field').hidden = isAccessory;
    if (isAccessory) document.getElementById('sizes').value = '';
}

collectionSelect.addEventListener('change', function () {
    fillSubcategories();
    toggleSizes();
});

fillSubcategories(selectedSubcategory);
toggleSizes();

document.getElementById('photo').addEventListener('change', function (e) {
    const files = [...e.target.files];
    const zone = e.target.closest('.upload');
    const preview = zone.querySelector('.upload-preview');
    const text = zone.querySelector('.upload-text');

    if (!files.length) return;
    preview.src = URL.createObjectURL(files[0]);
    preview.hidden = false;
    text.textContent = files.length + ' photo' + (files.length > 1 ? 's sélectionnées' : ' sélectionnée') + ' — cliquez pour changer';
});
</script>
@endsection
