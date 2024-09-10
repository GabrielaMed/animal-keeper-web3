# Use the official PHP image with Apache
FROM php:7.4-apache

# Install necessary extensions
RUN apt-get update && apt-get install -y postgresql-client\
    libpq-dev \
    && docker-php-ext-install pdo_pgsql pgsql

# Set the ServerName directive globally
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy application files
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Set the document root to the public directory
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Expose port 80
EXPOSE 80
