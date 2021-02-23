#!/bin/bash

cd laradockm
docker-compose up -d apache2 mysql elasticsearch
docker-compose exec workspace composer install
docker-compose exec workspace php artisan migrate
