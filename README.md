# LA MAISON — Template e-commerce Laravel

Template complet du site e-commerce (vitrine + boutique + espace client + back-office), issu de la maquette et conforme au cahier des charges : catalogue avec filtres, fiche produit (tailles, coloris, stock), panier, tunnel de commande avec paiement KKiaPay ou à la livraison, espace client, et interface d'administration (articles, commandes avec statuts, alertes de stock, promotions, statistiques).

Le template fonctionne immédiatement avec des **données de démonstration** (`app/Support/DemoData.php`), sans base de données. Il suffit ensuite de brancher vos modèles Eloquent.

## Contenu

```
routes/web.php                      Toutes les routes du site et du back-office
app/Http/Controllers/               ShopController, CartController, CheckoutController,
                                    AccountController, PageController, Admin/AdminController
app/Support/DemoData.php            Produits, commandes et statuts de démonstration
resources/views/
├── layouts/app.blade.php           Layout du site (en-tête, navigation, pied de page)
├── layouts/admin.blade.php         Layout du back-office (barre latérale)
├── home.blade.php                  Accueil : héros, réassurance, catégories, nouveautés
├── shop/index.blade.php            Catalogue avec filtres (catégorie, prix, tri)
├── shop/show.blade.php             Fiche produit : galerie, tailles, coloris, accordéons
├── shop/_card.blade.php            Carte produit réutilisable
├── cart/index.blade.php            Panier + récapitulatif + code promo
├── checkout/index.blade.php        Adresse, zone de livraison, paiement KKiaPay
├── checkout/confirmation.blade.php Confirmation de commande
├── account/login.blade.php         Connexion / création de compte
├── account/dashboard.blade.php     Commandes, favoris, adresses
├── pages/about.blade.php           À propos (histoire, valeurs, savoir-faire)
├── pages/contact.blade.php         Formulaire de contact + FAQ
└── admin/                          Tableau de bord, articles, commandes,
                                    promotions, statistiques
public/css/app.css                  Styles du site (responsive, mobile-first)
public/css/admin.css                Styles du back-office
public/js/app.js                    Menu mobile, coloris, galerie
```

## Installation

1. Créer un projet Laravel (10 ou 11) si ce n'est pas déjà fait :

   ```bash
   composer create-project laravel/laravel lamaison
   cd lamaison
   ```

2. Copier le contenu de ce template **par-dessus** le projet :

   ```bash
   cp -r routes app resources public /chemin/vers/lamaison/
   ```

   (Le fichier `routes/web.php` remplace celui d'origine.)

3. Lancer le serveur de développement :

   ```bash
   php artisan serve
   ```

4. Ouvrir :
   - Site : http://localhost:8000
   - Back-office : http://localhost:8000/admin

## Passage en production — points à brancher

- **Base de données** : remplacer `DemoData` par des modèles `Product`, `Category`, `Order`, `PromoCode` (migrations à créer). Les contrôleurs sont commentés aux endroits concernés.
- **Authentification** : installer Laravel Breeze ou Fortify pour l'espace client, et protéger le groupe de routes `/admin` avec un middleware `auth` + rôle administrateur.
- **Paiement KKiaPay** : le squelette d'intégration (widget JS + vérification serveur) est documenté en commentaire dans `resources/views/checkout/index.blade.php` et `CheckoutController.php`. Documentation officielle : https://docs.kkiapay.me
- **Emails automatiques** : créer des Mailables (confirmation de commande, expédition) déclenchés dans `CheckoutController@store` et au changement de statut dans le back-office.
- **Photos produits** : les visuels sont des placeholders CSS (`.ph`). Remplacer par de vraies images (`<img>` ou `background-image`) une fois les photos de la marque disponibles.
- **SEO** : les balises `title` et `meta description` sont dynamiques par page ; ajouter un sitemap et les balises Open Graph au lancement.

## Personnalisation rapide

Toute l'identité visuelle est centralisée dans les variables CSS en tête de `public/css/app.css` :

```css
:root {
  --ivoire: #F4F1E9;   /* fond de page */
  --encre:  #23201B;   /* texte */
  --terra:  #B0472B;   /* couleur d'accent */
  ...
}
```

Modifier ces valeurs (et les polices Google Fonts dans les layouts) suffit à adapter le template à l'identité définitive de la marque.
