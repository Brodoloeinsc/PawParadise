<?php

    include("../db/db.php");

    $id = uniqid();
    $email = $_POST['email'];
    $senha = $_POST['password'];
    $nome = $_POST['nome'];
    $senha = md5($senha);

    $query = "SELECT * FROM \"user\" WHERE email = '{$email}'";
    $result = pg_query($query);
    if($result == true){
        header("Location:../pages/criar.php?error=Email ja existente");
    }

    $query = "INSERT INTO \"user\" (id, name, email, password, plan) VALUES ('{$id}', '{$nome}', '{$email}', '{$senha}', '0');";
    $result = pg_query($query);

    if($result == true){
        setcookie('email', $email);
        header("Location:./plano.php");
    }

?>