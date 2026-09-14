# LA MAISON — Boutique e-commerce

Projet de boutique en ligne développé avec Laravel et Vite. La solution couvre la vitrine, le catalogue, le panier, le tunnel de commande, les avis clients et le back-office administratif.

## Stack technique

- PHP 8.3
- Laravel 13
- Laravel Fortify pour l'authentification
- Vite + Tailwind CSS + Bootstrap
- Pest pour les tests
- SQLite/MySQL/MariaDB selon l'environnement

## Aperçu des fonctionnalités

- Catalogue vitrine avec pages d'accueil et d'accessoires
- Fiches produit par slug avec affichage de détail produit
- Pages de contenu marketing : à propos, contact, livraison, guide des tailles, mentions légales, etc.
- Panier avec ajout, retrait, quantités et codes promotionnels
- Processus de commande avec validation et confirmation
- Système d'avis produits enregistrés en base
- Back-office admin avec gestion des :
  - produits
  - catégories
  - commandes et statuts
  - promotions
  - statistiques
- Données de démonstration via `app/Support/DemoData.php`
- Authentification gérée par Laravel Fortify et contrôle d'accès admin

## Structure du projet

```text
app/
  Http/Controllers/
  Http/Middleware/
  Models/
  Providers/
  Support/
config/
database/
public/
resources/
routes/
tests/
```

## Prérequis

- PHP >= 8.3
- Composer
- Node.js >= 18
- npm
- Une base de données compatible Laravel

## Installation locale

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

3. Configurer la base de données dans le fichier `.env`.

4. Lancer les migrations et les seeders nécessaires :

```bash
php artisan migrate
php artisan db:seed
```

Pour créer un compte administrateur :

```bash
php artisan db:seed --class=AdminUserSeeder
```

5. Installer les dépendances front :

```bash
npm install
npm run dev
```

6. Démarrer l'application :

```bash
php artisan serve
```

Puis ouvrir :
- site : http://localhost:8000
- back-office : http://localhost:8000/admin

## Commandes utiles

### Développement

```bash
npm run dev
php artisan serve
```

### Production

```bash
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Tests

```bash
composer test
# ou
php artisan test
```

### Script de setup rapide

Le projet propose aussi une commande d'installation complète :

```bash
composer run setup
```

## Variables d'environnement

À renseigner dans `.env` selon votre environnement :

- `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`
- `APP_URL`
- `MAIL_*`
- `SESSION_DRIVER`

## Sécurité et accès admin

L'application utilise Laravel Fortify pour l'authentification et appelle le middleware `admin` sur le back-office. Le compte administrateur peut être généré via le seeder dédié puis utilisé sur la route `/admin`.

## Déploiement

Pour un déploiement fiable :

- exécuter `npm run build`
- lancer les migrations sur l'environnement cible
- sécuriser les variables d'environnement
- configurer la gestion des files de tâches si nécessaire
- vérifier les accès administrateurs et les permissions

## Contribution

- créer une branche dédiée par fonctionnalité
- suivre le style du projet et les conventions Laravel
- documenter les changements importants
- tester avant soumission

## Licence

Ce projet est livré avec la licence MIT par défaut du skeleton Laravel, sauf précision contraire dans le dépôt.

## Contact

Pour toute demande ou signalement, ouvrir une issue dans le dépôt ou contacter l'équipe de développement.
