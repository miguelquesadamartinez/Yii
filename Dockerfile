FROM php:7.4-apache

# Install PHP extensions
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip

# Enable Apache modules
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Download and install Yii Framework 1.1.24 FIRST
RUN curl -L -o yii.tar.gz "https://github.com/yiisoft/yii/archive/refs/tags/1.1.24.tar.gz" && \
    tar -xzf yii.tar.gz && \
    mv yii-1.1.24/framework framework && \
    rm -rf yii-1.1.24 && \
    rm yii.tar.gz

# Now copy application files (this won't overwrite framework)
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    mkdir -p /var/www/html/assets && \
    chmod -R 777 /var/www/html/assets && \
    mkdir -p /var/www/html/protected/runtime && \
    chmod -R 777 /var/www/html/protected/runtime

# Configure Apache
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html\n\
    <Directory /var/www/html>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog ${APACHE_LOG_DIR}/error.log\n\
    CustomLog ${APACHE_LOG_DIR}/access.log combined\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]
