# Use official PHP image
FROM php:8.2-cli

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Copy application files
COPY . .

# Expose port
EXPOSE 8080

# Start PHP server
CMD cd php-app/public && php -S 0.0.0.0:$PORT index.php
