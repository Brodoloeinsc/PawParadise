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
    
    <?php
    
        $query = "SELECT * FROM \"user\" WHERE email = '{$_COOKIE['email']}'";
        $result = pg_query($query);

        $row = pg_fetch_row($result);

        $seuplano = $row[4];

    ?>

    <section class="all">
        <section class="container lateral left">
        <h1>Produtos para comprar</h1>
            <article class="card planos">
                <h3>Plano Basico</h3>
                <p class="preco seu">R$40,00</p>
                <?php
                
                    if($seuplano == 1){
                        echo "<p>(O Seu)</p>";
                    }else{
                        echo "<button>Upgrade</button>";
                    }
                
                ?>
            </article>
            <article class="card planos">
                <h3>Plano Regular</h3>
                <p class="preco">R$60,00</p>
                <?php
                
                    if($seuplano == 2){
                        echo "<p>(O Seu)</p>";
                    }else{
                        echo "<button>Upgrade</button>";
                    }
                
                ?>
            </article>
            <article class="card planos">
                <h3>Plano Premium</h3>
                <p class="preco">R$89,99</p>
                <?php
                
                    if($seuplano == 3){
                        echo "<p>(O Seu)</p>";
                    }else{
                        echo "<button>Upgrade</button>";
                    }
                
                ?>
            </article>
            <article class="card planos">
                <h3>Plano Ultra</h3>
                <p class="preco">R$129,99</p>
                <?php
                
                    if($seuplano == 4){
                        echo "<p>(O Seu)</p>";
                    }else{
                        echo "<button>Upgrade</button>";
                    }
                
                ?>
            </article>
        </section>
        <section class="container central">
            <h1>Seu Plano</h1>
            <section class="informacao">
                <span>Seu plano hoje e <?php

                    switch ($row[4]){
                        case "0":
                            echo "sem";
                            break;
                        case "1":
                            echo "o basico de";
                            break;
                        case "2":
                            echo "o regular de";
                            break;
                        case "3":
                            echo "o premium de";
                            break;
                        case "4":
                            echo "o ultra de";
                            break;
                    }
                
                ?> assinatura</span>
            </section>
        </section>
        <section class="container lateral right">
            <h1>Produtos para comprar</h1>
            <article class="card planos">
                <h3>Plano Basico</h3>
                <p class="preco seu">R$40,00</p>
                <?php
                
                    if($seuplano == 1){
                        echo "<p>(O Seu)</p>";
                    }else{
                        echo "<button>Upgrade</button>";
                    }
                
                ?>
            </article>
            <article class="card planos">
                <h3>Plano Regular</h3>
                <p class="preco">R$60,00</p>
                <?php
                
                    if($seuplano == 2){
                        echo "<p>(O Seu)</p>";
                    }else{
                        echo "<button>Upgrade</button>";
                    }
                
                ?>
            </article>
            <article class="card planos">
                <h3>Plano Premium</h3>
                <p class="preco">R$89,99</p>
                <?php
                
                    if($seuplano == 3){
                        echo "<p>(O Seu)</p>";
                    }else{
                        echo "<button>Upgrade</button>";
                    }
                
                ?>
            </article>
            <article class="card planos">
                <h3>Plano Ultra</h3>
                <p class="preco">R$129,99</p>
                <?php
                
                    if($seuplano == 4){
                        echo "<p>(O Seu)</p>";
                    }else{
                        echo "<button>Upgrade</button>";
                    }
                
                ?>
            </article>
        </section>
    </section>
    <footer>
        <span>&copy 2024</span>
    </footer>
</body>
</html>