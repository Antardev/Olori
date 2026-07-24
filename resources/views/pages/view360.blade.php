@extends('layouts.app')

@section('title', 'Vue 360° — LA MAISON')

@section('content')
<section class="section">
    <div class="container">
        <div class="section-head">
            <div>
                <span class="eyebrow">Immersion</span>
                <h2>Vue 360°</h2>
            </div>
        </div>
        <p class="v360-intro">Faites pivoter chaque pièce sous tous les angles, comme si vous la teniez entre les mains. Glissez sur l'image (ou utilisez la lecture automatique).</p>

        <div class="v360-layout">
            <div class="spin360" id="spin"
                 data-path="{{ asset('images/360') }}"
                 data-slug="{{ $sets[0]['slug'] }}"
                 data-frames="{{ $sets[0]['frames'] }}">
                <img class="spin360-img" src="{{ asset('images/360/'.$sets[0]['slug'].'/frame-01.svg') }}" alt="Vue 360° de la pièce" draggable="false">
                <div class="spin360-hint"><span class="material-symbols-outlined">360</span> Glissez pour faire pivoter</div>
                <div class="spin360-controls">
                    <button type="button" data-spin="prev" aria-label="Vue précédente"><span class="material-symbols-outlined">chevron_left</span></button>
                    <button type="button" data-spin="play" aria-label="Lecture automatique"><span class="material-symbols-outlined">play_arrow</span></button>
                    <button type="button" data-spin="next" aria-label="Vue suivante"><span class="material-symbols-outlined">chevron_right</span></button>
                </div>
            </div>

            <aside class="v360-picker">
                <h3>Choisir une pièce</h3>
                @foreach($sets as $i => $s)
                    <button type="button" class="v360-item {{ $i === 0 ? 'active' : '' }}"
                            data-slug="{{ $s['slug'] }}" data-frames="{{ $s['frames'] }}">
                        <img src="{{ asset('images/360/'.$s['slug'].'/frame-01.svg') }}" alt="{{ $s['title'] }}">
                        <span>{{ $s['title'] }}</span>
                    </button>
                @endforeach
                <p class="v360-note">Démo avec images générées. Remplacez les fichiers de <code>public/images/360/&lt;produit&gt;/</code> par vos photos (<code>frame-01</code> … <code>frame-{{ $sets[0]['frames'] }}</code>).</p>
            </aside>
        </div>
    </div>
</section>
@endsection
