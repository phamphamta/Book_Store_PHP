FROM php:8.1-apache

# Cài extension mysqli
RUN docker-php-ext-install mysqli

# Bật rewrite module của Apache
RUN a2enmod rewrite

# Copy mã nguồn vào thư mục web
COPY . /var/www/html/
