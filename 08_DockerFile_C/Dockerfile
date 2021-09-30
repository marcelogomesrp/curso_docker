FROM ubuntu:20.04 AS build
RUN apt-get update && apt-get install -y \
    gcc=4:9.3.0-1ubuntu2\
    libc6-dev=2.31-0ubuntu9.2 \
    --no-install-recommends && \
    rm -rf /var/lib/apt/lists/*

WORKDIR /app
COPY ./main.c /app
RUN gcc -static -o olaMundo main.c

FROM ubuntu:20.04
WORKDIR /app
COPY --from=build /app/olaMundo .
ENTRYPOINT "/app/olaMundo"
