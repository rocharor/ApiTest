# Serviço de Lote.

API de teste

## Pré-requisitos

* PHP >= 7.2
* Docker
* Docker compose

### Começando 1
- Instalação do ambiente (DOCKER):

Entrar na pasta laradock e rodar o comando "docker-compose up -d nginx mysql workspace"
Deve iniciar 5 container:
    - laradock_nginx_1
    - laradock_php-fpm_1
    - laradock_workspace_1
    - laradock_docker-in-docker_1
    - laradock_mysql_1 (user: root, password:root, database: api-test)

Após necessário rodar os comando dentro do container workspace:
    - docker exec -it laradock_workspace_1 php artisan migate
    - docker exec -it laradock_workspace_1 php artisan passport:install

* Acessar "http://localhost" para ver a documentação dos endpoints