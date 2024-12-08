<?php

    session_start();
    include("../db/db.php");
    include("../classes/product.php"); // Inclui a factory

    if (!isset($_COOKIE['admin']) || $_COOKIE['admin'] != true) {
        header('Location: ../index.php');
        exit();
    }

    $product_id = $_POST['id']; // Recupera o ID do produto

    // Verifica se o produto foi encontrado
    $query = "SELECT * FROM products WHERE id = $1";
    pg_prepare($connection, "fetch_product", $query);
    $result = pg_execute($connection, "fetch_product", [$product_id]);

    if ($result && pg_num_rows($result) > 0) {
        $product = pg_fetch_assoc($result);
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $product_name = $_POST['product_name'] ?? $product['product_name'];
            $product_price = $_POST['product_price'] ?? $product['product_price'];

            // Processa o upload de imagem
            $image_url = null;
            if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = "../uploads/";
                $image_name = uniqid() . "_" . basename($_FILES['product_image']['name']);
                $target_path = $upload_dir . $image_name;

                if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_path)) {
                    $image_url = $target_path;
                } else {
                    throw new Exception("Falha ao fazer upload da imagem.");
                }
            }

            // Chama a factory para editar o produto
            ProductFactory::editProduct($product_id, $product_name, $product_price, $image_url);

            // Redireciona para o painel de administração
            header('Location: index.php');
            exit();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }


?>