<?php
session_start();
include("../db/db.php");

// Verifica se o usuário está logado
if (!isset($_COOKIE['email'])) {
    header('Location: ../index.php');
    exit();
}

// Verifica se o usuário é administrador
if (!isset($_COOKIE['admin']) || $_COOKIE['admin'] != true) {
    // Proteção contra injeção SQL: Escape o valor do email
    $email = pg_escape_string($connection, $_COOKIE['email']);

    // Recupera os dados do usuário
    $query = "SELECT * FROM \"user\" WHERE email = '$email'";
    $result = pg_query($connection, $query);

    if ($result) {
        $row = pg_fetch_assoc($result);
        
        if ($row['admin'] == false) {
            header('Location: ../');
            exit();
        } else {
            setcookie('admin', true, time() + 3600, "/"); // Define o cookie para admin
        }
    } else {
        header('Location: ../');
        exit();
    }
}

// Recupera os dados do produto para edição
$product_id = $_GET['id'];
$query = "SELECT * FROM products WHERE id = $1";
$result = pg_query_params($connection, $query, array($product_id));
$product = pg_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            background-color: #333;
            color: white;
            padding: 20px;
        }
        .container {
            width: 60%;
            margin: 0 auto;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 5px;
        }
        button:hover {
            background-color: #555;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            color: #333;
            text-decoration: none;
            background-color: #ddd;
            padding: 10px 20px;
            border-radius: 5px;
        }
        a:hover {
            background-color: #bbb;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Editar Produto</h1>
    
    <form action="update_product.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

        <label for="product_name">Nome do Produto</label>
        <input type="text" id="product_name" name="product_name" value="<?php echo $product['product_name']; ?>" required>

        <label for="product_price">Preço</label>
        <input type="text" id="product_price" name="product_price" value="<?php echo $product['product_price']; ?>" required>
        
        <label for="product_image">Imagem do Produto:</label>
        <input type="file" id="product_image" name="product_image">

        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="Imagem Atual" style="width: 150px;">
        <br>
        <button type="submit">Atualizar Produto</button>
    </form>

    <a href="index.php">Voltar ao Painel de Administração</a>
</div>

</body>
</html>
