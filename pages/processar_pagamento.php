<?php
session_start();

// Verifica se o usuário está logado, caso contrário redireciona para o login
if (!isset($_COOKIE['email'])) {
    header("Location: login.php");
    exit();
}

// Simulação de processamento de pagamento
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Aqui você pode adicionar lógica para processar o pagamento de verdade
    // Como é fictício, vamos apenas simular o sucesso

    // Excluindo os produtos do carrinho ao processar o pagamento
    setcookie("products", "", time() - 3600, "/"); // Expira o cookie "products"
    // Se necessário, também podemos excluir os cookies individuais de cada produto:
    if (isset($_COOKIE['products'])) {
        $products = explode(",", $_COOKIE['products']);
        foreach ($products as $product_id) {
            setcookie($product_id, "", time() - 3600, "/"); // Expira os cookies de cada produto
        }
    }

    header("Location: sucesso.php"); // Redireciona para a página de sucesso
    exit();
}
?>
