# Explicação


# Gerenciar redes 

```
docker network create minha_rede
docker network list
docker network remove minha_rede

```

# Subir dois containers na minha_rede

```
docker run -it --rm --name=no1 --network minha_rede ubuntu:20.04
docker run -it --rm --name=no2 --network minha_rede ubuntu:20.04

```

## Instalar o ping em um dos containers
```
apt-get update && apt-get install iputils-ping -y

```


# Carregar o container do MySQL na rede minha_rede

```

docker run -d --rm --name=mysql  \
    -v $(pwd)/datadir:/var/lib/mysql \
    -e MYSQL_ROOT_PASSWORD=senha \
    -e MYSQL_ROOT_HOST=% \
    --network minha_rede \
    mysql \
    --default-authentication-plugin=mysql_native_password

```

# Carregar o container do PhpMyAdmin na rede minha_rede

```
docker run -d --rm --name=phpmyadmin \
    -p 80:80 \
    -e PMA_HOST=mysql \
    -e MYSQL_ROOT_PASSWORD=senha \
    --network minha_rede \
    phpmyadmin/phpmyadmin

```
