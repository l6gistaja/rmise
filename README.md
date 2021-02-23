This is dockerized Laravel with Elasticsearch demo, inspired by https://itnext.io/the-ultimate-guide-to-elasticsearch-in-laravel-application-ee636b79419c

## Setup

Following describes setup under Debian Linux 10.

1. If not already installed, install docker and docker-compose
1. Go to laradock directory and run ```docker-compose up -d apache2 mysql elasticsearch``` . If elasticsearch container dies, try to run ```sudo /sbin/sysctl -w vm.max_map_count=262144``` before upping containers
1. If you use this package first time, run ```docker-compose exec workspace composer install```
1. Point your browser to http://localhost

You can tear down containers with ```docker kill $(docker ps -q)``` afterwards.
