<?php
    class Usuario {
      private $pdo;
      public $msgErro = "";

      public function conectar($dbname, $host, $user, $password){
          global $pdo;
          global $msgErro;

          try {
              $pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$password);
          } catch (PDOException $e) {
              $msgErro = $e->getMessage();
          }

      }

      public function cadastrar($nome, $email, $cpf, $cor_fav, $senha){
          global $pdo;
          global $msgErro;
          //verificacao do email:
          $sql = $pdo->prepare("SELECT id FROM users WHERE email = '$email'");
         
          $sql->execute();
          if ($sql->rowCount() > 0) {
              return false;
          } else {
              $sql = $pdo->prepare("INSERT INTO users(nome, email, cpf, cor_fav, senha) VALUES (:n, :e, :c, :cf, :s)");
              $sql->bindValue(":n", $nome);
              $sql->bindValue(":e", $email);
              $sql->bindValue(":c", $cpf);
              $sql->bindValue(":cf", $cor_fav);
              $sql->bindValue(":s", md5($senha));

              print_r($sql);
              $sql =$sql->execute();
              return true;
          }
      }

      public function logar($email, $senha){
          global $pdo;
          $sql = $pdo->prepare("SELECT id FROM users WHERE email = :e AND senha = :s");
          $sql = $sql->bindValue(":e", $email);
          $sql = $sql->bindValue(":n", md5($senha));
          $sql->execute();

          if ($sql->rowCount() > 0) {
              $dado = $sql->fetch();
              session_start();
              $_SESSION['id_usuario'] = $dado['id'];
              return true;
          } else {
              return false;
          }
      }
    }

?>
