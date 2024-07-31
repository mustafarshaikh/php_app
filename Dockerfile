# Use the official PHP image as the base
FROM php:8.1-apache
USER root
# Install necessary PHP extensions and clean up
RUN apt-get update && \
    apt-get install -y --no-install-recommends iptables && \
    docker-php-ext-install mysqli pdo pdo_mysql && \
    docker-php-ext-enable pdo_mysql && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
# Install PHP_CodeSniffer and PHPStan
RUN curl -OL https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar && \
    curl -OL https://squizlabs.github.io/PHP_CodeSniffer/phpcbf.phar && \
    curl -OL https://phpstan.org/phpstan.phar && \
    chmod +x phpcs.phar phpcbf.phar phpstan.phar && \
    mv phpcs.phar /usr/local/bin/phpcs && \
    mv phpcbf.phar /usr/local/bin/phpcbf && \
    mv phpstan.phar /usr/local/bin/phpstan

# Copy Apache config
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Copy PHP config
COPY php-config.ini /usr/local/etc/php/php.ini

# Enable Apache mods
RUN a2enmod rewrite headers
# Security: Create a non-root user
RUN useradd -m -u 1000 phpuser
# USER phpuser

# Expose only necessary port
EXPOSE 80

# Copy application files
COPY src /var/www/html/

# Switch back to non-root user
# USER phpuser

# Start Apache in the foreground
CMD ["apache2-foreground"]
