{{--
    Filet à motif wax — signature structurelle du site.
    Reprend le losange des tissus imprimés, réduit à l'épaisseur d'un trait.
    Usage : @include('partials.wax-rule')  ou  @include('partials.wax-rule', ['serre' => true])
--}}
@php($waxId = 'wax-'.\Illuminate\Support\Str::random(6))
<div class="wax-rule {{ ($serre ?? false) ? 'serre' : '' }}" role="presentation">
    <svg aria-hidden="true" focusable="false">
        <defs>
            <pattern id="{{ $waxId }}" width="52" height="14" patternUnits="userSpaceOnUse">
                <path d="M0 7 H15 M37 7 H52" stroke="currentColor" stroke-width="1" fill="none" opacity=".6"/>
                <path d="M26 1.5 L31.5 7 L26 12.5 L20.5 7 Z" stroke="currentColor" stroke-width="1" fill="none"/>
                <circle cx="26" cy="7" r="1.4" fill="currentColor"/>
            </pattern>
        </defs>
        <rect width="100%" height="14" fill="url(#{{ $waxId }})"/>
    </svg>
</div>
