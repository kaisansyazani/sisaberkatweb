# Use official PHP image with Apache
FROM php:8.2-apache

# Enable mod_rewrite for Laravel's pretty URLs
RUN a2enmod rewrite headers expires alias mime

# Install required PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mysqli opcache

# Set working directory
WORKDIR /var/www/html

# Copy local files
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer  | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate key
RUN cp .env.example .env && php artisan key:generate

# Run migrations (optional, can also be done manually later)
RUN php artisan migrate --force

# Expose port and start Apache
EXPOSE 80
CMD ["apachectl", "-D", "FOREGROUND"]