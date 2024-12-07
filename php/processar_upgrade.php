<?php
    session_start();
    include("../db/db.php");

    // Verifica se o usuário está logado
    if (!isset($_COOKIE['email'])) {
        header('Location: ../index.php');
        exit();
    }

    // Recupera os dados enviados pelo formulário
    $plano_atual = isset($_POST['plano_atual']) ? (int)$_POST['plano_atual'] : 0;
    $plano_selecionado = isset($_POST['plano_selecionado']) ? (int)$_POST['plano_selecionado'] : 0;

    // Verifica se o plano selecionado é válido
    if ($plano_atual < 0 || $plano_atual > 4 || $plano_selecionado < 0 || $plano_selecionado > 4 || $plano_atual === $plano_selecionado) {
        header('Location: plano.php'); // Redireciona se o plano selecionado não for válido
        exit();
    }

    // Atualiza o plano do usuário no banco de dados
    $email = $_COOKIE['email'];
    $query = "UPDATE \"user\" SET plan = $plano_selecionado WHERE email = '$email'";

    $result = pg_query($query);

    if ($result) {
        // Se a atualização for bem-sucedida, redireciona para a página de sucesso
        header('Location: sucesso_upgrade.php');
    } else {
        // Se ocorrer algum erro, redireciona de volta para a página de conta
        header('Location: conta.php?erro=1');
    }
    exit();
?>
