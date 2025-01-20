<?php

    // Conexão com o banco de dados
    include('../db/db.php');
    include('../classes/change.php');

    // Verifica se o usuário está logado e se o ID do usuário está disponível (via cookie ou sessão)
    if (!isset($_COOKIE['email'])) {
        echo "Usuário não autenticado.";
        exit();
    }

    // Recebe os dados via POST. Se um campo não for preenchido, ele será nulo.
    $petname = isset($_POST['petname']) ? $_POST['petname'] : null;
    $receivedate = isset($_POST['receivedate']) ? $_POST['receivedate'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;

    // Atualiza os dados do usuário usando a Factory
    if (UserFactory::updatePetName($connection, $petname, $receivedate, $email)) {
        header("Location:./plano.php");
    } else {
        header("Location:./conta.php");
    }

?>
