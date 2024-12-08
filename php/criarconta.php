<?php
session_start();
include("../db/db.php");
include('../classes/createuser.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recebendo e sanitizando dados de entrada
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $senha = $_POST['password'];
        $nome = trim($_POST['nome']);

        // Validação de entrada
        if (empty($email) || empty($senha) || empty($nome)) {
            header("Location: ../pages/criar.php?error=Campos obrigatórios não preenchidos");
            exit();
        }

        try {
            // Criando o usuário através da UserFactory
            $user = UserFactory::createUser($email, $nome, $senha);

            // Criando o cookie de sessão para o email do usuário
            setcookie("email", $email, time() + 3600, "/"); // 1 hora
            header("Location: ./plano.php");
        } catch (Exception $e) {
            // Caso ocorra algum erro, redirecionamos com a mensagem de erro
            header("Location: ../pages/criar.php?error=" . $e->getMessage());
        }
    } else {
        // Caso o formulário não tenha sido submetido via POST
        header("Location: ../pages/criar.php?error=Método de requisição inválido");
    }
?>