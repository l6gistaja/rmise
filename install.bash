#!/bin/bash

cd laradocks
docker-compose up -d apache2 mysql elasticsearch
docker-compose exec workspace php artisan migrate
