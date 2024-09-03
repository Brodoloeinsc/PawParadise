<?php

    $nome = $_POST['username'];
    $senha = $_POST['password'];

    if($nome == "Joao" && $senha == "12345"){
        setcookie('nome', $nome);
        header("Location:./plano.php");
    }else{
        echo "Login ou senha incorretos. <br>";
        echo "<a href=\"../pages/login.html\">Volte para o login</a>";
    }

?>