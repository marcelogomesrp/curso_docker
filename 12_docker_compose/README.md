# Explicação docker compose


# Mario

```
cd mario
docker-compose up -d
docker-compose down
docker-compose rm

```

# Sometimes

```
cd sometimes
docker-compose build
docker-compose up -d
docker-compose logs -f
docker-compose down
docker-compse rm
```

# Ntimes
```
cd ntimes
docker-compose build
docker-compose up -d
docker-compose logs -f
docker-compose logs -f app
docker-compose logs -f redis
docker-compose down
docker-compse rm
```


# Wordpress

```
cd wordpress
docker network ls
docker-compose build
docker-compose up -d
docker-compose exec wordpress ls
docker-compose down
docker-compse rm
```

TAGs
- Docker Compose
    - Override
    - Secrets ( .env )    
- Commands:
    - docker-compose logs
    - docker-compose exec
- Apps
    - Mario
    - Python
    - Reds
    - Php
    - MySQL
    - Wordpress
    - PhpMyAdmin