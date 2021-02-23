This is dockerized Laravel with Elasticsearch demo, inspired by https://itnext.io/the-ultimate-guide-to-elasticsearch-in-laravel-application-ee636b79419c

## Setup

Following describes setup under Debian Linux 10.

1. If not already installed, install bash, git, docker and docker-compose
1. ```sudo /sbin/sysctl -w vm.max_map_count=262144```
1. Download current project: ```git clone git@github.com:l6gistaja/rmise.git```
1. Enter project directory and run installer: ```cd rmise ; ./install.bash```
1. Point your browser to http://localhost

You can tear down containers with ```docker kill $(docker ps -q)``` afterwards.
