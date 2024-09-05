<?php
    include("../db/db.php");
    if(!$_COOKIE['email']){
        header('Location: ../pages/login.html');
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
    <header>
        <nav>
            <a href="../index.html" class="nav-item"><img src="../images/logo.png" alt="Logo da PawParadise" class="nav-item img"></a>
            <a href="./conta.php" class="nav-item link">Sua Conta</a>
        </nav>
    </header>
    
    <section class="all">
        <section class="container lateral left">
            <h1>Planos disponiveis</h1>
            <article class="card planos">
                <h3>Plano Basico</h3>
                <p>(O Seu)</p>
                <p class="preco seu">R$40,00</p>
            </article>
            <article class="card planos">
                <h3>Plano Regular</h3>
                <p class="preco">R$60,00</p>
                <button>Upgrade</button>
            </article>
            <article class="card planos">
                <h3>Plano Premium</h3>
                <p class="preco">R$89,99</p>
                <button>Upgrade</button>
            </article>
            <article class="card planos">
                <h3>Plano Ultra</h3>
                <p class="preco">R$129,99</p>
                <button>Upgrade</button>
            </article>
        </section>
        <section class="container central">
            <h1>Seu Plano</h1>
            <section class="informacao">
                <span>Seu plano hoje e o plano basico de assinatura</span>
            </section>
        </section>
        <section class="container lateral right">
            <h1>Produtos para comprar</h1>
            <article class="card planos">
                <h3>Plano Basico</h3>
                <p>(O Seu)</p>
                <p class="preco seu">R$40,00</p>
            </article>
            <article class="card planos">
                <h3>Plano Regular</h3>
                <p class="preco">R$60,00</p>
                <button>Upgrade</button>
            </article>
            <article class="card planos">
                <h3>Plano Premium</h3>
                <p class="preco">R$89,99</p>
                <button>Upgrade</button>
            </article>
            <article class="card planos">
                <h3>Plano Ultra</h3>
                <p class="preco">R$129,99</p>
                <button>Upgrade</button>
            </article>
        </section>
    </section>
    <footer>
        <span>&copy 2024</span>
    </footer>
</body>
</html>