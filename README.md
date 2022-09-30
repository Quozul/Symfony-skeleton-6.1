# Symfony Docker (PHP8 / Caddy / Postgresql)

A [Docker](https://www.docker.com/)-based installer and runtime for the [Symfony](https://symfony.com) web framework, with full [HTTP/2](https://symfony.com/doc/current/weblink.html), HTTP/3 and HTTPS support.

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)
2. Run `docker compose build --pull --no-cache` to build fresh images
3. Run `docker compose up` (the logs will be displayed in the current shell) or Run `docker compose up -d` to run in background 
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Run `docker compose down --remove-orphans` to stop and remove the Docker containers.
6. Run `docker compose logs -f` to display current logs, `docker compose logs -f [CONTAINER_NAME]` to display specific container's current logs 

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
```