# Use official PHP image with Apache
FROM php:8.2-apache

# Enable Apache modules
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
    libzip-dev

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath

# Optional: Install zip extension
RUN docker-php-ext-install zip

# Set Apache document root to /var/www/html/public
RUN sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Allow .htaccess overrides
RUN sed -ri 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Set working directory
WORKDIR /var/www/html

# Copy Laravel files
COPY . .

# Fix file permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Allow Composer to run as root (inside container)
ENV COMPOSER_ALLOW_SUPERUSER=1
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