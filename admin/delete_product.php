<?php
// Conexão com o banco de dados
include('../db/db.php');

// Verifica se o usuário é um administrador
session_start();
if (!isset($_COOKIE['admin']) || $_COOKIE['admin'] != true) {
    header('Location: ../');
    exit();
}

// Verifica se o ID do produto foi passado
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Exclui o produto
    $query = "DELETE FROM products WHERE id = $1";
    $stmt = pg_prepare($connection, "delete_product", $query);
    pg_execute($connection, "delete_product", [$product_id]);

    // Redireciona para a página de admin
    header('Location: index.php');
    exit();
} else {
    echo "ID do produto não fornecido.";
}
?>