<a class="product-card reveal" style="--card-delay: {{ min($loop->index * 70, 420) }}ms" href="{{ route('shop.show', $p['slug']) }}">
    @if($p['badge'])
        <span class="badge {{ $p['badge'] === 'Promo' ? 'promo' : '' }}">{{ $p['badge'] }}</span>
    @endif
    @if($p['image'])
        <span class="product-media">
            <img class="product-img" src="{{ asset($p['image']) }}" alt="{{ $p['name'] }}" loading="lazy">
            <span class="product-discover">Découvrir <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span></span>
        </span>
    @else
        <span class="product-media">
            <span class="ph ph-sable">{{ mb_substr($p['name'], mb_strpos($p['name'], ' ') + 1, 1) }}</span>
            <span class="product-discover">Découvrir <span class="material-symbols-outlined" aria-hidden="true">arrow_forward</span></span>
        </span>
    @endif
    <div class="info">
        <div class="name">{{ $p['name'] }}</div>
        <div class="price">
            {{ number_format($p['price'], 0, ',', ' ') }} FCFA
            @if($p['old_price'])
                <span class="old">{{ number_format($p['old_price'], 0, ',', ' ') }} FCFA</span>
            @endif
        </div>
    </div>
</a>
