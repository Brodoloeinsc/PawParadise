<?php
    session_start();
    include('../classes/payment.php');

    // Verifica o status de login
    PaymentProcessor::checkLoginStatus();

    // Processa o pagamento ao submeter o formulário
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        PaymentProcessor::processPayment();
    }
?>
