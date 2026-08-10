# LA MAISON — Application e‑commerce

Projet "La Maison" : boutique en ligne complète (front, panier, tunnel de commande, espace client et back-office d'administration) développée avec Laravel. Ce dépôt contient l'application — ce n'est plus un simple template.

## Aperçu

- Stack : PHP 8.1+, Laravel 10/11, Vite pour les assets, Pest/PHPUnit pour les tests.
- Fonctionnalités principales : catalogue avec filtres, fiche produit, panier, checkout, gestion des commandes et interface d'administration.

## Fonctionnalités

- Catalogue produit avec filtres par catégorie, prix et tri.
- Fiches produits détaillées : galerie d'images, déclinaisons (tailles, coloris), gestion du stock.
- Panier avec résumé, gestion des quantités et codes promotionnels.
- Tunnel de commande (checkout) : adresse, options de livraison, paiement (squelette Kkiapay + paiement à la livraison).
- Espace client : inscription, connexion, tableau de bord, historique de commandes, adresses et favoris.
- Back‑office : gestion des produits, commandes (statuts), promotions, alertes de stock et statistiques.
- Données de développement : `app/Support/DemoData.php` pour travailler sans base de données complète.
- Seeders et migrations fournis pour initialiser la base (`DatabaseSeeder`, `AdminUserSeeder`).
- Authentification prête à l'emploi via Fortify (fichiers et provider présents).
- Assets modernes (Vite, CSS et JS), responsive et optimisés pour mobile.
- Tests unitaires et fonctionnels avec Pest/PHPUnit.
- Bonnes pratiques SEO de base et structure des templates Blade pour adaptation.

## Prérequis

- PHP >= 8.1
- Composer
- Node.js >= 16 et npm/yarn
- Une base de données (MySQL, MariaDB, SQLite...)

## Installation (locale)

1. Cloner le dépôt :

```bash
git clone <url-du-dépôt>
cd e-commerce
```

2. Installer les dépendances PHP :

```bash
composer install
cp .env.example .env
php artisan key:generate
```

3. Configurer la base de données dans le fichier `.env`, puis lancer les migrations et (optionnel) les seeders :

```bash
php artisan migrate
php artisan db:seed --class=DatabaseSeeder
```

Si vous souhaitez créer l'utilisateur administrateur fourni par le seeder :

```bash
php artisan db:seed --class=AdminUserSeeder
```

4. Installer et compiler les assets :

```bash
npm install
npm run dev   # ou `npm run build` pour production
```

5. Lancer l'application :

```bash
php artisan serve
# ou utiliser Sail / Docker si configuré
```

Ouvrir le site : http://localhost:8000 et le back-office : http://localhost:8000/admin

## Configuration importante

- Variables à renseigner dans `.env` : `DB_*`, `MAIL_*`, `APP_URL`, `KKIAPAY_*` (si utilisation de Kkiapay).
- Le code contient `app/Support/DemoData.php` pour faciliter le développement sans base de données complète ; en production, utilisez les migrations et modèles Eloquent.

## Tests

Exécuter la suite de tests :

```bash
composer test # ou vendor/bin/pest
```

## Développement et contribution

- Respecter les conventions PSR et le style du code existant.
- Ouvrir une branche par fonctionnalité : `feature/xxx`.
- Créer une MR/PR avec une description claire et les étapes pour tester.

## Accès admin

Le seeder `database/seeders/AdminUserSeeder.php` permet de créer un compte administrateur pour accéder à `/admin`. Lancer le seeder après les migrations pour générer l'utilisateur.

## Déploiement

- Compiler les assets (`npm run build`), exécuter les migrations, configurer la gestion des queues et des tâches planifiées (cron) et sécuriser les variables d'environnement.

## Licence

Voir le fichier `LICENSE` (si présent) ou demander à l'équipe juridique pour le type de licence à appliquer.

## Contact

Pour toute question technique, ouvrir une issue dans le dépôt ou contacter l'équipe de développement.
