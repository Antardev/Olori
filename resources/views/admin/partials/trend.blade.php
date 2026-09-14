@php
    $trendClass = $value === null ? 'flat' : ($value > 0 ? 'up' : ($value < 0 ? 'down' : 'flat'));
    $trendIcon = $value === null ? 'trending_flat' : ($value > 0 ? 'trending_up' : ($value < 0 ? 'trending_down' : 'trending_flat'));
    $trendLabel = $value === null ? 'nouveau' : ($value === 0 ? 'stable' : sprintf('%s%d %%', $value > 0 ? '+' : '', $value));
@endphp
<span class="trend {{ $trendClass }}"><span class="material-symbols-outlined">{{ $trendIcon }}</span> {{ $trendLabel }}</span>
