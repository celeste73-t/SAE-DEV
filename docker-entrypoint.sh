#!/bin/bash
set -e

echo "➡️  Initialisation du conteneur PHP..."

# 1) Droits sur les fichiers (dev only)
chmod -R 777 /var/www/html

# 2) Appel de l’entrypoint officiel PHP
docker-php-entrypoint "$@"

# 3) Lancer le process final (Apache)
exec "$@"
