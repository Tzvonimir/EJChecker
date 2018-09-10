FROM ubuntu:16.04

# Replace shell with bash so we can source files
RUN rm /bin/sh && ln -s /bin/bash /bin/sh

# Set debconf to run non-interactively
RUN echo 'debconf debconf/frontend select Noninteractive' | debconf-set-selections

RUN apt-get update && apt-get install -y \
    php \
    php-mbstring \
    php-dom \
    php-zip \
    php-mysql \
    composer \
    nodejs-legacy \
    curl \
    nginx \
    npm \
    vim \
    git \
    zip \
    unzip \
    bzip2 \
    mysql-client \
    openjdk-8-jdk \
    screen \
&& rm -rf /var/lib/apt/lists/*

COPY nginx.conf /etc/nginx/nginx.conf
COPY docker_init.sh /docker_init.sh
