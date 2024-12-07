<?php
    session_start();

    // Evitar cache do navegador para garantir que o estado seja verificado corretamente
    header("Cache-Control: no-cache, no-store, must-revalidate"); 
    header("Pragma: no-cache");
    header("Expires: 0");

    // Verificar se o cookie 'email' está presente
    $email = isset($_COOKIE['email']) ? $_COOKIE['email'] : null;

    if (isset($_GET["error"])) {
        echo "<script>alert('Usuário ou Senha Incorreto');</script>";
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
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <div class="container">
        <section class="container left">
            <img src="./images/logo.jpg" alt="Logo da Paw Paradise">
            <div class="text">
                <h1>Seja bem-vindo,</h1>
                <h2>O que você deseja fazer?</h2>
            </div>
            <div class="buttons">
                <a href="./pages/compras.php" class="btn">Compras Livres</a>
            </div>
        </section>

        <?php
            // Função para renderizar a seção de login
            function renderLoginForm() {
                echo "<section class=\"container right\">
                        <form method=\"post\" class=\"login\" action=\"./php/login.php\">
                            <label>Email</label><br>
                            <input type=\"text\" name=\"email\"><br>
                            <label>Senha</label><br>
                            <input type=\"password\" name=\"password\"><br>
                            <input type=\"submit\" class=\"submit\" value=\"Entrar\">
                            <a href=\"./pages/criar.php\">Não tem uma conta? Crie aqui.</a>
                        </form>
                    </section>";
            }

            // Função para renderizar a seção de plano
            function renderPlanButton() {
                echo "<section class=\"center-button\">
                        <a class=\"submit\" href=\"./php/plano.php\">Ir para o plano</a>
                    </section>";
            }

            // Verificar a existência do cookie 'email' e renderizar a seção adequada
            if (empty($email)) {
                renderLoginForm();
            } else {
                renderPlanButton();
            }
        ?>
        
    </div>
</body>
</html>
