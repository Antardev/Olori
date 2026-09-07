<a class="product-card" href="{{ route('shop.show', $p['slug']) }}">
    @if($p['badge'])
        <span class="badge {{ $p['badge'] === 'Promo' ? 'promo' : '' }}">{{ $p['badge'] }}</span>
    @endif
    @if($p['image'])
        <img class="product-img" src="{{ asset($p['image']) }}" alt="{{ $p['name'] }}" loading="lazy">
    @else
        <div class="ph ph-sable">{{ mb_substr($p['name'], mb_strpos($p['name'], ' ') + 1, 1) }}</div>
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
