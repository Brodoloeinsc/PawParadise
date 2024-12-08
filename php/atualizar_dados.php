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
    $name = isset($_POST['name']) ? $_POST['name'] : null;
    $email = isset($_POST['email']) ? $_POST['email'] : null;
    $plan = isset($_POST['plan']) ? $_POST['plan'] : null;
    $cep = isset($_POST['cep']) ? $_POST['cep'] : null;
    $address = isset($_POST['address']) ? $_POST['address'] : null;
    $complemento = isset($_POST['complemento']) ? $_POST['complemento'] : null;
    $cellphone = isset($_POST['cellphone']) ? $_POST['cellphone'] : null;

    // Atualiza os dados do usuário usando a Factory
    if (UserFactory::updateUser($connection, $name, $email, $plan, $cep, $address, $complemento, $cellphone)) {
        header("Location:./conta.php");
    } else {
        header("Location:./conta.php");
    }

?>
