# Use an official PHP image as the base
FROM php:apache

# Install the mysqli and pdo extension
RUN docker-php-ext-install mysqli pdo pdo_mysql

#for Rewrite ENgine 
RUN a2enmod rewrite

#restart service
RUN service apache2 restart

#to give permission to read (otherwise in windows env , site wont work)
RUN chmod -R +rx /var/www

