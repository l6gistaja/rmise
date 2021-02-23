#!/bin/bash

git submodule add https://github.com/Laradock/laradock.git
cd laradock
cp env-example .env
docker-compose up -d apache2 mysql elasticsearch
docker-compose exec workspace composer install
docker-compose exec workspace composer auto-dump
docker-compose exec workspace php artisan migrate
