# Argentix Genève — Mini e-commerce (MVC PHP + MySQL)

Projet pédagogique simple (minimaliste & moderne), sans framework.

## Installation locale (XAMPP/MAMP/WAMP)

1. Base de données
   - Ouvre phpMyAdmin → **SQL** → colle `sql/schema.sql` → Exécuter.
   - (Optionnel) Ajoute des exemples : `sql/seed.sql` → Exécuter.

2. Fichiers
   - Copie le dossier `argentix/` dans `htdocs/` (XAMPP) ou équivalent.

3. Configuration
   - Édite `app/config/config.php` si ton chemin diffère (`base_url`).

4. Lancer
   - Ouvre `http://localhost/argentix/public/index.php`

### Connexion admin
- Email : `admin@argentix.local`
- Mot de passe : `admin123`

## Structure
- `public/` : point d’entrée + `.htaccess`
- `app/core/` : `Router`, `Controller`, `Model`
- `app/config/` : DB (`db.php`), config (`config.php`)
- `app/controllers/` : Home, Product, Cart, Order, Auth, Admin
- `app/models/` : Product, Brand, User
- `app/views/` : layouts + pages
- `assets/css/style.css` : thème minimaliste & moderne
- `sql/` : `schema.sql`, `seed.sql`

## Critères couverts
- 6 tables MySQL dont **table d’association** `order_items` (**PK composite**).
- **Insertion** multi‑tables (commande + lignes).
- **Suppression logique** (produits via `is_active`).
- **Mise à jour/lecture** multi‑tables (catalogue + admin).
- **Maître‑détail** (commande / lignes).
- **Login + sessions**, validations serveur, messages.

Bon cours !
