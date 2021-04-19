# FROM php:7.4-apache

# RUN apt-get update && apt-get install -y libpq-dev

# RUN apt-get install -y zlib1g-dev     libpq-dev git libicu-dev libxml2-dev libzip-dev\
#     && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
#     && docker-php-ext-install pdo pdo_pgsql pgsql \

# RUN curl https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

# WORKDIR /app
# FROM php:7.1.2-apache 
# RUN docker-php-ext-install mysqli pdo pdo_pgsql pgsql

FROM php:7.4-apache

RUN apt-get update

#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
#RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
# RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/1b137f8bf6db3e79a38a5bc45324414a6b1f9df2/web/installer -O - -q | php -- --quiet
# RUN mv composer.phar /usr/local/bin/composer
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -s https://getcomposer.org/installer | php
RUN alias composer='php composer.phar'
# Install PDO and PGSQL Drivers
RUN apt-get install -y libpq-dev \
  && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
  && docker-php-ext-install pdo pdo_pgsql pgsql

