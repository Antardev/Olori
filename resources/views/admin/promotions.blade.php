@extends('layouts.admin')

@section('title', 'Promotions — Back-office')

@section('content')
<div class="page-head">
    <h1>Promotions & codes de réduction</h1>
    <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#promotionModal"><i class="bi bi-plus-lg" aria-hidden="true"></i> Nouvelle promotion</button>
</div>

@if($errors->any())
    <div class="alert alert-error">{{ $errors->first() }}</div>
@endif

<div class="card">
    <h2>Codes promotionnels</h2>
    <table class="data table table-hover align-middle">
        <thead><tr><th>Code</th><th>Réduction</th><th>Articles concernés</th><th>Validité</th><th>Utilisations</th><th>Statut</th><th></th></tr></thead>
        <tbody>
            @forelse($promotions as $promotion)
                <tr>
                    <td><strong>{{ $promotion->code }}</strong></td>
                    <td>-{{ $promotion->discount_percent }} %</td>
                    <td>{{ $promotion->products->isEmpty() ? 'Tous les articles' : $promotion->products->pluck('name')->join(', ') }}</td>
                    <td>{{ $promotion->starts_at?->format('d/m/Y') ?? 'Dès maintenant' }} → {{ $promotion->ends_at?->format('d/m/Y') ?? 'Permanent' }}</td>
                    <td>{{ $promotion->uses_count }}</td>
                    <td><span class="badge {{ $promotion->status_label === 'Actif' ? 'badge-success' : 'badge-danger' }}">{{ $promotion->status_label }}</span></td>
                    <td><button class="btn btn-sm btn-ghost" type="button" data-promotion-edit='@json($promotion)' data-promotion-products='@json($promotion->products->modelKeys())' data-bs-toggle="modal" data-bs-target="#promotionModal"><i class="bi bi-pencil" aria-hidden="true"></i> Modifier</button></td>
                </tr>
            @empty
                <tr><td colspan="7">Aucun code promotionnel enregistré.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="modal fade" id="promotionModal" tabindex="-1" aria-labelledby="promotion-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered promotion-modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
        <h2 id="promotion-modal-title">Nouvelle promotion</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
        <form method="POST" action="{{ route('admin.promotions.store') }}" data-promotion-form>
            @csrf
            <input type="hidden" name="_method" value="POST" data-promotion-method>
            <div class="form-grid">
                <div class="field"><label for="code">Code</label><input class="form-control" id="code" name="code" placeholder="RENTREE2026" required></div>
                <div class="field"><label for="discount_percent">Réduction (%)</label><input class="form-control" id="discount_percent" name="discount_percent" type="number" min="1" max="100" placeholder="15" required></div>
                <div class="field"><label for="starts_at">Valable du</label><input class="form-control" id="starts_at" name="starts_at" type="date"></div>
                <div class="field"><label for="ends_at">Au</label><input class="form-control" id="ends_at" name="ends_at" type="date"></div>
                <div class="field full">
                    <label for="promotion-product-search">Articles concernés</label>
                    <small>Aucune sélection signifie que le code s’applique à tous les articles.</small>
                    <div class="promotion-products" data-promotion-products>
                        <div class="promotion-products-toolbar">
                            <input class="form-control" id="promotion-product-search" type="search" placeholder="Rechercher un article…" autocomplete="off" data-promotion-product-search>
                            <span class="promotion-products-count" data-promotion-products-count aria-live="polite">0 article sélectionné</span>
                        </div>
                        <div class="promotion-products-actions">
                            <button class="btn btn-sm btn-ghost" type="button" data-promotion-select-all>Tout sélectionner</button>
                            <button class="btn btn-sm btn-ghost" type="button" data-promotion-clear>Tout désélectionner</button>
                        </div>
                        <div class="promotion-product-list" role="group" aria-label="Articles concernés par la promotion">
                            @forelse($products as $product)
                                <label class="promotion-product-option" data-product-name="{{ mb_strtolower($product->name) }}">
                                    <input type="checkbox" name="product_ids[]" value="{{ $product->id }}" @checked(in_array($product->id, old('product_ids', [])))>
                                    <span>{{ $product->name }}</span>
                                </label>
                            @empty
                                <p class="promotion-products-empty">Aucun article disponible.</p>
                            @endforelse
                        </div>
                        <p class="promotion-products-empty" data-promotion-no-results hidden>Aucun article ne correspond à votre recherche.</p>
                    </div>
                </div>
                <label class="field checkbox-field"><input type="checkbox" name="is_active" value="1" checked> Code actif</label>
            </div>
            <div class="promotion-modal-actions"><button class="btn btn-ghost" type="button" data-bs-dismiss="modal">Annuler</button><button class="btn" type="submit">Enregistrer</button></div>
        </form>
            </div>
        </div>
    </div>
</div>

<script>
const promotionForm = document.querySelector('[data-promotion-form]');
const promotionTitle = document.querySelector('#promotion-modal-title');
const promotionMethod = document.querySelector('[data-promotion-method]');
const promotionCode = document.querySelector('#code');
const promotionDiscount = document.querySelector('#discount_percent');
const promotionStarts = document.querySelector('#starts_at');
const promotionEnds = document.querySelector('#ends_at');
const promotionActive = document.querySelector('[name="is_active"]');
const promotionProducts = document.querySelectorAll('[name="product_ids[]"]');
const promotionSearch = document.querySelector('[data-promotion-product-search]');
const promotionProductOptions = document.querySelectorAll('.promotion-product-option');
const promotionProductCount = document.querySelector('[data-promotion-products-count]');
const promotionNoResults = document.querySelector('[data-promotion-no-results]');

function updatePromotionProducts() {
    const selectedCount = [...promotionProducts].filter(input => input.checked).length;
    promotionProductCount.textContent = `${selectedCount} article${selectedCount > 1 ? 's' : ''} sélectionné${selectedCount > 1 ? 's' : ''}`;

    const search = promotionSearch.value.trim().toLocaleLowerCase();
    let visibleCount = 0;
    promotionProductOptions.forEach(option => {
        const matches = option.dataset.productName.includes(search);
        option.hidden = !matches;
        if (matches) visibleCount++;
    });
    promotionNoResults.hidden = visibleCount > 0 || promotionProductOptions.length === 0;
}

function openPromotion(promotion = null, button = null) {
    promotionTitle.textContent = promotion ? 'Modifier le code promotionnel' : 'Nouvelle promotion';
    promotionForm.action = promotion ? '{{ url('/admin/promotions') }}/' + promotion.id : '{{ route('admin.promotions.store') }}';
    promotionMethod.value = promotion ? 'PUT' : 'POST';
    promotionCode.value = promotion?.code || '';
    promotionDiscount.value = promotion?.discount_percent || '';
    promotionStarts.value = promotion?.starts_at?.slice(0, 10) || '';
    promotionEnds.value = promotion?.ends_at?.slice(0, 10) || '';
    promotionActive.checked = promotion ? Boolean(promotion.is_active) : true;
    const productIds = promotion ? JSON.parse(button.dataset.promotionProducts || '[]') : [];
    promotionProducts.forEach(input => {
        input.checked = productIds.includes(Number(input.value));
    });
    promotionSearch.value = '';
    updatePromotionProducts();
}

promotionProducts.forEach(input => input.addEventListener('change', updatePromotionProducts));
promotionSearch.addEventListener('input', updatePromotionProducts);
document.querySelector('[data-promotion-select-all]').addEventListener('click', () => {
    promotionProducts.forEach(input => input.checked = true);
    updatePromotionProducts();
});
document.querySelector('[data-promotion-clear]').addEventListener('click', () => {
    promotionProducts.forEach(input => input.checked = false);
    updatePromotionProducts();
});

document.querySelectorAll('[data-promotion-edit]').forEach(button => button.addEventListener('click', () => {
    openPromotion(JSON.parse(button.dataset.promotionEdit), button);
}));
document.querySelector('[data-bs-target="#promotionModal"]').addEventListener('click', event => openPromotion(null, event.currentTarget));
</script>
@endsection
