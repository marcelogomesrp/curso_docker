#Exemplo 1

```dockerfile
ARG  CODE_VERSION=latest
FROM ubuntu:${CODE_VERSION}
```

docker build  --build-arg -t teste_20.04 .

docker build  --build-arg CODE_VERSION=20.04 -t teste_20.04 .

#Exemplo 2 com if e ubuntu

```dockerfile
ARG  CODE_VERSION=latest
FROM ubuntu:${CODE_VERSION}
ARG BRANCH="develop"
RUN if [ "$BRANCH" = "release" ] ; then  >'producao' ; else >'desenvolmento' ; fi 
```
docker build --build-arg BRANCH=release -t teste_prod .
docker build --build-arg BRANCH=develop -t teste_dev .

docker run --rm -it teste_prod ls
docker run --rm -it teste_dev ls


#Exemplo 3 com if e python

```dockerfile
ARG  CODE_VERSION=3.10
FROM python:${CODE_VERSION}
RUN adduser --disabled-password --gecos '' app
USER app
COPY --chown=app:app ./app /app
WORKDIR /app
ARG BRANCH="develop"
RUN if [ "$BRANCH" = "release" ] ;\
 then \
    pip install --user -r requirements.txt ;\
 else \
    pip install --user -r requirements-dev.txt ;\
fi 

ENV PATH="/home/app/.local/bin:/app:${PATH}"
```
docker build --build-arg BRANCH=release -t teste_prod .
docker build --build-arg BRANCH=develop -t teste_dev .

docker run --rm -it teste_prod app.py
docker run --rm -it teste_prod pytest
docker run --rm -it teste_dev app.py
docker run --rm -it teste_dev pytest