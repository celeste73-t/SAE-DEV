FROM php:8.2-apache

# Activer mod_rewrite
RUN a2enmod rewrite

# Extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Définir le DocumentRoot
ENV APACHE_DOCUMENT_ROOT=/var/www/html

RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf \
    /etc/apache2/apache2.conf

# Copier le script d’entrypoint
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh

# Le rendre exécutable
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Définir l’entrypoint custom
ENTRYPOINT ["docker-entrypoint.sh"]

# Commande par défaut (Apache)
CMD ["apache2-foreground"]

WORKDIR /var/www/html
