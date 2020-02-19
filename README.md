# login-php
sistema login com php e banco de dados mysql


Antes de exectar o código, copie e cole o código abaixo no mysql, ele cria o banco de dados com as colunas usadas no sistema.

create database login;

use login;

create table usuarios(
	id_user int AUTO_INCREMENT PRIMARY key,
	nome varchar(30),
	telefone varchar(30),
	email varchar(40),
	senha varchar(32)
);


Nos arquivos index.php na linha 33, se necessário, mude o código: $pdo= new PDO('mysql:host=localhost;dbname=login', "root", ""); 
inserindo as informações do servidor, onde no lugar de "localhost" é o servidor, "root" é o usuario do servidor, e aspas vazias "" é a senha do servidor.

O mesmo no arquivo cadastrar.php na linha 40.
