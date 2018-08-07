FROM php:7.1-cli

# Install other required packages
RUN apt-get update && apt-get install -y libicu-dev libpq-dev libmcrypt-dev libcurl3-dev zlib1g-dev ca-certificates wget gnupg sudo

# Install PHP extensions and php.ini
RUN docker-php-ext-install intl curl mbstring mcrypt pcntl pdo pdo_mysql zip opcache
RUN apt-get clean && rm -rf /tmp/* /var/lib/apt/lists/*
RUN echo "memory_limit=-1" >> /usr/local/etc/php/php.ini

# Create docker user
RUN useradd -m -G www-data docker
RUN echo 'docker ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers
USER docker
RUN mkdir -p ~/.bin

ENV COMPOSER_HOME /home/docker/composer
ENV APP_HOME /home/docker/src

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/home/docker/.bin --filename=composer
RUN mkdir -p ${COMPOSER_HOME} && mkdir -p ${APP_HOME}
ENV PATH "${APP_HOME}/node_modules/.bin":"${APP_HOME}/vendor/bin":/home/docker/.bin:$PATH

VOLUME ${COMPOSER_HOME}
COPY . ${APP_HOME}
WORKDIR ${APP_HOME}

USER root

# Ensure right permissions
RUN chown -R docker:docker /home/docker
RUN chown -R docker:docker /home/docker/composer

# Install Xdebug
RUN pecl install xdebug \
  && docker-php-ext-enable xdebug \
  && xdebug_ini=$(find /usr/local/etc/php/conf.d/ -name '*xdebug.ini') \
  && if [ -z "$xdebug_ini" ]; then xdebug_ini="/usr/local/etc/php/conf.d/xdebug.ini" && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > $xdebug_ini; fi \
  && echo "xdebug.remote_enable=1"  >> $xdebug_ini \
  && echo "xdebug.remote_autostart=0" >> $xdebug_ini \
  && echo "xdebug.idekey=\"PHPSTORM\"" >> $xdebug_ini

ARG xdebug=1
RUN if [ $xdebug -eq 0 ]; then rm $(find /usr/local/etc/php/conf.d/ -name '*xdebug.ini'); fi

USER docker