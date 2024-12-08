<?php

    session_start();
    include("../db/db.php");
    include("../classes/plan.php");

    // Verifica se o usuário está logado
    if (!isset($_COOKIE['email'])) {
        header('Location: ../index.php');
        exit();
    }

    // Recupera os dados enviados pelo formulário de forma segura
    $plano_atual = isset($_POST['plano_atual']) ? (int)$_POST['plano_atual'] : 0;
    $plano_selecionado = isset($_POST['plano_selecionado']) ? (int)$_POST['plano_selecionado'] : 0;

    // Valida os planos
    if (!PlanFactory::validatePlan($plano_atual, $plano_selecionado)) {
        header('Location: plano.php'); // Redireciona se o plano selecionado não for válido
        exit();
    }

    // Recupera o email do usuário logado
    $email = $_COOKIE['email'];

    // Atualiza o plano do usuário
    if (PlanFactory::updateUserPlan($email, $plano_selecionado)) {
        // Se a atualização for bem-sucedida, redireciona para a página de sucesso
        header('Location: sucesso_upgrade.php');
    } else {
        // Se ocorrer algum erro, redireciona de volta para a página de conta
        header('Location: conta.php?erro=1');
    }

    exit();

?>
