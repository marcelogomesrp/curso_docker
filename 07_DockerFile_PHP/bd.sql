-- mysql -u root --password=senha -h 192.168.68.106 < bd.sql
ALTER USER 'root'@'%' IDENTIFIED WITH mysql_native_password BY 'senha';
FLUSH PRIVILEGES;

CREATE DATABASE docker;
use docker;
CREATE TABLE IF NOT EXISTS aula (
   aula_id INT AUTO_INCREMENT PRIMARY KEY,
   nome VARCHAR(255) NOT NULL,
   link VARCHAR(255) NOT NULL
) ;

INSERT INTO aula (nome, link) VALUES
("Curso de Docker - 01 Introdução ao docker", "https://youtu.be/ScmgXebitlQ"),
("Curso de Docker - 02 Não perca seus dados com o docker", "https://youtu.be/2S3XDGlYD4g"),
("Curso de Docker - 03 Como acessar um serviço do docker via rede", "https://youtu.be/TQF_Sz_o9uc");