FROM php:8.4-fpm-bullseye

# Проверка архитектуры
RUN uname -a
RUN file /lib/x86_64-linux-gnu/libzstd.so.1 || echo "libzstd not found"

# Установка системных зависимостей
RUN apt-get update
RUN apt-get install -y vim
RUN apt-get install -y git
RUN apt-get install -y libzip-dev
RUN apt-get install -y zip
RUN apt-get install -y unzip
RUN apt-get install -y libpq-dev
RUN rm -rf /var/lib/apt/lists/*

# Установка PHP расширений через PECL
RUN pecl install \
    xdebug \
    redis

# Установка PHP расширений
RUN docker-php-ext-install -j "$(nproc)" \
    zip \
    pdo_pgsql \
    pgsql \
    pcntl

# Включение PHP расширений
RUN docker-php-ext-enable \
    xdebug \
    redis

# Очистка кеша apt
RUN apt-get clean -y && apt-get autoclean -y && apt-get autoremove -y \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Установка Composer
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && rm composer-setup.php

# Добавление Composer в PATH
ENV PATH=/root/.composer/vendor/bin:$PATH

# Создание и настройка директории для приложения
RUN mkdir -p /backend
RUN chown -R www-data:www-data /backend

# Установка рабочей директории
WORKDIR /backend

# Открытие порта 9000 (стандартный для PHP-FPM)
EXPOSE 9000
