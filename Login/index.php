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
        <div id=formulario>
            <h1>Entrar</h1>
            <form method = "POST">
                <input type = "email" name="email" placeholder = "Email">
                <input type = "password" name="senha" placeholder = "Senha">
                <input id="submit" type = "submit" value = "ACESSAR">
                <a href="cadastrar.php">Ainda não é inscrito? <strong>Cadastre-se!</strong></a>
            </form>
        </div>

        <?php
            //verificar se clicou no botão
            if (isset($_POST['email'])){
                $email = addslashes($_POST['email']) ;
                $senha = addslashes($_POST['senha']) ;

                //verificar se tem campo vazio
                if (!empty($email) && !empty($senha)) {
                    $pdo= new PDO('mysql:host=localhost;dbname=login', "root", ""); // nome do servidor, nome do banco, usuário do servidor e senha do servidor

                    if ($u-> msgErro == ""){ //se nã tiver erros

                        if($u->logar($email, $senha)){

                            header("location: AreaPrivada.php");

                        }else{
                            ?>
                            <div class="msg-erro">
                                Email e/ou Senha estão incorretos! 
                            </div> 
                            <?php
                        }

                    } else{
                        ?>
                        <div class="msg-erro">
                            <?php echo "Erro: ".$u->msgErro; ?>
                        </div> 
                        <?php
                    }
                   
                }else{
                    ?>
                    <div class="msg-erro">
                        Preencha todos os campos!
                    </div> 
                    <?php
                }
            }
        ?>         
        
        
    </body>
</html>