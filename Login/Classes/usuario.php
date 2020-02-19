<?php
    class usuario{

        private $pdo;
        public $msgErro=""; //se estiver vazia, não tem erro

        public function conectar($nome, $host, $usuario, $senha){
            global $pdo;
            global $msgErro;
            try {
                $pdo = new pdo("mysql: dbname=".$nome.";host=".$host, $usuario, $senha);
            } catch (PDOException $e) {
                $msgErro = $e -> getMessage();
            }
        }

        public function cadastrar($nome, $telefone, $email, $senha){
            global $pdo;

            //verificar se já existe e-mail cadastrado
            $sql = $pdo -> prepare("select id_user from usuarios where email = :e");
            $sql -> bindValue(":e", $email);
            $sql -> execute();

            if($sql->rowCount() > 0){ //dados que veio da consulta
                return false; // já está cadastrada
            } else{
                //caso não, cadastrar
                $sql = $pdo-> prepare("insert into usuarios (nome, telefone, email, senha) values(:n, :t, :e, :s)");
                $sql -> bindValue(":n", $nome);
                $sql -> bindValue(":t", $telefone);
                $sql -> bindValue(":e", $email);
                $sql -> bindValue(":s", md5($senha));
                
                $sql -> execute();
                return true;
            } 
        }

        public function logar($email, $senha){
            global $pdo;

            //vereficar se o email e senha estão cadastrados, se sim,
            $sql = $pdo -> prepare("select id_user from usuarios where email = :e and senha = :s");
            $sql -> bindValue(":e", $email);
            $sql -> bindValue(":s", md5($senha));
            $sql -> execute();

            if($sql->rowCount()> 0){ 
                //entrar no sistema (sessão)

                $dado = $sql-> fetch(); //fetch transforma tudo o que veio do banco de dados e transforma num array com os nomes das colunas
                session_start();
                $_SESSION['id_user'] = $dado['id_user'];
                return true; //logado com sucesso 
            }else{
                return false; // não foi possivel logar

            }
        }
    }
?>