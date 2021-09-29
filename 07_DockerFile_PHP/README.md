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

# Gerar a imagem do php com suporte ao mysqli
```
docker build -f Dockerfile_dev -t php_mysqli:7.2-apache .
```
## Carregar o container para desenvolvimento
```
docker run -d --rm --name=php -p 80:80 -v $(pwd):/var/www/html  php_mysqli:7.2-apache
```

# Gerar a image com o nosso projeto
```
docker build -t aula .
```
## Carregar o container par produção
```
docker run -d --rm --name=aula -p 80:80 aula
```

