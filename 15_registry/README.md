# Youtube
[Curso de Docker - 15 Docker Registry](https://youtu.be/1-43ifaQkNk)
[Curso de Docker - 15 B -  Docker registry com SSL e Interface Web](https://youtu.be/GrXDWNhMUzc)
# Commands to test

## Get any image
```
docker pull hello-world:latest
```

## Change the image tag
```
docker tag hello-world:latest localhost:5000/olamundo:latest
```

## To send your imagem to your registry
```
docker push localhost:5000/olamundo:latest
```

## To see your imagem from your registry
```
curl -X GET http://localhost:5000/v2/_catalog
```


# 01 - Simple private Registry 

```
docker run -d \
    --rm \
    --name=registry \
    -p 5000:5000 \
    registry:2.7.1
```

# 02 - Simple private Registry without lost images

```
docker run -d \
    --rm \
    --name=registry \
    -p 5000:5000 \
    -v /data/marcelo/docker/registry_data:/var/lib/registry \
    registry:2.7.1
```

# 03 - Registry with login

## Create password

```
cd 03_Registry_with_login
mkdir auth
docker run --entrypoint htpasswd httpd:alpine3.14 -Bbn usuario senha >> auth/htpasswd
```

## RUN

```
docker run -d \
    --rm \
    --name=registry \
    -p 5000:5000 \
    -v /data/marcelo/docker/registry/data:/var/lib/registry \
    -v /home/marcelo/workspace/curso_docker/15_registry/03_Registry_with_login/auth:/auth \
    -e "REGISTRY_AUTH=htpasswd" \
    -e "REGISTRY_AUTH_HTPASSWD_REALM=Registry Realm" \
    -e "REGISTRY_AUTH_HTPASSWD_PATH=/auth/htpasswd" \
    -e REGISTRY_HTTP_HOST=http://localhost:5000 \
    registry:2.7.1
```

## Now to send you need to login first 
```
docker login localhost:5000
```

## If do you want to logout 
```
docker logout localhost:5000
```


# 04 Using remote registry

Edit or create the file /etc/docker/daemon.json, change the 192.168.68.106 to your registry IP

```
{
    "insecure-registries" : [ "192.168.68.106:5000" ]
}
```

Reload the docker
```
sudo service docker reload
```

# 05 Registry with SSL

Create the certificate
```
mkdir certificates
openssl req \
  -newkey rsa:4096 -nodes -sha256 -keyout domain.key \
  -addext 'subjectAltName = IP:192.168.68.106' \
  -x509 -days 365 -out domain.crt
```
In "Common Name (e.g. server FQDN or YOUR name) []:" (192.168.68.106) you need to type your registry server IP address.

## RUN
```
docker run -d \
    --rm \
    --name=registry \
    -p 5000:5000 \
    -v /data/marcelo/docker/registry/data:/var/lib/registry \
    -v /home/marcelo/workspace/curso_docker/15_registry/03_Registry_with_login/auth:/auth \
    -v /home/marcelo/workspace/curso_docker/15_registry/05_Registry_with_ssl/certificates:/certificates \
    -e "REGISTRY_AUTH=htpasswd" \
    -e "REGISTRY_AUTH_HTPASSWD_REALM=Registry Realm" \
    -e "REGISTRY_AUTH_HTPASSWD_PATH=/auth/htpasswd" \
    -e REGISTRY_HTTP_HOST=http://localhost:5000 \
    -e REGISTRY_HTTP_TLS_CERTIFICATE=/certificates/domain.crt
    -e REGISTRY_HTTP_TLS_KEY=/certificates/domain.key    
    registry:2.7.1
```

## For remote, now you need to copy the certificate

```
sudo mkdir -p /etc/docker/certs.d/192.168.68.106:5000/
cd /etc/docker/certs.d/192.168.68.106:5000/
scp marcelo@192.168.68.106:/home/marcelo/workspace/curso_docker/15_registry/05_Registry_with_ssl/certificates/domain.crt .
mv domain.crt ca.crt
sudo service docker reload
```

## Login
```
docker login 192.168.68.106:5000 -u usuario -p senha
```

## Logout
```
docker logout 192.168.68.106:5000
```

## To see your imagens
```
curl -k --basic -u usuario:senha -X GET https://192.168.68.106:5000/v2/_catalog
```

# 06 - Registry with UI



