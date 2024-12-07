<?php

session_start();

    if(isset($_COOKIE['email'])){
        header("Location:./plano.php");
    }

    include("../db/db.php");

    $email = $_POST['email'];
    $senha = $_POST['password'];

    $senha = md5($senha);

    $query = "SELECT * FROM \"user\" WHERE email = '{$email}' AND password = '{$senha}'";
    $result = pg_query($query);

    if(pg_num_rows($result) > 0){
        setcookie("email", $email, time() + 3600, "/"); // 1 hora
        header("Location:./pagamento.php");
    }else{
        header("Location:./login.php?error=1{$row}");
    }

?>