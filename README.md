# Place2Sleep

Place 2 Sleep - Sistema para la Administración de Cementerios

## Características

**Módulo Inhumaciones**
- [x] Nicho
- [x] Mausoleo

**Módulo Exhumaciones**
- [x] Nicho
- [x] Mausoleo

**Módulo Cementerio**
- [x] Nichos
- [x] Mausoleos
- [x] Pabellones

**Módulo Administración**
- [x] Difuntos
- [x] Familiares
- [x] Cementerios

## Requisitos y Despliegue

- WSL
- Docker

``` bash
# Composer
  docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs

# Sail
  ./vendor/bin/sail up -d
  ./vendor/bin/sail npm install
  ./vendor/bin/sail npm run dev
  ./vendor/bin/sail php artisan migrate --seed
```
