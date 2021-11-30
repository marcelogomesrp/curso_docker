# curso_docker
[Curso de docker](https://youtu.be/ScmgXebitlQ)

# 01 - Run
```
docker run -d --rm --name=nginx -p 80:80 nginx:1.21-alpine
```
To test
[http://localhost/](http://localhost/)


# 02 - Run and mount the wwww



```
mkdir -p /marcelo/16_nginx/wwww
toutch /marcelo/16_nginx/wwww/index.html

```
## index.html

```
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olá NGINX</title>
</head>
<body>
    <h1>Olá NGINX</h1>
</body>
</html>
```

```
docker run -d --rm --name=nginx -p 80:80 \
   -v /marcelo/16_nginx/wwww:/usr/share/nginx/html:ro \
   nginx:1.21-alpine
```



# 03 - Run Nginx with SSL


```
mkdir -p /marcelo/16_nginx/cfg
mkdir -p /marcelo/16_nginx/cert
cd /marcelo/16_nginx/cert

openssl req \
 -newkey rsa:4096 -nodes -sha256 -keyout 192.168.68.106.key \
 -x509 -days 365 -out 192.168.68.106.crt


docker run -it --rm --name=tmp -v /marcelo/16_nginx/cfg:/cfg nginx:1.21-alpine sh
cp /etc/nginx/* /cfg -R 
exit
sudo cp /marcelo/16_nginx/cfg/conf.d/default.conf /marcelo/16_nginx/cfg/conf.d/ssl.conf
```

Modifique o arquivo SSL.conf

- listen
- serve_name
- add ssl_certificate e ssl_certificate_key

```
server {
   listen       443 ssl;
   server_name  192.168.68.106;

   ssl_certificate /cert/192.168.68.106.crt;
   ssl_certificate_key /cert/192.168.68.106.key; 
```

## Redirecionando todas as chamadas para https

Edite o arquivo /marcelo/16_nginx/cfg/conf.d/default.conf

e adicione a linha: return 301 https://$host$request_uri; após o server_name (linha 4), seu arquivo ficar assim:

'''
server {
   listen       80;
   server_name  localhost;
   return 301 https://$host$request_uri;
''' 

## Run

```
docker run -d --rm --name=nginx \
   -p 80:80 \
   -p 443:443 \
   -v /marcelo/16_nginx/wwww:/usr/share/nginx/html:ro \
   -v /marcelo/16_nginx/cfg:/etc/nginx \
   -v /marcelo/16_nginx/cert:/cert:ro \
   nginx:1.21-alpine
```

# 04 Proxy Reverso

Edite o arquivo ssl.conf e adicione o location que desejar

'''
   location /uol {
       proxy_pass http://www.uol.com.br;
   }
'''   

# 05 Balanceamento de cargas

/marcelo/16_nginx/cfg/nginx.conf
Dentro de http {} adicione 

```
   upstream all {
      server 192.168.68.106:81;
      server 192.168.68.106:82;
  }

```

localize o location / (linha 7) e comente as duas linhas dentro dele e adicione o proxy_pass redirecionando para all

```
   location / {
       proxy_pass http://all/;
       #root   /usr/share/nginx/html;
       #index  index.html index.htm;
   }

```


```
```
 