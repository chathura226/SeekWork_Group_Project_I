# Use an official PHP image as the base
FROM php:apache

# Install GD extension
RUN apt-get update && \
    apt-get install -y \
    libjpeg-dev \
    libpng-dev \
    && docker-php-ext-configure gd --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd
    
# Install the mysqli and pdo extension
RUN docker-php-ext-install mysqli pdo pdo_mysql

#for Rewrite ENgine 
RUN a2enmod rewrite

#restart service
RUN service apache2 restart

#to give permission to read (otherwise in windows env , site wont work)
RUN chmod -R +rx /var/www

