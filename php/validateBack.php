<?php
    $uri = $_SERVER['REQUEST_URI'];
    echo $uri;
    
    $teste = $_GET['msg'];
    echo $teste;

    require_once './../php/classes/Usuario';
    $user = new Usuario;

    

    if (isset($_POST['nome'])) {
        $nome = addslashes($_POST['nome']);
        $email = addslashes($_POST['email']);
        $cpf = addslashes($_POST['cpf']);
        $cor_fav = addslashes($_POST['cor_fav']);
        $senha = addslashes($_POST['senha']);
        $confirmarSenha = addslashes($_POST['confirmarSenha']);

        if(!empty($nome) && !empty($email) && !empty($cpf) && !empty($cor_fav) && !empty($confirmarSenha)){
        
        
        
        $user->conectar("db_testephp", "localhost", "root", "");
            if ($user->msgErro == "" || $user->msgErro == "undefined") {
                if ($senha == $confirmarSenha) {
                    if ($user->cadastrar($nome, $email, $cpf, $cor_fav, $senha)) {
                        
                        echo "Cadastrado com sucesso!";
                    } else {
                        echo "Email já cadastrado!";
                    }
                } else {
                    echo "Você não digitou senhas iguais.";
                }
            } else {
                echo "Erro: ".$user->msgErro;
            }
        } else {
            echo "Preencha todos os campos!";
        }
    }
?>
