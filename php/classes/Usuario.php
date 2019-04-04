<?php
    class Usuario {
      function __construct(argument){

      }

      private $pdo;

      public function conectar($dbname, $host, $user, $password){
          try {
              global $pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$password);
          } catch (PDOException $e) {
              $msgErro = $e->getMessage();
          }

      }

      public function cadastrar($nome, $email, $cpf, $cor_fav, $senha){
          global $pdo = new PDO();

          //verificacao do email:
          $sql = $pdo->prepare("SELECT id FROM users WHERE email = :e");
          $sql = $sql->bindValue(":e", $email);
          $sql->execute();
          if ($sql->rowCount > 0) {
              return false;
          } else {
              $sql = $pdo->prepare("INSERT INTO users(nome, email, cpf, cor_fav, senha) VALUES (:n, :e, :c, :cf, :s)");
              $sql = $sql->bindValue(":n", $nome);
              $sql = $sql->bindValue(":e", $email);
              $sql = $sql->bindValue(":c", $cpf);
              $sql = $sql->bindValue(":cf", $cor_fav);
              $sql = $sql->bindValue(":s", $senha);

              $sql->execute();
              return true;
          }
      }

      public function logar($email, $senha){
          global $pdo = new PDO();
      }
    }

?>
