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