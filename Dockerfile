# Utilisation d'une image de base avec Apache préinstallé
FROM php:8.2.4-apache

# Installation de l'extension MySQLi
RUN docker-php-ext-install mysqli

# Copie d'une page HTML de bienvenue
COPY . /var/www/html/cloud1

# Exposition du port 80 (par défaut pour Apache)
EXPOSE 80
