<a class="product-card" href="{{ route('shop.show', $p['slug']) }}">
    @if($p['badge'])
        <span class="badge {{ $p['badge'] === 'Promo' ? 'promo' : '' }}">{{ $p['badge'] }}</span>
    @endif
    <div class="ph ph-{{ $p['tone'] }}">{{ mb_substr($p['name'], mb_strpos($p['name'], ' ') + 1, 1) }}</div>
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
