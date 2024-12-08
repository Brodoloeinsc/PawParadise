<?php

session_start();
include("../db/db.php");
include("../classes/product.php");  // Inclui a factory

if (!isset($_COOKIE['admin']) || $_COOKIE['admin'] != true) {
    header('Location: ../index.php');
    exit();
}

// Verifica se os dados do produto foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];

        // Processa o upload da imagem
        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
            $upload_dir = '../uploads/';
            $image_name = basename($_FILES['product_image']['name']);
            $image_path = $upload_dir . $image_name;

            // Verifica se o diretório de upload existe, caso contrário, cria
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            // Move a imagem para o diretório de uploads
            if (move_uploaded_file($_FILES['product_image']['tmp_name'], $image_path)) {
                // Chama a factory para adicionar o produto com o caminho da imagem
                ProductFactory::addProduct($product_name, $product_price, $image_path);
                
                // Redireciona para o painel de administração
                header('Location: index.php');
                exit();
            } else {
                throw new Exception("Erro ao mover a imagem para o servidor.");
            }
        } else {
            throw new Exception("Imagem não fornecida ou erro no envio.");
        }

    } catch (Exception $e) {
        // Caso ocorra algum erro, exibe uma mensagem de erro
        echo "Erro: " . $e->getMessage();
    }
}

?>
