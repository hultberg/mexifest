FROM php:7.0-cli

# Install composer
RUN curl -LO https://getcomposer.org/download/1.5.1/composer.phar \
    && chmod +x composer.phar \
    && mv composer.phar /usr/bin/composer

# Install git, zip and unzip
RUN apt-get update && apt-get install -y git libzip-dev zip unzip

# Enable zip extension.
RUN docker-php-ext-install zip
