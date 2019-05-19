<?php
    require_once 'php/classes/Usuario.php';
    $user = new Usuario;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Login - PHP + MySQL - Canal TI</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>

<body>
    <section class="hero is-success is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Sistema de Login</h3>
                    <h3 class="title has-text-grey"><a href="https://youtube.com/canaltioficial" target="_blank">Canal TI</a></h3>
                    <div class="notification is-danger">
                      <p>ERRO: Usuário ou senha inválidos.</p>
                    </div>
                    <div class="box">
                        <form action="./php/validateBack.php" method="POST">
                            <div class="field">
                                <div class="control">
                                    <input name="email" type="text" class="input is-large" placeholder="Digite seu email..." autofocus="">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input name="senha" class="input is-large" type="password" placeholder="Digite sua senha">
                                </div>
                            </div>
                            <button type="submit" class="button is-block is-link is-large is-fullwidth">Entrar</button>
                        </form><br>
                        <a href="cadastrar.php">Cadastre-se</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>

<?php
    $email = isset($_POST['email']);
    $senha = isset($_POST['senha']);

    if(!empty($email) && !empty($senha)){
        $user->conectar("db_testephp", "localhost", "root", "");
        if ($user->msgErro == "" || $user->msgErro == "undefined") {
            if($user -> logar($email, $senha)) {
                header('./paths/areaPrivada.php');
            } else {
                echo "Email ou senha inválidos";
            }
        } else {
            echo "Erro na conexão com o banco. Erro: ".$user->msgErro;
        }
    } else {
        echo "Preencha todos os campos!";
    }
?>
