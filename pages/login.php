<?php
session_start();

// Caso haja um erro no login, exibe um alerta
if (isset($_GET["error"])) {
    echo "<script>alert('Usuário ou Senha Incorreto');</script>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PawParadise - Login</title>
    <link rel="shortcut icon" href="./images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <div class="container">
        <section class="container left">
            <img src="./images/logo.jpg" alt="Logo da Paw Paradise">
            <div class="text">
                <h1>Bem-vindo de volta!</h1>
                <h2>Entre para acessar o pagamento</h2>
            </div>
        </section>
        
        <section class="container right">
            <form method="post" class="login" action="processar_login.php">
                <label>Email</label><br>
                <input type="text" name="email" required><br>

                <label>Senha</label><br>
                <input type="password" name="password" required><br>

                <input type="submit" class="submit" value="Entrar">
                <a href="./criarconta.php">Não tem uma conta? Crie aqui.</a>
            </form>
        </section>
    </div>
</body>
</html>
