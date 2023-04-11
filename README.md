# technical-test-leboncoin


## Endpoints
AdAuto :
| Verb | Endpoint | Description |
| --- | --- | --- |
| POST | /autos | create a new ad for an auto |
| GET | /autos | read ad auto list |
| GET | /autos/{id} | read ad auto details |
| PUT | /autos/{id} | update an ad auto |
| DELETE | /autos/{id} | delete an ad auto |



## Docker
docker-compose build

docker-compose up -d

docker exec -it www_docker_symfony_api bash

php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force