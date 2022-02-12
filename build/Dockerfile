FROM php:8.0-fpm

ARG USER
ARG USER_ID
ARG USER_GROUP

WORKDIR /var/www
ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC

RUN apt-get update && apt-get install -y \
    git \
    curl \
    nano \
    vim \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

RUN curl -sL https://getcomposer.org/installer | php -- --install-dir /usr/bin --filename composer

COPY ./build/start-container /usr/local/bin/start-container

RUN chmod +x /usr/local/bin/start-container

RUN groupadd --force -g $USER_GROUP $USER
RUN useradd -ms /bin/bash --no-user-group -g $USER_GROUP -u $USER_ID $USER
USER $USER
