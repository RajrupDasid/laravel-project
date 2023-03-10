FROM php:8.0
FROM archlinux:latest
RUN pacman -Syyu --noconfirm
RUN  pacman -S git curl libmcrypt libjpeg-turbo libpng  bzip2 --noconfirm
RUN pacman -S php-pgsql zip --noconfirm
# Install Composer
RUN curl --silent --show-error "https://getcomposer.org/installer" | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel Envoy
RUN composer global require "laravel/envoy=~1.0"