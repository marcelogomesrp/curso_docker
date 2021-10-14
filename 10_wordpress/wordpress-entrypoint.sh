#!/usr/bin/env bash

FILE=/var/www/html/wp-login.php
URL="https://br.wordpress.org/wordpress-5.8.1-pt_BR.tar.gz"
MD5="603b3bdaed56a181ecf6f2f5e26ac7ed"

if ! mount | grep /var/www/html > /dev/null; then
    echo "Voce deve montar o volume /var/www/html";    
    exit 1;
fi

if [ "$1" == "install" ]; then
    echo "instalar"; 
    if [ -f "$FILE" ]; then
        echo "O Wordpress ja esta instalado"
        exit 1
    fi
    cd /var/www/html;
    curl -o wordpress.tar.gz -fL ${URL};
    echo "603b3bdaed56a181ecf6f2f5e26ac7ed  wordpress.tar.gz" | md5sum -c;
    tar -xzf wordpress.tar.gz -C /var/www/html --strip-components=1;
    rm -rf /var/www/html/wordpress.tar.gz;
    chown -R 33.33 /var/www/html;
    echo "Agora voce pode rodar novamente o container sem argumentos"       
    exit 0;
fi

if [ ! -f "$FILE" ]; then
   echo "You need run the container with install first"
   exit 1
fi

exec "$@"