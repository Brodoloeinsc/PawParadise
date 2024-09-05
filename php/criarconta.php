<?php


    $email = $_POST['email'];
    $senha = $_POST['password'];
    $nome = $_POST['nome'];


    if(true){
        setcookie('email', $email);
        header("Location:./plano.php");
    }

?>