<?php
    include('../db/db.php');
    session_start();

    // Verifica se o usuário está logado (caso contrário, redireciona para o login)
    if (!isset($_COOKIE['email'])) {
        header("Location: ../index.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawParadise</title>
    <link rel="shortcut icon" href="./images/logo.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/index.css">
</head>
<body>

<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        max-width: 1200px;
        margin-top: 50px;
        flex-direction: column;
    }

    /* Estilizando o botão de voltar */
    .back-button {
        position: absolute;
        top: 10px;
        left: 20px;
        font-size: 20px;
        color: #000;
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

    .back-button a {
        text-decoration: none;
        color: inherit;
        display: flex;
        align-items: center;
    }

    .back-button a:hover {
        color: #066437;
    }

    .back-button i {
        margin-right: 5px;
    }

    /* Estilo da área de pagamento */
    .pagamento {
        text-align: center;
        margin-top: 20px;
        width: 100%;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
    }

    .pagamento h1 {
        margin-bottom: 0px;
    }

    .pagamento label {
        display: block;
        margin: 8px 0;
        font-weight: bold;
    }

    .pagamento input[type="text"],
    .pagamento input[type="month"] {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .pagamento input[type="submit"] {
        padding: 10px 20px;
        background-color: #066437;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .pagamento input[type="submit"]:hover {
        background-color: #054d28;
    }

    /* Estilo do resumo do carrinho */
    .resumo-carrinho {
        width: 100%;
        padding: 20px;
        background-color: #f4f4f4;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .resumo-carrinho h3 {
        margin-bottom: 15px;
    }

    .resumo-carrinho .produto {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .resumo-carrinho .total {
        font-weight: bold;
        font-size: 18px;
    }
</style>

<div class="back-button">
    <a href="plano.php"><i class="fa-solid fa-arrow-left"></i> Voltar à seleção</a>
</div>

<div class="container pagamento">
    <h1>Digite os dados do cartao</h1>

    <form action="./processar_upgrade.php" method="post">
        <input type="hidden" name="plano_atual" value="<?php echo $_POST['plano_atual']; ?>">
        <input type="hidden" name="plano_selecionado" value="<?php echo $_POST['plano_selecionado']; ?>">
        <label for="cartao">Número do Cartão</label>
        <input type="text" name="cartao" id="cartao" required>

        <label for="data_expiracao">Data de Expiração</label>
        <input type="month" name="data_expiracao" id="data_expiracao" required>

        <label for="cvv">CVV</label>
        <input type="text" id="cvv" name="cvv" maxlength="3" pattern="\d{3}" required oninput="this.value=this.value.replace(/[^\d]/g,'');">

        <input type="submit" value="Pagar">
    </form>
</div>

</body>
</html>