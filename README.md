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
# Installation
  ./vendor/bin/sail up
  ./vendor/bin/sail npm install
  ./vendor/bin/sail npm run dev | prod
  
# Data Base Migration
  php artisan migrate --seed | migrate:refesh --seed

```
