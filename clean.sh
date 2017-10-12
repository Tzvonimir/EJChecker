#!/bin/bash

docker stop $(docker ps -a -q)
docker rm $(docker ps -a -q)
docker images | awk 'FNR == 2 {print}' | awk '{ print $3 }' | xargs docker rmi
docker system prune -f
