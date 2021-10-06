-- mysql -u root --password=senha -h 192.168.68.106 < bd.sql
ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'senha';
FLUSH PRIVILEGES;

CREATE DATABASE wordpress;

