# Gunakan PHP 7.4 dengan Apache, sesuai dengan yang ada di composer.json
FROM php:7.3-apache

# Instal ekstensi yang dibutuhkan oleh CodeIgniter
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Aktifkan mod_rewrite untuk URL-friendly
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Salin seluruh file ke container
COPY . /var/www/html

# Salin file .htaccess jika ada
COPY .htaccess /var/www/html/.htaccess

# Ubah permissions agar folder writable
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Salin Composer ke container dari image composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependensi dengan Composer
RUN composer install --no-interaction --no-dev --optimize-autoloader

# Ubah konfigurasi Apache untuk mod_rewrite
RUN echo "<Directory /var/www/html>\n\
    AllowOverride All\n\
</Directory>" >> /etc/apache2/apache2.conf

# Expose port 80 untuk diakses
EXPOSE 80

# Jalankan Apache di foreground
CMD ["apache2-foreground"]
