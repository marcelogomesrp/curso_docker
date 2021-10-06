# Explicação

# Carregar o container do MySQL

```
docker run -d --rm --name=mysql  \
    -p 3306:3306 \
    -v $(pwd)/datadir:/var/lib/mysql \
    -e MYSQL_ROOT_PASSWORD=senha \
    -e MYSQL_ROOT_HOST=% \
    mysql
```

## Configura o banco

```
mysql -u root --password=senha -h 192.168.68.106 < bd.sql
```

# Site do Wordpress
[https://br.wordpress.org/download/#download-install](https://br.wordpress.org/download/#download-install)
