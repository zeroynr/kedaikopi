# Gunakan PHP 7.3 dengan Apache
FROM php:7.3-apache

# Instal ekstensi MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Aktifkan mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Salin semua file ke container
COPY . /var/www/html

# Salin .htaccess (opsional jika sudah ada di COPY .)
COPY .htaccess /var/www/html/.htaccess

# Pastikan folder writable (cache/log/sessions jika digunakan)
RUN mkdir -p /var/www/html/application/cache/sessions && \
    chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html

# Salin composer dari image composer resmi
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Jalankan composer install (pastikan composer.lock ada jika tidak, bisa gagal)
RUN composer install --no-interaction --no-dev --optimize-autoloader || true

# Tambahkan AllowOverride agar .htaccess bekerja
RUN echo "<Directory /var/www/html>\n\
    AllowOverride All\n\
</Directory>" >> /etc/apache2/apache2.conf

# Expose port
EXPOSE 80

# Jalankan apache
CMD ["apache2-foreground"]
