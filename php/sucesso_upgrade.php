<?php
session_start();
include("../db/db.php");

// Verifica se o usuário está logado
if (!isset($_COOKIE['email'])) {
    header('Location: ../index.php');
    exit();
}

$query = "SELECT * FROM \"user\" WHERE email = '{$_COOKIE["email"]}'";
$result = pg_query($query);

// Definição dos planos e preços
$planos = [
    0 => ['nome' => 'Sem Plano', 'preco' => 'R$0,00'],
    1 => ['nome' => 'Plano Básico', 'preco' => 'R$40,00'],
    2 => ['nome' => 'Plano Regular', 'preco' => 'R$60,00'],
    3 => ['nome' => 'Plano Premium', 'preco' => 'R$89,99'],
    4 => ['nome' => 'Plano Ultra', 'preco' => 'R$129,99']
];

// Verifica se o plano selecionado foi passado via POST
$plano_selecionado = pg_fetch_row($result)[4];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucesso no Upgrade de Plano</title>
    <link rel="stylesheet" href="../css/index.css">
    <style>
        body {
            background-color: #f5f5f5;
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            text-align: center;
            display: flex;
            flex-direction: column; /* Garante que os itens sejam empilhados verticalmente */
            align-items: center; /* Alinha todos os itens ao centro */
        }

        h1 {
            font-size: 24px;
            color: #2c6b3f;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
        }

        strong {
            color: #066437;
        }

        .btn {
            display: inline-block;
            background-color: #066437;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            text-decoration: none;
            transition: background-color 0.3s ease;
            margin-top: 20px; /* Garante que o botão fique abaixo do texto */
        }

        .btn:hover {
            background-color: #045f29;
        }
    </style>
</head>
<body>
    <section class="container">
        <h1>Upgrade de Plano Realizado com Sucesso!</h1><br>
        <p>Parabéns! Agora você está no plano <strong><?php echo $planos[$plano_selecionado]['nome']; ?></strong>.</p><br>
        <a href="plano.php" class="btn">Voltar para a sua conta</a>
    </section>
</body>
</html>