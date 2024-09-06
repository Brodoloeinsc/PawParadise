<?php

    include("../db/db.php");

    $email = $_POST['email'];
    $senha = $_POST['password'];

    $senha = md5($senha);

    $query = "SELECT * FROM \"user\" WHERE email = '{$email}' AND password = '{$senha}'";
    $result = pg_query($query);

    if($result == true){
        setcookie('email', $email);
        header("Location:./plano.php");
    }else{
        echo "Login ou senha incorretos. <br>";
        echo "<a href=\"../pages/login.html\">Volte para o login</a>";
    }

?>