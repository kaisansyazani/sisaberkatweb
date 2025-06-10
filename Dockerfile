FROM php:8.2-apache

# Enable mod_rewrite
RUN a2enmod rewrite headers expires alias mime

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zlib1g-dev \
    libzip-dev  # Required for zip extension

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath

# Optional: Install zip extension if needed
RUN docker-php-ext-install zip

# Set working directory
WORKDIR /var/www/html

# Copy files
COPY . .

# Allow Composer to run as root (inside container)
ENV COMPOSER_ALLOW_SUPERUSER=1

# Set higher memory limit for Composer
ENV COMPOSER_MEMORY_LIMIT=2G

# Install Composer
RUN curl -sS https://getcomposer.org/installer  | php -- --install-dir=/usr/local/bin --filename=composer

# Run Composer Install
RUN composer install --no-dev --optimize-autoloader

# Generate key
RUN cp .env.example .env && php artisan key:generate

# Clear caches (optional)
RUN php artisan config:clear && php artisan route:clear && php artisan view:clear

# Expose port and start Apache
EXPOSE 80
CMD ["apachectl", "-D", "FOREGROUND"]