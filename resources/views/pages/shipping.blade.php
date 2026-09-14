@extends('layouts.app')

@section('title', 'Livraison & retours — LA MAISON')
@section('meta_description', 'Informations sur la livraison et les retours des commandes LA MAISON. Délais, frais, conditions et formulaire d’avis.')

@section('content')
<section class="section" style="padding: 40px 0 60px;">
    <div class="container" style="max-width: 1000px; margin: 0 auto;">

        {{-- En-tête --}}
        <div style="text-align: center; margin-bottom: 40px;">
            <span class="eyebrow" style="display: inline-block; background: #f5f0eb; padding: 6px 18px; border-radius: 30px; font-size: 0.85rem; letter-spacing: 1px; text-transform: uppercase; color: #7a6b5e;">Besoin d’aide</span>
            <h1 style="font-size: 3rem; margin: 18px 0 8px; font-weight: 300; letter-spacing: -0.5px;">
                Livraison <em style="font-style: italic; color: #b8a089;">& retours</em>
            </h1>
            <p style="color: #6b5f55; max-width: 600px; margin: 0 auto; font-size: 1.1rem;">
                Nous mettons un point d’honneur à vous offrir une expérience d’achat fluide, de l’atelier à votre porte.
            </p>
        </div>

        {{-- Grille principale --}}
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px;">

            {{-- Colonne gauche : Livraison et détails --}}
            <div>

                {{-- Livraison --}}
                <div style="margin-bottom: 40px;">
                    <h2 style="font-size: 2rem; font-weight: 300; margin-bottom: 12px; border-bottom: 2px solid #e8e0d8; padding-bottom: 12px;">
                        <span style="font-weight: 500;">Livraison</span>
                    </h2>
                    <p style="margin-bottom: 20px; line-height: 1.6;">
                        Chaque commande est préparée avec soin dans notre atelier de Cotonou.
                        Vous recevrez un numéro de suivi par e‑mail dès que votre colis sera remis au transporteur.
                    </p>

                    {{-- Tableau des délais et frais --}}
                        {{-- <div style="background: #faf8f6; border-radius: 12px; padding: 20px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                            <table class="data table table-hover align-middle" style="width: 100%; border-collapse: collapse; font-size: 0.95rem;">
                                <thead>
                                    <tr style="border-bottom: 2px solid #ddd6ce;">
                                        <th style="text-align: left; padding: 10px 8px;">Destination</th>
                                        <th style="text-align: left; padding: 10px 8px;">Délai estimé</th>
                                        <th style="text-align: left; padding: 10px 8px;">Frais</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="border-bottom: 1px solid #ede8e2;">
                                        <td style="padding: 10px 8px;"><strong>Cotonou</strong></td>
                                        <td style="padding: 10px 8px;">48 heures ouvrées</td>
                                        <td style="padding: 10px 8px;">1 500 FCFA</td>
                                    </tr>
                                    <tr style="border-bottom: 1px solid #ede8e2;">
                                        <td style="padding: 10px 8px;"><strong>Reste du Bénin</strong></td>
                                        <td style="padding: 10px 8px;">3 à 5 jours ouvrés</td>
                                        <td style="padding: 10px 8px;">Sur confirmation</td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 10px 8px;"><strong>International</strong></td>
                                        <td style="padding: 10px 8px;">7 à 12 jours ouvrés</td>
                                        <td style="padding: 10px 8px;">Sur devis</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> --}}

                    <p style="font-size: 0.9rem; color: #7a6b5e; background: #faf8f6; padding: 12px 16px; border-radius: 8px; border-left: 4px solid #b8a089;">
                        ⚠️ Les délais peuvent varier pendant les périodes de forte activité (ex : soldes, fin d’année).
                        Nous vous tiendrons informé en cas de retard.
                    </p>
                </div>

                {{-- Processus de retour détaillé --}}
                <div style="margin-bottom: 40px;">
                    <h2 style="font-size: 2rem; font-weight: 300; margin-bottom: 12px; border-bottom: 2px solid #e8e0d8; padding-bottom: 12px;">
                        <span style="font-weight: 500;">Retours</span>
                    </h2>
                    <p style="margin-bottom: 16px; line-height: 1.6;">
                        Vous disposez de <strong>7 jours</strong> après réception de votre commande pour demander un retour,
                        conformément à notre politique de satisfaction.
                    </p>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div style="background: #faf8f6; border-radius: 12px; padding: 18px;">
                            <h4 style="font-size: 1.1rem; margin: 0 0 8px; display: flex; align-items: center; gap: 8px;">
                                <span style="font-size: 1.4rem;">✅</span> Conditions
                            </h4>
                            <ul style="margin: 0; padding-left: 20px; list-style: disc; line-height: 1.6; color: #3d352e;">
                                <li>Article non porté, non lavé, avec ses étiquettes d’origine.</li>
                                <li>Retour accompagné de la preuve de commande (facture ou e‑mail).</li>
                                <li>Les pièces personnalisées ou retouchées ne sont pas reprises.</li>
                            </ul>
                        </div>
                        <div style="background: #faf8f6; border-radius: 12px; padding: 18px;">
                            <h4 style="font-size: 1.1rem; margin: 0 0 8px; display: flex; align-items: center; gap: 8px;">
                                <span style="font-size: 1.4rem;">🔄</span> Processus
                            </h4>
                            <ol style="margin: 0; padding-left: 20px; line-height: 1.8; color: #3d352e;">
                                <li>Contactez-nous via la page <a href="{{ route('contact') }}" style="color: #b8a089; text-decoration: underline;">Contact</a>.</li>
                                <li>Nous vous envoyons les instructions et l’étiquette de retour.</li>
                                <li>Renvoyez le colis à l’adresse indiquée.</li>
                                <li>Remboursement sous 5 jours ouvrés après réception.</li>
                            </ol>
                        </div>
                    </div>

                    <div style="background: #eef3f0; border-radius: 12px; padding: 16px 20px; display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                        <span style="font-size: 2rem;">💬</span>
                        <div>
                            <strong style="display: block;">Une question ?</strong>
                            <span style="font-size: 0.95rem;">Écrivez-nous via <a href="{{ route('contact') }}" style="color: #b8a089; text-decoration: underline; font-weight: 500;">notre formulaire de contact</a> ou par e‑mail à <a href="mailto:sav@lamaison.bj" style="color: #b8a089; text-decoration: underline;">sav@lamaison.bj</a>.</span>
                        </div>
                    </div>
                </div>

                {{-- FAQ --}}
                <div style="margin-bottom: 40px;">
                    <h2 style="font-size: 1.6rem; font-weight: 300; margin-bottom: 16px;">Questions fréquentes</h2>
                    <div style="display: grid; gap: 12px;">
                        <details style="background: #faf8f6; border-radius: 8px; padding: 12px 18px; border: 1px solid #ede8e2;">
                            <summary style="font-weight: 500; cursor: pointer;">Puis‑je modifier mon adresse de livraison après la commande ?</summary>
                            <p style="margin: 8px 0 0; padding-top: 8px; border-top: 1px solid #e0d8d0; color: #4a4038;">Oui, dans les 2 heures suivant la validation. Contactez‑nous immédiatement.</p>
                        </details>
                        <details style="background: #faf8f6; border-radius: 8px; padding: 12px 18px; border: 1px solid #ede8e2;">
                            <summary style="font-weight: 500; cursor: pointer;">Les frais de retour sont‑ils à ma charge ?</summary>
                            <p style="margin: 8px 0 0; padding-top: 8px; border-top: 1px solid #e0d8d0; color: #4a4038;">Sauf cas d’erreur de notre part, les frais de retour sont à la charge du client.</p>
                        </details>
                        <details style="background: #faf8f6; border-radius: 8px; padding: 12px 18px; border: 1px solid #ede8e2;">
                            <summary style="font-weight: 500; cursor: pointer;">Que faire si mon colis est endommagé ?</summary>
                            <p style="margin: 8px 0 0; padding-top: 8px; border-top: 1px solid #e0d8d0; color: #4a4038;">Refusez le colis ou prenez des photos et contactez‑nous dans les 48h.</p>
                        </details>
                    </div>
                </div>
            </div>

            {{-- Colonne droite : Panneau Retours et formulaire d'avis --}}
            <aside>

                {{-- Panneau Retours (simplifié) --}}
                <div class="panel" style="background: #f5f0eb; border-radius: 16px; padding: 24px; margin-bottom: 30px; box-shadow: 0 4px 12px rgba(0,0,0,0.04);">
                    <h3 style="font-size: 1.8rem; font-weight: 300; margin: 0 0 12px;">Retours en bref</h3>
                    <ul style="list-style: disc; margin: 0 0 16px 20px; line-height: 1.8; color: #3d352e;">
                        <li>7 jours pour demander un retour</li>
                        <li>Article intact et étiqueté</li>
                        <li>Preuve de commande obligatoire</li>
                        <li>Personnalisé & retouché : non repris</li>
                    </ul>
                    <a href="{{ route('contact') }}" style="display: inline-block; background: #b8a089; color: #fff; padding: 10px 24px; border-radius: 40px; text-decoration: none; font-weight: 500; transition: background 0.2s;">
                        Contacter le service client
                    </a>
                </div>

                {{-- Formulaire d'avis avec étoiles dynamiques --}}
                <div style="background: #ffffff; border-radius: 16px; padding: 24px; border: 1px solid #ede8e2; box-shadow: 0 4px 12px rgba(0,0,0,0.04);">
                    <h3 style="font-size: 1.4rem; font-weight: 300; margin: 0 0 8px;">Donnez votre avis</h3>
                    <p style="font-size: 0.95rem; color: #6b5f55; margin-bottom: 20px;">Votre retour d’expérience nous aide à nous améliorer.</p>

                    <form action="#" method="POST" style="display: flex; flex-direction: column; gap: 16px;">
                        @csrf
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                            <div>
                                <label for="avis_nom" style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 4px;">Nom</label>
                                <input type="text" id="avis_nom" name="nom" placeholder="Votre nom" required style="width: 100%; padding: 10px 12px; border: 1px solid #ddd6ce; border-radius: 8px; background: #faf8f6; font-size: 0.95rem;">
                            </div>
                            <div>
                                <label for="avis_email" style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 4px;">E‑mail</label>
                                <input type="email" id="avis_email" name="email" placeholder="votre@email.com" required style="width: 100%; padding: 10px 12px; border: 1px solid #ddd6ce; border-radius: 8px; background: #faf8f6; font-size: 0.95rem;">
                            </div>
                        </div>

                        {{-- Étoiles dynamiques --}}
                        <div>
                            <label style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 6px;">Votre note</label>
                            <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                <div class="star-wrapper" style="display: flex; gap: 4px; user-select: none; direction: ltr;">
                                    <span class="rating-star" data-value="1" style="cursor: pointer; font-size: 2rem; line-height: 1; color: #ddd6ce; transition: color 0.15s;">★</span>
                                    <span class="rating-star" data-value="2" style="cursor: pointer; font-size: 2rem; line-height: 1; color: #ddd6ce; transition: color 0.15s;">★</span>
                                    <span class="rating-star" data-value="3" style="cursor: pointer; font-size: 2rem; line-height: 1; color: #ddd6ce; transition: color 0.15s;">★</span>
                                    <span class="rating-star" data-value="4" style="cursor: pointer; font-size: 2rem; line-height: 1; color: #ddd6ce; transition: color 0.15s;">★</span>
                                    <span class="rating-star" data-value="5" style="cursor: pointer; font-size: 2rem; line-height: 1; color: #ddd6ce; transition: color 0.15s;">★</span>
                                </div>
                                <span id="rating-text" style="font-size: 0.95rem; color: #6b5f55; min-width: 40px;">0/5</span>
                            </div>
                            <input type="hidden" name="note" id="rating-value" value="0">
                        </div>

                        <div>
                            <label for="avis_commentaire" style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 4px;">Votre commentaire</label>
                            <textarea id="avis_commentaire" name="commentaire" rows="3" placeholder="Partagez votre expérience..." style="width: 100%; padding: 10px 12px; border: 1px solid #ddd6ce; border-radius: 8px; background: #faf8f6; font-size: 0.95rem; resize: vertical;"></textarea>
                        </div>

                        <button type="submit" style="background: #b8a089; color: #fff; border: none; padding: 12px; border-radius: 40px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: background 0.2s; margin-top: 4px;">
                            Envoyer mon avis
                        </button>
                    </form>
                    <p style="font-size: 0.8rem; color: #8a7b6e; margin-top: 12px; text-align: center;">Votre avis sera publié après modération.</p>
                </div>
            </aside>
        </div>
    </div>
</section>

{{-- Script dynamique pour les étoiles --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.rating-star');
        const ratingInput = document.getElementById('rating-value');
        const ratingText = document.getElementById('rating-text');
        let selectedRating = parseInt(ratingInput.value) || 0;

        function updateStars(rating) {
            stars.forEach(star => {
                const val = parseInt(star.dataset.value);
                star.style.color = val <= rating ? '#f5b342' : '#ddd6ce';
            });
            ratingText.textContent = rating + '/5';
        }

        stars.forEach(star => {
            star.addEventListener('mouseenter', function() {
                const val = parseInt(this.dataset.value);
                updateStars(val);
            });

            star.addEventListener('mouseleave', function() {
                updateStars(selectedRating);
            });

            star.addEventListener('click', function() {
                selectedRating = parseInt(this.dataset.value);
                ratingInput.value = selectedRating;
                updateStars(selectedRating);
            });
        });

        // Initialisation
        updateStars(selectedRating);
    });
</script>
@endsection
