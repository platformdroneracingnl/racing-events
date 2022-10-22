FROM php:8-fpm-buster

# Copy composer.lock and composer.json
COPY composer.lock composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    libmagickwand-dev  \
    default-mysql-client \
    iputils-ping \
    libonig-dev \
    libpng-dev \
    libjpeg-dev \
    libzip-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

#####################################
# Setup GD library
#####################################
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg

#####################################
# Imagick:
#####################################
RUN pecl install imagick && \
    docker-php-ext-enable imagick

#####################################
# Install extensions
#####################################
RUN docker-php-ext-install mbstring pdo pdo_mysql gd pcntl zip

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy existing application directory permissions
COPY --chown=1001:1001 . /var/www

# Change current user
USER 1001

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]