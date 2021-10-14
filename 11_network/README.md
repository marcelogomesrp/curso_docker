# Explicação


# Gerenciar redes 

```
docker network create minha_rede
docker network list
docker network remove minha_rede

```


# Carregar o container do MySQL na rede minha_rede

```

docker run -d --rm --name=mysql  \
    -p 3306:3306 \
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
