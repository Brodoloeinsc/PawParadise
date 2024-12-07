<?php

    session_start();

    if (isset($_COOKIE['email'])) {
        header("Location: ./pagamento.php");
        exit();
    }

    include("../db/db.php");
    include("../classes/AuthFactory.php");  // Incluindo a fábrica de autenticação

    $email = $_POST['email'];
    $senha = $_POST['password'];

    // Usando a fábrica para autenticar o usuário
    $user = AuthFactory::authenticate($email, $senha);

    if ($user) {
        // Se a autenticação for bem-sucedida, cria o cookie e redireciona para o plano
        AuthFactory::setLoginCookie($email);
        header("Location:./pagamento.php");
        exit();
    } else {
        // Caso contrário, redireciona para o login com um erro
        header("Location:./login.php?error=1");
        exit();
    }

?>