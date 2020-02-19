<?php
    require_once 'classes/usuario.php';
    $u = new usuario;
?>

<!DOCTYPE html>
<html lang="ept-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="style.css" rel= "stylesheet">  
        <title>Sistema Login</title>
    </head>
    <body>
        <div id=formulario-cadastro>
            <h1>Cadastrar</h1>
            <form method = "POST">
                <input type = "text" name="nome" placeholder = "Nome Completo" max_length="30">
                <input type = "text" name="telefone" placeholder = "Telefone" max_length="30"> 
                <input type = "email" name="email" placeholder = "Email" max_length="40">
                <input type = "password" name="senha" placeholder = "Senha" max_length="15">
                <input type = "password" name="confSenha" placeholder = "Confirmar Senha">
                <input id="submit" type = "submit" value = "CADASTRAR">
            </form>
        </div>

        <?php
            //verificar se clicou no botão
            if (isset($_POST['nome'])){
                $nome = addslashes($_POST['nome']) ;
                $telefone = addslashes($_POST['telefone']) ;
                $email = addslashes($_POST['email']) ;
                $senha = addslashes($_POST['senha']) ;
                $confirmarSenha = addslashes($_POST['confSenha']) ;

                //verificar se tem campo vazio
                if (!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha)) {
                    
                    //$u->conectar("login","localhost", "root", ""); 
                    $pdo= new PDO('mysql:host=localhost;dbname=login', "root", ""); // nome do servidor, nome do banco, usuário do servidor e senha do servidor
                    if ($u-> msgErro == ""){ //se nã tiver erros

                        if($senha == $confirmarSenha){
                            if ($u-> cadastrar($nome, $telefone, $email, $senha)){
                                ?>
                                <div id="msg-sucesso">
                                    Usuário cadastrado com sucesso! Acesse para entrar <a href="index.php"><span style="color: black">Home</span></a>
                                </div> 
                                <?php
                            }else{
                                ?>
                                <div class="msg-erro">
                                    Usuário já cadastrado! <a href="index.php"><span style="color: black">Home</span></a>
                                </div> 
                                <?php
                            }

                        }else{
                            ?>
                            <div class="msg-erro">
                                Senha e confirmar senha não coincidem <a href="index.php"><span style="color: black">Home</span></a>
                            </div> 
                            <?php
                        }

                    }else{
                        ?>
                        <div class="msg-erro">
                            <?php echo "Erro: ".$u->msgErro; ?> <a href="index.php"><span style="color: black">Home</span></a>
                        </div> 
                        <?php
                        
                    }

                } else{
                    ?>
                    <div class="msg-erro">
                        Preencha todos os campos! <a href="index.php"><span style="color: black">Home</span></a>
                    </div> 
                    <?php
                }
            }
        ?>
    </body>
</html>