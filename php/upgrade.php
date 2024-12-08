<?php
session_start();
include("../db/db.php");

if(!isset($_COOKIE['email'])){
    header('Location: ../index.php');
    exit();
}

// Recupera o plano atual do usuário
$query = "SELECT * FROM \"user\" WHERE email = '{$_COOKIE['email']}'";
$result = pg_query($query);
$row = pg_fetch_row($result);

// Recupera o plano selecionado para o upgrade via parâmetro na URL
$plano_selecionado = isset($_GET['plano']) ? (int)$_GET['plano'] : 0;

// Mapear os planos e seus preços
$planos = [
    0 => ['nome' => 'Sem Plano', 'preco' => 'R$0,00'],
    1 => ['nome' => 'Plano Básico', 'preco' => 'R$40,00'],
    2 => ['nome' => 'Plano Regular', 'preco' => 'R$60,00'],
    3 => ['nome' => 'Plano Premium', 'preco' => 'R$89,99'],
    4 => ['nome' => 'Plano Ultra', 'preco' => 'R$129,99']
];

// Verifica se o plano selecionado é válido
if (!array_key_exists($plano_selecionado, $planos)) {
    header('Location: conta.php'); // Caso o plano não seja válido, redireciona
    exit();
}

$plano_atual = $row[4]; // Plano atual do usuário
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upgrade de Plano - PawParadise</title>
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Gochi Hand', cursive;
            background-color: #f5f5f5;
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            display: flex;
            align-items: center;
            background-color: #fff;
            width: 100%;
            max-width: 700px; /* Aumentei a largura máxima do container */
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin: 20px; /* Adicionei margem para evitar que o conteúdo fique muito colado nas bordas */
        }


        h1 {
            font-size: 24px;
            color: #2c6b3f;
            margin-bottom: 20px;
        }

        .informacao {
            font-size: 18px;
            line-height: 1.6;
            color: #333;
            padding: 20px 30px;
            text-align: center;
            width: 80%; 
            max-width: 250px; 
            margin: 0 auto; 
        }

        .informacao strong {
            font-weight: bold;
            color: #2c6b3f;
        }

        .back-button {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 16px;
            background-color: transparent;
            border: none;
            color: #2c6b3f;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .back-button a {
            text-decoration: none;
            color: #2c6b3f;
            border: 2px solid #2c6b3f;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 16px;
        }

        .back-button a:hover {
            background-color: #2c6b3f;
            color: #fff;
        }

        .plano-box {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 8px;
            margin: 10px 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .plano-box h3 {
            font-size: 20px;
            color: #2c6b3f;
        }

        .plano-box p {
            font-size: 18px;
            color: #555;
        }

        .preco {
            font-size: 22px;
            color: #066437;
            font-weight: bold;
            margin-top: 10px;
        }

        .plano-box button {
            padding: 10px 20px;
            background-color: #066437;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 15px;
        }

        .plano-box button:hover {
            background-color: #045f29;
        }

        .alterar-plano {
            background-color: #066437;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: 30px;
        }

        .alterar-plano:hover {
            background-color: #045f29;
        }
    </style>
</head>
<body>

    <div class="back-button">
        <a href="conta.php">Voltar</a>
    </div>

    <section class="container">
        <h1>Upgrade de Plano</h1>

        <div class="informacao">
            <p><strong>Plano Atual:</strong><br>
                <?php
                echo $planos[$plano_atual]['nome'] . " - " . $planos[$plano_atual]['preco'];
                ?>
            </p>
        </div>

        <div class="plano-box">
            <h3>Plano Selecionado</h3>
            <p><strong>Valor do Novo Plano:</strong> <?php echo $planos[$plano_selecionado]['preco']; ?></p>
            <form action="pagamento.php" method="post">
                <input type="hidden" name="plano_atual" value="<?php echo $plano_atual; ?>">
                <input type="hidden" name="plano_selecionado" value="<?php echo $plano_selecionado; ?>">
                <input type="submit" value="Alterar Plano" class="alterar-plano">
            </form>
        </div>
    </section>

</body>
</html>
