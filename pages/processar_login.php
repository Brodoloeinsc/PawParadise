<?php
    session_start();

    // Simulando um login fictício
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Defina um cookie para simular o login bem-sucedido
        setcookie('email', $_POST['email'], time() + 3600, '/'); // Validade de 1 hora
        header("Location: pagamento.php"); // Redireciona para a página de pagamento
        exit();
    }
?>
