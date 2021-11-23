# Breaking Dev

## Étapes d'initialisation

1. Cloner le repo depuis Github.
2. Excécuter `composer install`.
3. Créer une base de données *breakingdev* et créer *config/db.php* à partir du fichier *config/db.php.dist*. Ajouter vos paramètres pour vous connecter à la base de données. Ne pas effacer le fichier *.dist*, il doit rester là.
```php
define('APP_DB_HOST', 'your_db_host');
define('APP_DB_NAME', 'your_db_name');
define('APP_DB_USER', 'your_db_user_wich_is_not_root');
define('APP_DB_PASSWORD', 'your_db_password');
```
4. Importer *database.sql* dans votre base de données en exécutant
```bash
php migration.php
```
5. Lancer le serveur avec `php -S localhost:8000 -t public/`.
6. Aller sur `localhost:8000`.
7. Et c'est parti codez !

### Utilisateurs Windows

Si vous codez sous windows, vous devriez configurer la configuration de git pour mieux gérer les caractères de fin de ligne. Pour cel, exécutez la commande suivante :

`git config --global core.autocrlf true`