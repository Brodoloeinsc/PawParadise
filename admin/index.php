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

// Consulta para listar todos os produtos
$query = "SELECT * FROM products";
$result = pg_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Administração</title>
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
            width: 80%;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
        }
        td {
            background-color: #fff;
        }
        a {
            color: #333;
            text-decoration: none;
            margin-right: 10px;
        }
        a:hover {
            color: #3339;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            background-color: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #555;
            color: #fff;
        }
        .actions {
            margin-top: 10px;
        }
        /* Estilo do botão de voltar */
        .btn-voltar {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50; /* Cor verde */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
            font-weight: bold;
        }

        .btn-voltar:hover {
            background-color: #45a049;
            color: #fff;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Painel de Administração - Produtos</h1>

    <a href="add_product.php" class="btn">Adicionar Novo Produto</a>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Imagem</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = pg_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td>R$ <?php echo $row['product_price']; ?></td>
                    <td>
                        <img src="<?php echo $row['image_url']; ?>" alt="Imagem do Produto" width="100">
                    </td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $row['id']; ?>">Editar</a> |
                        <a href="delete_product.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href="../php/conta.php" class="btn-voltar">Voltar para Conta</a>
</div>

</body>
</html>
