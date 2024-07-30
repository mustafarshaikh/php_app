# php/Dockerfile
FROM php:8.1-apache

# Install necessary PHP extensions
RUN apt-get update && \
    docker-php-ext-install mysqli pdo pdo_mysql

# Copy Apache config
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Copy PHP config
COPY php-config.ini /usr/local/etc/php/php.ini

# Enable Apache mods
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Copy application files
COPY src /var/www/html/

# Start Apache
CMD ["apache2-foreground"]
