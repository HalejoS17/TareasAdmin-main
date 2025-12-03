FROM php:8.2-cli

# Instalar dependencias necesarias
RUN apt-get update && apt-get install -y \
    sqlite3 \
    libsqlite3-dev \
    unzip \
    zip \
    git

# Habilitar extensiones
RUN docker-php-ext-install pdo pdo_sqlite

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar proyecto
COPY . .

# Instalar dependencias PHP
RUN composer install --no-interaction --prefer-dist

# Generar key automáticamente
RUN php artisan key:generate

# Crear base sqlite dentro del contenedor
RUN mkdir -p database && touch database/database.sqlite

# Exponer el puerto
EXPOSE 8000

# Comando de inicio automático
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
