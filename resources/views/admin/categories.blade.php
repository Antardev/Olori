@extends('layouts.admin')

@section('title', 'Catégories — Back-office')

@section('content')
<div class="page-head">
    <div>
        <h1>Catégories</h1>
        <p class="page-sub">Ajoutez les catégories disponibles dans chaque collection.</p>
    </div>
    <button class="btn btn-primary" type="button" data-category-modal="add"><i class="bi bi-plus-lg" aria-hidden="true"></i> Ajouter une catégorie</button>
</div>

@if($errors->any())
    <div class="alert alert-error">
        @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif

<div class="category-admin-grid">
    <div class="card category-overview">
        <h2>Catégories existantes</h2>
        @foreach($collections as $collection => $collectionLabel)
            <h3>{{ $collectionLabel }}</h3>
            <ul class="category-list">
                @forelse($categories->get($collection, collect()) as $category)
                    <li>
                        <span>{{ $category->name }}</span>
                        <span class="category-actions">
                            <button class="btn btn-ghost btn-sm" type="button" data-category-modal="edit"
                                    data-category-id="{{ $category->id }}"
                                    data-category-name="{{ $category->name }}"
                                    data-category-collection="{{ $category->collection }}"><i class="bi bi-pencil" aria-hidden="true"></i> Modifier</button>
                            <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                  onsubmit="return confirm('Supprimer la catégorie {{ $category->name }} ?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type="submit"><i class="bi bi-trash3" aria-hidden="true"></i> Supprimer</button>
                            </form>
                        </span>
                    </li>
                @empty
                    <li>Aucune catégorie</li>
                @endforelse
            </ul>
        @endforeach
    </div>
</div>

<div class="category-modal" id="category-modal" aria-hidden="true">
    <div class="category-modal-backdrop" data-category-close></div>
    <div class="category-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="category-modal-title">
        <button class="category-modal-close" type="button" aria-label="Fermer" data-category-close>&times;</button>
        <h2 id="category-modal-title">Ajouter une catégorie</h2>
        <form id="category-form" method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <input type="hidden" name="_method" id="category-method" value="POST">
            <div class="field">
                <label for="category-collection">Collection</label>
                <select class="form-select" id="category-collection" name="collection" required>
                    @foreach($collections as $slug => $label)
                        <option value="{{ $slug }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field">
                <label for="category-name">Nom de la catégorie</label>
                <input class="form-control" id="category-name" name="name" placeholder="Pantalons" required>
            </div>
            <div class="category-modal-actions">
                <button class="btn btn-ghost" type="button" data-category-close>Annuler</button>
                <button class="btn" type="submit" id="category-submit">Ajouter la catégorie</button>
            </div>
        </form>
    </div>
</div>

<script>
const categoryModal = document.getElementById('category-modal');
const categoryForm = document.getElementById('category-form');
const categoryMethod = document.getElementById('category-method');
const categoryTitle = document.getElementById('category-modal-title');
const categorySubmit = document.getElementById('category-submit');
const categoryName = document.getElementById('category-name');
const categoryCollection = document.getElementById('category-collection');

function closeCategoryModal() {
    categoryModal.classList.remove('is-open');
    categoryModal.setAttribute('aria-hidden', 'true');
}

document.querySelector('[data-category-modal="add"]').addEventListener('click', function () {
    categoryForm.action = '{{ route('admin.categories.store') }}';
    categoryMethod.value = 'POST';
    categoryTitle.textContent = 'Ajouter une catégorie';
    categorySubmit.textContent = 'Ajouter la catégorie';
    categoryName.value = '';
    categoryCollection.value = 'hommes';
    categoryModal.classList.add('is-open');
    categoryModal.setAttribute('aria-hidden', 'false');
    categoryName.focus();
});

document.querySelectorAll('[data-category-modal="edit"]').forEach(function (button) {
    button.addEventListener('click', function () {
        categoryForm.action = '{{ url('/admin/categories') }}/' + button.dataset.categoryId;
        categoryMethod.value = 'PUT';
        categoryTitle.textContent = 'Modifier la catégorie';
        categorySubmit.textContent = 'Enregistrer les modifications';
        categoryName.value = button.dataset.categoryName;
        categoryCollection.value = button.dataset.categoryCollection;
        categoryModal.classList.add('is-open');
        categoryModal.setAttribute('aria-hidden', 'false');
        categoryName.focus();
    });
});

document.querySelectorAll('[data-category-close]').forEach(function (element) {
    element.addEventListener('click', closeCategoryModal);
});
document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape' && categoryModal.classList.contains('is-open')) closeCategoryModal();
});
</script>
@endsection
