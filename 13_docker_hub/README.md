# Explicação docker hub

[Vídeo](https://youtu.be/dHlQticyiKw)

# BWA
[GitHub do BWA](https://github.com/lh3/bwa)

## Clonar
```
git clone https://github.com/lh3/bwa.git
cd bwa
```

## Dockerfile
```
FROM ubuntu:20.04 as build
WORKDIR /bwa
COPY * /bwa/
RUN apt-get update
RUN apt-get install -y \
    make \
    build-essential \
    git \
    zlib1g-dev \
    liblzma-dev \
    libbz2-dev \
    libcurl4-gnutls-dev \
    libncurses5-dev \
    liblz4-dev
RUN make

FROM ubuntu:20.04
COPY --from=build /bwa/bwa /usr/local/bin/bwa
ENTRYPOINT ["/usr/local/bin/bwa"]
```

## Gerar a image
```
docker build -t bwa .
```

## Criar usuário no dockerhub
[https://hub.docker.com/](https://hub.docker.com/)


## Login
```
docker login
docker logout
```


## tag na image

```
docker tag IMAGEM_ID USUARIO/bwa:1
docker push USUARIO/bwa:1
```

## Imagem enviada

[https://hub.docker.com/r/marcelogomesrp/bwa](https://hub.docker.com/r/marcelogomesrp/bwa)