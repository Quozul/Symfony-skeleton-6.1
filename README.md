# Symfony Docker (PHP8 / Caddy / Postgresql)

A [Docker](https://www.docker.com/)-based installer and runtime for the [Symfony](https://symfony.com) web framework, with full [HTTP/2](https://symfony.com/doc/current/weblink.html), HTTP/3 and HTTPS support.

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)
2. Run `docker compose build --pull --no-cache` to build fresh images
3. Run `docker compose up` (the logs will be displayed in the current shell) or Run `docker compose up -d` to run in background 
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Run `docker compose down --remove-orphans` to stop and remove the Docker containers.
6. Run `docker compose logs -f` to display current logs, `docker compose logs -f [CONTAINER_NAME]` to display specific container's current logs 

## Adminer
1. Navigate to [http://localhost:8080](http://localhost:8080)
2. Use the following credentials:
    - System: `PostgreSQL` 
    - Server: `database`
    - Username: `symfony`
    - Password: `ChangeMe`
    - Database: `app`

## Pages of this project

- [List Pokemons](https://localhost/admin/pokemon)
- [List types](https://localhost/admin/type)
- [Login](https://localhost/login)

## Commands

```shell
# Create a new controller
docker compose exec php bin/console make:controller

# If you are lazy, create an alias
alias con="docker compose exec php bin/console"

# Create a new entity
con make:entity

# Create migration file
con make:migration

# Create a new crud
con make:crud

# Apply migration
con doctrine:migrations:migrate

# Revert migration
con doctrine:migrations:migrate prev

# Create database
con doctrine:database:create

# Drop database
con doctrine:database:drop

# List all routes
con debug:route

# Create a use
con make:user

# Create an authenticator
con make:auth

# Hash a string
con security:hash

# Install `orm-fixtures` package
docker compose exec php composer require orm-fixtures --dev

# Update fixtures and purge database
con d:f:l -n

# Install `faker` package
docker compose exec php composer require fakerphp/faker --dev

# https://github.com/doctrine-extensions/DoctrineExtensions
docker compose exec php composer require stof/doctrine-extensions-bundle
# Answer "Y" to the question asked during the installation process

docker compose exec php composer require symfony/validator

docker compose exec php composer require vich/uploader-bundle
```